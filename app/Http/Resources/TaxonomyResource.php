<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Taxonomy */
class TaxonomyResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type->value,
            'name' => $this->getTranslation('name', app()->getLocale(), false),
            'slug' => $this->getTranslation('slug', app()->getLocale(), false),
        ];
    }
}
