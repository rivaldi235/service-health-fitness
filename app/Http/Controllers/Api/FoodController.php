<?php

namespace App\Http\Controllers\Api;

use App\Models\Food;
use App\Service\FoodService;
use Illuminate\Http\Request;
use App\Http\Requests\FoodRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\ResponseErrorResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FoodController extends Controller
{

    protected $foodService;

    public function __construct(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $foods = $this->foodService->getFoods();
            return ResponseResource::jsonResponse('OK', 200, FoodResource::collection($foods));
        } catch (\Throwable $th) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FoodRequest $request)
    {
        try {
            $food = $this->foodService->createFood($request->all());
            return ResponseResource::jsonResponse('created', 201, (new FoodResource($food)));
        } catch (\Throwable $th) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $food = $this->foodService->getFood($id);
            return ResponseResource::jsonResponse('OK', 200, (new FoodResource($food)));
        } catch (ModelNotFoundException $th) {
            return ResponseErrorResource::jsonResponse('Data Not Found', 404);
        } catch (\Throwable $e) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FoodRequest $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'carbo' => 'required',
            'fat' => 'required',
            'protein' => 'required',
            'calories' => 'required',
        ]);

        try {
            $food = $this->foodService->updateFood($id, $request->all());
            return ResponseResource::jsonResponse('updated', 201, (new FoodResource($food)));
        } catch (ModelNotFoundException $th) {
            return ResponseErrorResource::jsonResponse('Data Not Found', 404);
        } catch (\Throwable $e) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $food = $this->foodService->deleteFood($id);
            return ResponseResource::jsonResponse('OK', 200);
        } catch (ModelNotFoundException $th) {
            return ResponseErrorResource::jsonResponse('Data Not Found', 404);
        } catch (\Throwable $e) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
        
    }
}
