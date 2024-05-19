<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JurnalFoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category_id' => $this->category_id,
            'food_id' => $this->food_id,
            'user_id' => $this->user_id,
            'total_serving' => $this->total_serving,
            'total_calory' => $this->total_calory,
        ];
    }
}
