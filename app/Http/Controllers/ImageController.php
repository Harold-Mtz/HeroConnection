<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class ImageController extends Controller
{
    use ApiResponse;

    public function store(Request $request, $heroId)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $hero = Hero::find($heroId);
        if (!$hero) {
            return $this->errorResponse(
                'Hero not found',
                "No hero found with the ID {$heroId}",
                404
            );
        }

        $image = $$hero->image()->updateOrCreate(
            ['imageable_id' => $heroId, 'imageable_type' => Hero::class],
            ['url' => $request->url]
        );

        return $this->successResponse(
            $image,
            'Image saved successfully',
            201
        );
    }
}
