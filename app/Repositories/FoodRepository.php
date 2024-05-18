<?php

namespace App\Repositories;

use App\Models\Food;

class FoodRepository
{
    public function getFoods()
    {
        return Food::select('id', 'name', 'carbo', 'fat', 'protein', 'calories')
                    ->limit(10)
                    ->get();
    }

    public function createFood(array $food)
    {
        return Food::create($food);
    }

    public function getFoodById(string $id)
    {
        return Food::findOrFail($id);
    }

    public function updateFood(Food $food, array $data)
    {
        $food->update($data);
        return $food;
    }

    public function deleteFood(Food $food)
    {
        $food->delete();
    }
}