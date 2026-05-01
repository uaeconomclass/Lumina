<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SettingType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    /** @var list<string> */
    public array $translatable = [
        'value',
    ];

    /** @var list<string> */
    protected $fillable = [
        'key',
        'value',
        'type',
        'is_public',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
            'type' => SettingType::class,
        ];
    }
}
