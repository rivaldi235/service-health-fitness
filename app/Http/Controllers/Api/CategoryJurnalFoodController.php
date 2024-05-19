<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Service\CategoryJurnalFoodService;
use App\Http\Resources\ResponseErrorResource;
use App\Http\Resources\CategoryJurnalFoodResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryJurnalFoodController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryJurnalFoodService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = $this->categoryService->getCategories();
            return ResponseResource::jsonResponse('OK', 200, CategoryJurnalFoodResource::collection($categories));
        } catch (\Throwable $th) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $category = $this->categoryService->createCategory($request->all());
            return ResponseResource::jsonResponse('created', 201, (new CategoryJurnalFoodResource($category)));
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
            $category = $this->categoryService->getCategory($id);
            return ResponseResource::jsonResponse('OK', 200, (new CategoryJurnalFoodResource($category)));
        } catch (ModelNotFoundException $th) {
            return ResponseErrorResource::jsonResponse('Data Not Found', 404);
        } catch (\Throwable $e) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $category = $this->categoryService->updateCategory($id, $request->all());
            return ResponseResource::jsonResponse('updated', 201, (new CategoryJurnalFoodResource($category)));
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
            $category = $this->categoryService->deleteCategory($id);
            return ResponseResource::jsonResponse('OK', 200);
        } catch (ModelNotFoundException $th) {
            return ResponseErrorResource::jsonResponse('Data Not Found', 404);
        } catch (\Throwable $e) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
    }
}
