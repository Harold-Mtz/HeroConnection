<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Power;
use Illuminate\Http\Request;
use App\Http\Requests\PowerRequest;
use App\Traits\ApiResponse;
use App\Http\Resources\PowerResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PowerController extends Controller
{
    use ApiResponse;
    /**
     * Store a newly created resource in storage.
     */
    public function store(PowerRequest $request)
    {
        Log::info('Power Request', ['body' => $request->all()]);
        $powerData = $request->input('power');

        $power = Power::create([
            'hero_id' => $request->hero_id,
            'name'    => $powerData['name'],
            'level'   => $powerData['level'],
        ]);

        $power->image()->create([
            'url' => $powerData['url'] ?? null,
            ]
        );

        $authResponse = Http::post(
            'https://pregnable-lucinda-pseudolaminated.ngrok-free.dev/api/login',

            [
                'email' => 'test@example.com',
                'password' => 'password'
            ]);

        $powerToken = $authResponse->json()['data']['token'];

            $response = Http::whithToken($powerToken)->withOptions(['verify'=>false ])->post(
                'https://pregnable-lucinda-pseudolaminated.ngrok-free.dev/api/planets',
                [
                    'planet'=>[
                        'hero_id' => $request->hero_id,
                        'name' => $request->input('planet.name'),
                        'color' => $request->input('planet.color'),
                        'description' => $request->input('planet.description'),
                    ]
                ]
            );

            if (! $response->successful()) {
                return $this->errorResponse(
                    'Planet API Error',
                    'Failed to create planet',
                    500
                );
            }

        $planetData = $response->json();

            Log::info('Planet Data', ['data' => $planetData]);

        Log::info('POWER DATA', ['data' => $powerData]);

        return $this->successResponse([
            'power'  => new PowerResource($power),
            //'planet'=> $planetData['data'],
        ], null, 201);
    }

    public function getByHero(int $heroId)
    {
        $powers = Power::where('hero_id', $heroId)
            ->with('image')
            ->get();

        $response = Http::get(
            "https://pregnable-lucinda-pseudolaminated.ngrok-free.dev/api/planets/search/{$heroId}"
        );

        $planet = $response->successful()
            ? $response->json('data')
            : null;

        if ($powers->isEmpty()) {
            return $this->successResponse(
                [],
                'No powers found for this hero',
                200
            );
        }

        Log::info('Power Data', ['data' => $powers]);

        return $this->successResponse([
            'powers' => PowerResource::collection($powers),
            'planet' => $planet
        ]);
    }
}
