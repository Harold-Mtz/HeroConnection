<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PowerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'hero_id' => $this->hero_id,
            'name' => $this->name,
            'level' => $this->level,
            'power_image'=> $this->image ? $this->image->url:null
        ];
    }
}
