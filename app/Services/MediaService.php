<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaService
{
    /** @return Builder<Media> */
    public function query(): Builder
    {
        return Media::query()->latest();
    }

    public function delete(Media $media): void
    {
        $media->delete();
    }

    public function temporaryDownloadUrl(Media $media): string
    {
        return $media->getFullUrl();
    }

    public function cleanupOrphans(): int
    {
        $orphans = Media::query()
            ->whereNull('model_id')
            ->orWhereNull('model_type')
            ->get();

        $orphans->each->delete();

        return $orphans->count();
    }
}
