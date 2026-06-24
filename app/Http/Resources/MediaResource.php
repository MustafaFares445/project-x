<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->file_name,
            'fileName' => $this->file_name,
            'collection' => $this->collection_name,
            'url' => $this->getUrl(),
            'size' => $this->human_readable_size,
            'mimeType' => $this->mime_type,
            'extension' => $this->extension,
            'type' => $this->getTypeFromExtension(),
            'caption' => $this->getCustomProperty('caption') ?? $this->name,
            'duration' => $this->getCustomProperty('duration'),
            'createdAt' => $this->created_at->toDateTimeString(),
        ];
    }
}
