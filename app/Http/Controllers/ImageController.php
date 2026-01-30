<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planet;
use App\Traits\ApiResponse;
use App\Http\Resources\PlanetResource;

class ImageController extends Controller
{
    use ApiResponse;

    public function storeForPlanet(Request $request, Planet $planet)
    {
        try {
            $request->validate([
                'image_url' => 'required|url'
            ]);

            if ($planet->image) {
                $planet->image->update([
                    'url' => $request->image_url
                ]);
            } else {
                $planet->image()->create([
                    'url' => $request->image_url
                ]);
            }

            return $this->successResponse(
                new PlanetResource($planet->load('image')),
                'Planet image stored successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Failed to store planet image',
                $e->getMessage(),
                500
            );
        }
    }
}
