<?php

namespace App\Http\Controllers\Api;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::Select('id', 'name', 'carbo', 'fat', 'protein', 'calories')
                     ->limit(10)
                     ->get();
                    
        return response()->json([
            'message' => 'OK',
            'status' => 200,
            'data' => FoodResource::collection($foods),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'carbo' => 'required',
            'fat' => 'required',
            'protein' => 'required',
            'calories' => 'required',
        ]);

        $food = Food::create([
            'name' => $request->name,
            'carbo' => $request->carbo,
            'fat' => $request->fat,
            'protein' => $request->protein,
            'calories' => $request->calories,
        ]);

        return response()->json([
            'message' => 'Created',
            'status' => 201,
            'data' => (new FoodResource($food)),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $food = Food::findOrFail($id);

        return response()->json([
            'message' => 'OK',
            'status' => 200,
            'data' => (new FoodResource($food)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'carbo' => 'required',
            'fat' => 'required',
            'protein' => 'required',
            'calories' => 'required',
        ]);

        $food = Food::findOrFail($id);

        $food->update([
            'name' => $request->name,
            'carbo' => $request->carbo,
            'fat' => $request->fat,
            'protein' => $request->protein,
            'calories' => $request->calories,
        ]);

        return response()->json([
            'message' => 'Created',
            'status' => 201,
            'data' => (new FoodResource($food)),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = Food::findOrFail($id);

        $food->delete();

        return response()->json([
            'message' => 'Data Successfuly Deleted',
            'status' => 200,
        ]);
    }
}
