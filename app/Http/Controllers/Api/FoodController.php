<?php

namespace App\Http\Controllers\Api;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $foods = Food::Select('id', 'name', 'carbo', 'fat', 'protein', 'calories')
                     ->limit(10)
                     ->get();
            return response()->json([
                'message' => 'OK',
                'status' => 200,
                'data' => FoodResource::collection($foods),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
            ], 500);
        }
        
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

        try {
            $food = Food::create([
                'name' => $request->name,
                'carbo' => $request->carbo,
                'fat' => $request->fat,
                'protein' => $request->protein,
                'calories' => $request->calories,
            ], 201);

            return response()->json([
                'message' => 'Created',
                'status' => 201,
                'data' => (new FoodResource($food)),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
            ], 500);
        }

        

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $food = Food::findOrFail($id);

            return response()->json([
                'message' => 'OK',
                'status' => 200,
                'data' => (new FoodResource($food)),
            ]);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ], 400);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
            ], 500);
        }
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

        try {
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
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ], 400);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $food = Food::findOrFail($id);

            $food->delete();

            return response()->json([
                'message' => 'Data Successfuly Deleted',
                'status' => 200,
            ]);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ], 400);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
            ], 500);
        }
        
    }
}
