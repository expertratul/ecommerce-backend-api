<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WishListResource extends JsonResource
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
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,

            'product' => [
                'id' => $this->product->id ?? null,
                'category_id' => $this->product->category_id ?? null,
                'brand_id' => $this->product->brand_id ?? null,
                'title' => $this->product->title ?? null,
                'short_des' => $this->product->short_des ?? null,
                'price' => $this->product->price ?? null,
                'discount' => $this->product->discount ?? null,
                'discount_price' => $this->product->discount_price ?? null,
                'image' => $this->product->image ?? null,
                'stock' => $this->product->stock ?? null,
                'star' => $this->product->star ?? null,
                'remark' => $this->product->remark ?? null,
            ],
        ];
    }
}
