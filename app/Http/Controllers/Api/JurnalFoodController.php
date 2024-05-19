<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Service\JurnalFoodService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\JurnalFoodResource;

class JurnalFoodController extends Controller
{

    protected $jurnalFoodService;
    
    public function __construct(JurnalFoodService $jurnalFoodService)
    {
        $this->jurnalFoodService = $jurnalFoodService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurnalFoods = $this->jurnalFoodService->getJurnalFoods();
        return ResponseResource::jsonResponse('OK', 200, JurnalFoodResource::collection($jurnalFoods));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jurnalFood = $this->jurnalFoodService->createJurnalFood($request->all());
        return ResponseResource::jsonResponse('created', 201, (new JurnalFoodResource($jurnalFood)));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jurnalFood = $this->jurnalFoodService->getJurnalFood($id);
        return ResponseResource::jsonResponse('OK', 200, (new JurnalFoodResource($jurnalFood)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jurnalFood = $this->jurnalFoodService->updateJurnalFood($id, $request->all());
        return ResponseResource::jsonResponse('Updated', 201, (new JurnalFoodResource($jurnalFood)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurnalFood = $this-> jurnalFoodService->deleteJurnalFood($id);
        return ResponseResource::jsonResponse('OK', 200);
    }
}
