<?php

declare(strict_types=1);

namespace App\Filament\Resources\Pages\Schemas;

use App\Enums\PageStatus;
use App\Models\Page;
use App\Models\Taxonomy;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->schema([
                Section::make('Content')
                    ->schema([
                        Tabs::make('Translations')
                            ->tabs([
                                self::localeTab('en', 'English'),
                                self::localeTab('ru', 'Russian'),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(2),
                Section::make('Publishing')
                    ->schema([
                        ToggleButtons::make('status')
                            ->options(PageStatus::options())
                            ->default(PageStatus::Draft->value)
                            ->inline()
                            ->required(),
                        DateTimePicker::make('published_at')
                            ->seconds(false),
                        Select::make('parent_id')
                            ->label('Parent page')
                            ->relationship(
                                name: 'parent',
                                titleAttribute: 'title',
                                modifyQueryUsing: fn ($query) => $query->orderBy('id'),
                            )
                            ->getOptionLabelFromRecordUsing(fn (Page $record): string => $record->getTranslation('title', app()->getLocale(), false) ?: 'Untitled')
                            ->searchable()
                            ->preload(),
                        Select::make('taxonomies')
                            ->relationship('taxonomies', 'name')
                            ->getOptionLabelFromRecordUsing(fn (Taxonomy $record): string => $record->getTranslation('name', app()->getLocale(), false) ?: 'Untitled')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        SpatieMediaLibraryFileUpload::make(Page::FEATURED_IMAGE_COLLECTION)
                            ->label('Featured image')
                            ->collection(Page::FEATURED_IMAGE_COLLECTION)
                            ->image()
                            ->responsiveImages()
                            ->imageEditor(),
                    ])
                    ->columnSpan(1),
            ]),
        ]);
    }

    private static function localeTab(string $locale, string $label): Tab
    {
        return Tab::make($label)->schema([
            TextInput::make("title.{$locale}")
                ->label('Title')
                ->required($locale === config('app.fallback_locale', 'en'))
                ->maxLength(180)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state): mixed => filled($state)
                    ? $set("slug.{$locale}", Str::slug($state))
                    : null),
            TextInput::make("slug.{$locale}")
                ->label('Slug')
                ->required($locale === config('app.fallback_locale', 'en'))
                ->maxLength(180),
            RichEditor::make("content.{$locale}")
                ->label('Content')
                ->columnSpanFull(),
            TextInput::make("seo_title.{$locale}")
                ->label('SEO title')
                ->maxLength(180),
            Textarea::make("seo_description.{$locale}")
                ->label('SEO description')
                ->rows(3)
                ->maxLength(320)
                ->columnSpanFull(),
        ])->columns(2);
    }
}
