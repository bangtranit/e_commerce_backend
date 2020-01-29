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
        return $this->map(function($review) {
            return [
                'id' => $review->id,
                'user_name' => $review->user->name,
                'product_name' => $review->product->name,
                'review' => $review->review,
                'star' => $review->star,
            ];
        });
    }
}
