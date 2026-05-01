<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Page */
class PageResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        $media = $this->getFirstMedia(Page::FEATURED_IMAGE_COLLECTION);

        return [
            'id' => $this->id,
            'title' => $this->getTranslation('title', app()->getLocale(), false),
            'slug' => $this->getTranslation('slug', app()->getLocale(), false),
            'content' => $this->getTranslation('content', app()->getLocale(), false),
            'status' => $this->status->value,
            'published_at' => $this->published_at?->toISOString(),
            'seo' => [
                'title' => $this->getTranslation('seo_title', app()->getLocale(), false),
                'description' => $this->getTranslation('seo_description', app()->getLocale(), false),
            ],
            'media' => $media ? [
                'featured_image' => [
                    'url' => $media->getFullUrl(),
                    'thumb' => $media->getFullUrl('thumb'),
                    'medium' => $media->getFullUrl('medium'),
                    'responsive' => $media->responsiveImages()->files->map->toArray()->all(),
                ],
            ] : null,
            'taxonomies' => TaxonomyResource::collection($this->whenLoaded('taxonomies')),
        ];
    }
}
