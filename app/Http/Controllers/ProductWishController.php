<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\WishListResource;
use App\Models\ProductWish;
use Illuminate\Http\Request;

class ProductWishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function productWishList(Request $request)
    {
        try{
            $user_id = $request->header('id');
            $wishList = ProductWish::where('user_id', $user_id)->with('product')->get();

            $data = WishListResource::collection($wishList);
            return ResponseHelper::success($data, 'successfully Listing', 200);

        }catch(\Exception $e){
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function productWishCreate(Request $request)
    {
        try{
            $user_id = $request->header('id');
            $product_id = $request->product_id;

            if(!$product_id){
                return ResponseHelper::error('Product ID is required', 400);
            }

            $wishCreate = ProductWish::updateOrCreate([
                'user_id' => $user_id,
                'product_id' => $product_id,
            ]);

            $data = new WishListResource($wishCreate);
            return ResponseHelper::success($data, 'Product added to wishlist successfully');

        }catch(\Exception $e){
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function productWishDelete(Request $request)
    {
        try{
            $user_id = $request->header('id');
            $product_id = $request->product_id;

            $wishDelete = ProductWish::where('user_id', $user_id)->where('product_id', $product_id)->delete();

            if (!$wishDelete) {
                return ResponseHelper::error('Product ID is required', 422);
            }
            return ResponseHelper::success($wishDelete, 'WishList successfully Remove', 200);

        }catch(\Exception $e){
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }
}
