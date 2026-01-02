<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductSlider;
use App\Helpers\ResponseHelper;
use App\Http\Resources\ProductSliderResource;

class ProductSliderController extends Controller
{
    public function productListSlider()
    {
        $productListSlider = ProductSlider::all();
        
        $data = ProductSliderResource::collection($productListSlider);
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
