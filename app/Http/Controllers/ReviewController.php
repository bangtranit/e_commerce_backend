<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewProduct;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Review\ReviewResource;

class ReviewController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return ReviewResource
     */
    public function index(Product $product)
    {
        //
        return new ReviewResource($product->reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ReviewResource
     */
    public function store(ReviewProduct $request, Product $product)
    {
        $validated = $request->validated();
        $request['user_id'] = $this->user->id;
        $request['product_id'] = $product->id;
        $review = new Review($request->all());
        $product->reviews()->save($review);
        return new ReviewResource($product->reviews);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Review $review)
    {
        return $review;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Review  $review
     * @return ReviewResource
     */
    public function update(Request $request, Product $product, Review $review)
    {
        //
        $review->update($request->all());
        return new ReviewResource($product->reviews);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return ReviewResource
     */
    public function destroy(Product $product, Review $review)
    {
        $review->delete();
        return new ReviewResource($product->reviews);
    }
}
