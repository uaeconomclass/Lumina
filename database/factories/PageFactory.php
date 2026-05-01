<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PageStatus;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<Page> */
class PageFactory extends Factory
{
    protected $model = Page::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(3);

        return [
            'title' => [
                'en' => $title,
                'ru' => 'RU '.$title,
            ],
            'slug' => [
                'en' => Str::slug($title),
                'ru' => Str::slug('ru '.$title),
            ],
            'content' => [
                'en' => fake()->paragraphs(3, true),
                'ru' => fake()->paragraphs(3, true),
            ],
            'status' => PageStatus::Published,
            'published_at' => now()->subDays(fake()->numberBetween(0, 60)),
            'seo_title' => [
                'en' => $title,
                'ru' => 'RU '.$title,
            ],
            'seo_description' => [
                'en' => fake()->sentence(12),
                'ru' => fake()->sentence(12),
            ],
        ];
    }
}
