<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\categoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function categoryList()
    {
        $category = Category::all();
        $data = CategoryResource::collection($category);
        return ResponseHelper::success($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function categoryStore(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function categoryShow(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function categoryUpdate(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function categoryDestroy(string $id)
    {
        //
    }
}
