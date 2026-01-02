<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'product_id' => $this->product_id,
            'description' => $this->description,
            'rating' => $this->rating,
            'customer' => [
                'id' => optional($this->profile)->id,
                'name' => optional($this->profile)->cus_name,
            ],
        ];
    }
}
