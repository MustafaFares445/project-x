<?php

namespace App\Http\Resources;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Content */
class ContentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'json' => $this->json,
            'files' => MediaResource::collection($this->whenLoaded('media')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
