<?php

declare(strict_types=1);

namespace App\Filament\Resources\Taxonomies\Schemas;

use App\Enums\TaxonomyType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TaxonomyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->schema([
                Section::make('Translations')
                    ->schema([
                        Tabs::make('Locales')->tabs([
                            self::localeTab('en', 'English'),
                            self::localeTab('ru', 'Russian'),
                        ]),
                    ])
                    ->columnSpan(2),
                Section::make('Classification')
                    ->schema([
                        Select::make('type')
                            ->options(TaxonomyType::options())
                            ->default(TaxonomyType::Category->value)
                            ->required(),
                    ])
                    ->columnSpan(1),
            ]),
        ]);
    }

    private static function localeTab(string $locale, string $label): Tab
    {
        return Tab::make($label)->schema([
            TextInput::make("name.{$locale}")
                ->required($locale === config('app.fallback_locale', 'en'))
                ->maxLength(120)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state): mixed => filled($state)
                    ? $set("slug.{$locale}", Str::slug($state))
                    : null),
            TextInput::make("slug.{$locale}")
                ->required($locale === config('app.fallback_locale', 'en'))
                ->maxLength(120),
        ])->columns(2);
    }
}
