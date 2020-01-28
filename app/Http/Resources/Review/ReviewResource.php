<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->map(function($product) {
            return [
                'user_name' => $product->user->name,
                'product_name' => $product->product->name,
                'body' => $product->review,
                'star' => $product->star,
            ];
        });
    }
}
