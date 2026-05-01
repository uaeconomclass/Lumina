<?php

declare(strict_types=1);

namespace App\Filament\Resources\Taxonomies\Tables;

use App\Enums\TaxonomyType;
use App\Models\Taxonomy;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TaxonomiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->state(fn (Taxonomy $record): string => $record->getTranslation('name', app()->getLocale(), false) ?: 'Untitled')
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->sortable(),
                TextColumn::make('pages_count')
                    ->counts('pages')
                    ->label('Pages'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(TaxonomyType::options()),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
