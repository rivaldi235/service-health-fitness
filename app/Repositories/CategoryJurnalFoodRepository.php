<?php

namespace App\Repositories;

use App\Models\CategoryJurnalFood;

class CategoryJurnalFoodRepository
{
    public function getCategories()
    {
        return CategoryJurnalFood::all();
    }

    public function createCategory(array $category)
    {
        return CategoryJurnalFood::create($category);
    }

    public function getCategoryById(string $id)
    {
        return CategoryJurnalFood::findOrFail($id);
    }

    public function updateCategory(CategoryJurnalFood $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function deleteCategory(CategoryJurnalFood $category)
    {
        $category->delete();
    }
}