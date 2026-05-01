<?php

declare(strict_types=1);

namespace App\Enums;

enum TaxonomyType: string
{
    case Category = 'category';
    case Tag = 'tag';

    public function label(): string
    {
        return match ($this) {
            self::Category => 'Category',
            self::Tag => 'Tag',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::Category->value => self::Category->label(),
            self::Tag->value => self::Tag->label(),
        ];
    }
}
