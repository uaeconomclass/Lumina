<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Services\MediaService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedTable;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibrary extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Media Library';

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    public function table(Table $table): Table
    {
        return $table
            ->query(app(MediaService::class)->query())
            ->columns([
                ImageColumn::make('preview')
                    ->state(fn (Media $record): string => $record->getFullUrl())
                    ->square(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('collection_name')
                    ->badge()
                    ->sortable(),
                TextColumn::make('mime_type')
                    ->toggleable(),
                TextColumn::make('size')
                    ->formatStateUsing(fn (int $state): string => number_format($state / 1024, 1).' KB')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                DeleteAction::make(),
            ]);
    }

    /** @return array<Action> */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('cleanup')
                ->label('Clean orphaned files')
                ->requiresConfirmation()
                ->action(function (MediaService $media): void {
                    $count = $media->cleanupOrphans();

                    Notification::make()
                        ->success()
                        ->title("Deleted {$count} orphaned media records")
                        ->send();
                }),
        ];
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            EmbeddedTable::make(),
        ]);
    }
}
