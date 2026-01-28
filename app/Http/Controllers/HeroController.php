<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use App\Http\Requests\HeroRequest;
use App\Traits\ApiResponse;
use App\Http\Resources\HeroResource;

class HeroController extends Controller
{
    use ApiResponse;

    public function store(HeroRequest $request)
    {
        try{
            $hero = Hero::create($request->all());

            return $this->successResponse(
            new HeroResource($hero),
            'Hero created successfully',
            201
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Failed to create hero',
                $e->getMessage(),
                500
            );
        }

        
    }

    public function searchByName(string $heroName)
    {
        $hero = Hero::with('image')->where('name', 'LIKE', "%$heroName%")->firstOrFail();

        if(!$hero) {
            return $this->errorResponse(
                'Hero not found',
                "No hero found with the name {$heroName}",
                404
                );
        }

        $powerApiUrl = "https://www/api/powers/hero/{$hero->id}";
            $response = Http::get($powerApiUrl);
            $powerData = $response->successful() ? $response->json()['data'] : null;

            return $this->successResponse([
                'hero' => new HeroResource($hero),
                'hero_image' => $hero->image ? $hero->image->url : null,
                'powers' => $powerData
            ],
            'Hero retrieved successfully',
            200);

    }
}