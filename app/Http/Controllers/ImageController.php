<?php

namespace App\Http\Controllers;

use App\Models\Power;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class ImageController extends Controller
{
    use ApiResponse;

    public function store(Request $request, $powerId)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $power = Power::find($powerId);

        if (! $power) {
            return $this->errorResponse(
                'Power not found',
                "No power found with ID {$powerId}",
                404
            );
        }

        $image = $power->image()->updateOrCreate(
            [],
            ['url' => $request->url]
        );

        return $this->successResponse(
            $image,
            'Image saved successfully',
            201
        );
    }
}
