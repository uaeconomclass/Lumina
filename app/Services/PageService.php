<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PageStatus;
use App\Models\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PageService
{
    /**
     * @param array<string, mixed> $filters
     * @return LengthAwarePaginator<int, Page>
     */
    public function publishedPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return Page::query()
            ->with(['taxonomies', 'media'])
            ->published()
            ->when($filters['taxonomy'] ?? null, function (Builder $query, string $taxonomy): void {
                $query->whereHas('taxonomies', function (Builder $query) use ($taxonomy): void {
                    $query->where('slug->'.app()->getLocale(), $taxonomy)
                        ->orWhere('slug->'.config('app.fallback_locale', 'en'), $taxonomy);
                });
            })
            ->latest('published_at')
            ->paginate(min($perPage, 50));
    }

    public function findPublishedBySlug(string $slug): ?Page
    {
        return Page::query()
            ->with(['parent', 'children', 'taxonomies', 'media'])
            ->published()
            ->where(function (Builder $query) use ($slug): void {
                foreach (config('lumina.locales', ['en']) as $locale) {
                    $query->orWhere('slug->'.$locale, $slug);
                }
            })
            ->first();
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): Page
    {
        $data = $this->normalizePayload($data);
        $taxonomyIds = Arr::pull($data, 'taxonomies', []);

        /** @var Page $page */
        $page = Page::query()->create($data);
        $page->taxonomies()->sync($taxonomyIds);

        return $page;
    }

    /** @param array<string, mixed> $data */
    public function update(Page $page, array $data): Page
    {
        $data = $this->normalizePayload($data);
        $taxonomyIds = Arr::pull($data, 'taxonomies', null);

        $page->update($data);

        if (is_array($taxonomyIds)) {
            $page->taxonomies()->sync($taxonomyIds);
        }

        return $page->refresh();
    }

    /** @param array<string, mixed> $data */
    private function normalizePayload(array $data): array
    {
        foreach (['title', 'slug', 'content', 'seo_title', 'seo_description'] as $field) {
            if (! is_array($data[$field] ?? null)) {
                continue;
            }

            $data[$field] = array_filter($data[$field], static fn ($value): bool => filled($value));
        }

        foreach (config('lumina.locales', ['en']) as $locale) {
            if (blank($data['slug'][$locale] ?? null) && filled($data['title'][$locale] ?? null)) {
                $data['slug'][$locale] = Str::slug($data['title'][$locale]);
            }
        }

        if (($data['status'] ?? null) === PageStatus::Published->value && blank($data['published_at'] ?? null)) {
            $data['published_at'] = now();
        }

        return $data;
    }
}
