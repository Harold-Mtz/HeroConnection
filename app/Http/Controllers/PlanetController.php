<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PlanetRequest;
use App\Models\Planet;
use App\Traits\ApiResponse;
use App\Http\Resources\PlanetResource;

class PlanetController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $planets = Planet::with('image')->get();

        return $this->successResponse(
            PlanetResource::collection($planets),
            'Planets retrieved successfully',
            200
        );
    }

    public function store(PlanetRequest $request)
    {
        try {
            $planet = Planet::create(
                $request->only([
                    'name',
                    'color',
                    'description',
                    'hero_id',
                    'power_id'
                ])
            );

            if ($request->filled('image_url')) {
                $planet->image()->create([
                    'url' => $request->image_url
                ]);
            }

            return $this->successResponse(
                new PlanetResource($planet->load('image')),
                'Planet created successfully',
                201
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                'Failed to create planet',
                $e->getMessage(),
                500
            );
        }
    }

    public function show(Planet $planet)
    {
        return $this->successResponse(
            new PlanetResource($planet->load('image')),
            'Planet retrieved successfully',
            200
        );
    }
}
