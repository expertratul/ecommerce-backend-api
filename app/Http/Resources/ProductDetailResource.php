<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'         => $this->id,
            'img1'       => $this->img1,
            'img2'       => $this->img2,
            'img3'       => $this->img3,
            'img4'       => $this->img4,
            'des'        => $this->des,
            'color'      => $this->color,
            'size'       => $this->size,
            'product_id' => $this->product_id
        ];
    }
}
