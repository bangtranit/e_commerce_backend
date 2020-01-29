<?php

namespace App\Http\Controllers;

use App\Model\Product;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exceptions\ProductNotBelongsToUser;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return new ProductCollection(Product::all());
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
     * @return ProductResource
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->user_id = Auth::id();
        $product->save();
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        //
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\Product $product
     * @return ProductResource
     * @throws ProductNotBelongsToUser
     */
    public function update(Request $request, Product $product)
    {
        $this->productUserCheck($product);
        if ($request->has('description')){
            $request['detail'] = $request->description;
            unset($request['description']);
        }
        $request['user_id'] = Auth::id();
        $product->update($request->all());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Product $product
     * @return Product
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        //
        $this->productUserCheck($product);
        $product->delete();
        return $product;
    }

    public function productUserCheck(Product $product){
        if (Auth::id() !== $product->user_id){
            echo "ko trung";
            return;
        }
    }
}
