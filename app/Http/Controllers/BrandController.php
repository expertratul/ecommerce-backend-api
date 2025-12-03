<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function brandList()
    {
        $brand = Brand::all();
        $data = BrandResource::collection($brand);
        return ResponseHelper::success($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function brandStore(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function brandShow(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function brandUpdate(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function brandDestroy(string $id)
    {
        //
    }
}
