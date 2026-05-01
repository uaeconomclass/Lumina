<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\SettingType;
use App\Enums\TaxonomyType;
use App\Enums\UserRole;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Taxonomy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Lumina Admin',
            'email' => 'admin@lumina.test',
            'password' => Hash::make('password'),
            'role' => UserRole::Admin,
        ]);

        $categories = Taxonomy::factory()
            ->count(8)
            ->create(['type' => TaxonomyType::Category]);

        $tags = Taxonomy::factory()
            ->count(16)
            ->create(['type' => TaxonomyType::Tag]);

        $parents = Page::factory()
            ->count(10)
            ->create();

        Page::factory()
            ->count(45)
            ->recycle($parents)
            ->create([
                'parent_id' => fn () => $parents->random()->id,
            ])
            ->each(function (Page $page) use ($categories, $tags): void {
                $page->taxonomies()->sync(
                    $categories->random(1)->pluck('id')
                        ->merge($tags->random(2)->pluck('id'))
                        ->all(),
                );
            });

        foreach ([
            'site_name' => [SettingType::String, true, ['en' => 'Lumina CMS', 'ru' => 'Lumina CMS']],
            'contact_email' => [SettingType::Email, true, ['en' => 'hello@lumina.test', 'ru' => 'hello@lumina.test']],
            'facebook_url' => [SettingType::Url, true, ['en' => 'https://facebook.com/lumina', 'ru' => 'https://facebook.com/lumina']],
            'instagram_url' => [SettingType::Url, true, ['en' => 'https://instagram.com/lumina', 'ru' => 'https://instagram.com/lumina']],
        ] as $key => [$type, $isPublic, $value]) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['type' => $type, 'is_public' => $isPublic, 'value' => $value],
            );
        }
    }
}
