<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\PageStatus;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_pages_index_returns_published_pages(): void
    {
        Page::factory()->create([
            'title' => ['en' => 'About', 'ru' => 'О нас'],
            'slug' => ['en' => 'about', 'ru' => 'o-nas'],
        ]);

        Page::factory()->create([
            'status' => PageStatus::Draft,
        ]);

        $this->getJson('/api/v1/pages', ['Accept-Language' => 'en'])
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.slug', 'about');
    }

    public function test_page_show_respects_accept_language_header(): void
    {
        Page::factory()->create([
            'title' => ['en' => 'About', 'ru' => 'О нас'],
            'slug' => ['en' => 'about', 'ru' => 'o-nas'],
        ]);

        $this->getJson('/api/v1/pages/o-nas', ['Accept-Language' => 'ru'])
            ->assertOk()
            ->assertJsonPath('data.title', 'О нас')
            ->assertJsonPath('data.slug', 'o-nas');
    }
}
