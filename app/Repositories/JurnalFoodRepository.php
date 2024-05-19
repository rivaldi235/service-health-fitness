<?php

namespace App\Repositories;

use App\Models\Food;
use App\Models\JurnalFood;

class JurnalFoodRepository
{
    public function getJurnalFoods()
    {
        return JurnalFood::all();
    }

    public function createJurnalFood(array $jurnalFood)
    {
        return JurnalFood::create($jurnalFood);
    }

    public function getjurnalFood(string $id)
    {
        return JurnalFood::findOrFail($id);
    }

    public function updateJurnalFood(JurnalFood $jurnalFood, array $data)
    {
        $jurnalFood->update($data);
        return $jurnalFood;
    }

    public function deleteJurnalFood(JurnalFood $jurnalFood)
    {
        $jurnalFood->delete();
    }

    public function getFood(string $id)
    {
        return Food::findOrFail($id);
    }
}