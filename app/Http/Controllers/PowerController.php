<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Power;
use App\Http\Resources\PowerResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\PowerRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Http;

class PowerController extends Controller
{

    use ApiResponseTrait;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $powers = Power::all();
        return PowerResource::collection($powers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PowerRequest $request)
    {
        $power = $request->validated() ;
        Power::create($power);

        $data = new PowerResource($power);

        Http::post ('https://sandee-tweediest-sasha.ngrok-free.dev/powers',[
            'hero_id' => $power['hero_id'],
            'name' => $power['name'],
            'level' => $power['level'],
        ]);

        return $this->response($data, 'Power created successfully', 201);
    }

    /**

    mjhgf     */
    public function show(string $id)
    {
        $hero = Power::all()->where('hero_id',$id)->first();
        $data = new PowerResource($hero);

        if(!$hero){
            return $this->response(null,"Hero doesn't exist",404);
        }

        return $this->response($data,'Power retrieved successfully',200);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
