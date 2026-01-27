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
        return $this->successResponse(
            new HeroResource(Hero::create($request->all())),
            'Hero created successfully',
            201
            );
    }

    public function searchByName(string $hero)
    {
        $heroes = Hero::where('name', 'LIKE', "%$hero%")->get();

        return $this->successResponse(
            HeroResource::collection($heroes),
            'Heroes retrieved successfully',
            200
        );
    }
}