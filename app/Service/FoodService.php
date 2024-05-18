<?php

namespace App\Service;

use App\Repositories\FoodRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

Class FoodService
{
    protected $foodRepository;

    public function __construct(FoodRepository $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }

    public function getFoods()
    {
        $foods = $this->foodRepository->getFoods();
        return $foods;
    }

    public function createFood(array $data)
    {
        $food = $this->foodRepository->createFood($data);
        return $food;
    }

    public function getFood(string $id)
    {
        $food = $this->foodRepository->getFoodById($id);
        return $food;
    }

    public function updateFood(string $id, array $data)
    {
        $food = $this->getFood($id);
        $food = $this->foodRepository->updateFood($food, $data);
        return $food;
    }

    public function deleteFood(string $id)
    {
        $food = $this->getFood($id);
        $this->foodRepository->deleteFood($food);
    }
}