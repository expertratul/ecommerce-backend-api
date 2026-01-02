<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\ProductResource;
use App\Models\ProductSlider;

class ProductController extends Controller
{
    /**
     * Get product list by category ID.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function productListByCategory(Request $request)
    {
        $productsCategoryList = Product::where('category_id', $request->id)->with('brand', 'category')->get();
        
        $data = ProductResource::collection($productsCategoryList);
        return ResponseHelper::success($data);
        
    }

    /**
     * Get product list by brand ID.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function productListByBrand(Request $request)
    {
        $productsBrandList = Product::where('brand_id', $request->id)->with('brand', 'category')->get();
        
        $data = ProductResource::collection($productsBrandList);
        return ResponseHelper::success($data);
    }
    
    /**
     * Get product list by remark.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function productListByRemark(Request $request)
    {
        $productsRemarkList = Product::where('remark', $request->remark)->with('brand', 'category')->get();
        
        $data = ProductResource::collection($productsRemarkList);
        return ResponseHelper::success($data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
