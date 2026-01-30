<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class PlanetResource extends JsonResource
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
            'name' => $this->name,
            'color' => $this->color,
            'description' => $this->description,
            'hero_id' => $this->hero_id,
            'power_id' => $this->power_id,
            'image' => $this->whenLoaded('image', function () {
                return [
                    'id' => $this->image->id,
                    'url' => $this->image->url
                ];
            }),
            'created_at' => $this->created_at,
        ];
    }
}
