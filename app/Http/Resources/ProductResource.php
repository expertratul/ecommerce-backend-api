<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'title' => $this->title,
            'short_des' => $this->short_des,
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_price' => $this->discount_price,
            'image' => $this->image,
            'stock' => $this->stock,
            'star' => $this->star,
            'remark' => $this->remark,
        ];
    }
}
