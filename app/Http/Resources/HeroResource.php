<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'name' => $this->name,
            'age' => $this->age,
            'color' => $this->color,
            'gender' =>$this->gender,
            'hero_image' => $this->image ? $this->image->url : null,
        ];
    }
}
