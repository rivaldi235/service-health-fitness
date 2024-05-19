<?php

namespace App\Service;

use App\Repositories\JurnalFoodRepository;

class JurnalFoodService
{
    protected $jurnalFoodRepository;

    public function __construct(JurnalFoodRepository $jurnalFoodRepository)
    {
        $this->jurnalFoodRepository = $jurnalFoodRepository;
    }

    public function getJurnalFoods()
    {
        $jurnalFoods = $this->jurnalFoodRepository->getJurnalFoods();
        return $jurnalFoods;
    }

    public function createJurnalFood(array $data)
    {
        $food = $this->jurnalFoodRepository->getFood($data['food_id']);

        $totalCalories = $food->calories * $data['total_serving'];
        $data['total_calory'] = $totalCalories;

        $jurnalFood = $this->jurnalFoodRepository->createJurnalFood($data);
        return $jurnalFood;
    }

    public function getJurnalFood(string $id)
    {
        $jurnalFood = $this->jurnalFoodRepository->getJurnalFood($id);
        return $jurnalFood;
    }

    public function updateJurnalFood(string $id, array $data)
    {
        $jurnalFood = $this->getJurnalFood($id);
        $jurnalFood = $this->jurnalFoodRepository->updateJurnalFood($data);
        return $jurnalFood;
    }

    public function deleteJurnalFood(string $id)
    {
        $jurnalFood = $this->jurnalFoodRepository->deleteJurnalFood($id);
        return $jurnalFood;
    }
}