<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TaxonomyType;
use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<Taxonomy> */
class TaxonomyFactory extends Factory
{
    protected $model = Taxonomy::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => [
                'en' => $name,
                'ru' => 'RU '.$name,
            ],
            'slug' => [
                'en' => Str::slug($name),
                'ru' => Str::slug('ru '.$name),
            ],
            'type' => fake()->randomElement(TaxonomyType::cases()),
        ];
    }
}
