<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TaxonomyType;
use Database\Factories\TaxonomyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Translatable\HasTranslations;

class Taxonomy extends Model
{
    /** @use HasFactory<TaxonomyFactory> */
    use HasFactory;
    use HasTranslations;

    /** @var list<string> */
    public array $translatable = [
        'name',
        'slug',
    ];

    /** @var list<string> */
    protected $fillable = [
        'name',
        'slug',
        'type',
    ];

    public function pages(): MorphToMany
    {
        return $this->morphedByMany(Page::class, 'taxonomable')->withTimestamps();
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'type' => TaxonomyType::class,
        ];
    }
}
