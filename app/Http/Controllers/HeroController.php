<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use App\Http\Requests\HeroRequest;
use App\Traits\ApiResponse;
use App\Http\Resources\HeroResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HeroController extends Controller
{
    use ApiResponse;

    public function store(HeroRequest $request)
    {
        Log::info('HERO REQUEST', [
        'body' => $request->all()
    ]);

        $heroData = $request->input('hero');

        $hero = Hero::create([
            'name' => $heroData['name'],
            'age' => $heroData['age'],
            'color' => $heroData['color'],
            'gender' => $heroData['gender'],
        ]);   

        $hero->image()->create([
            'url' => $heroData['url'] ?? null,
        ]);

        $payload = [
            'hero_id' => $hero->id,
            'power' => $request->input('power'),
            'planet' => $request->input('planet'),
        ];

        $authResponse = Http::post(
            'https://sandee-tweediest-sasha.ngrok-free.dev/api/login',

            [
                'email' => 'test@example.com',
                'password' => 'password'
                ]);
                
        $powerToken = $authResponse->json()['data']['token'];


        $response = Http::withToken($powerToken)->withOptions(['verify' => false])->post('https://sandee-tweediest-sasha.ngrok-free.dev/api/powers', $payload);
           
            Log::info('POWER RESPONSE STATUS', [
        'status' => $response->status()
    ]);

        if (! $response->successful()) {
            return $this->errorResponse(
                'External Power API Error',
                'Failed to create hero powers in external API.',
                500
            );
        }

        $powerData = $response->json();

        log::info('Power Data: ', ['data' => $powerData]);

        return $this->successResponse([
            'hero' => new HeroResource($hero),
            'power' => $powerData['data'],
        ]);
    }

    public function searchByName(string $heroName)
    {
        $hero = Hero::with('image')->where('name', 'LIKE', "%$heroName%")->firstOrFail();

        $powerApiUrl = "https://sandee-tweediest-sasha.ngrok-free.dev/api/powers/{$hero->id}";
        $response = Http::get($powerApiUrl);

        Log::info('Power API raw response', [
            'status' => $response->status(),
            'body'   => $response->json()
            ]);

            $powerData = [];
            if ($response->successful()) {
                $powerData = $response->json('data') ?? [];
            }

            return $this->successResponse([
                'hero' => new HeroResource($hero),
                
                'powers' => $powerData
            ],
            'Hero retrieved successfully',
            200);
    }
}