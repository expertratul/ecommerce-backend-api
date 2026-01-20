<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listCartProducts(Request $request)
    {
        try{
            $user_id = $request->header('id');
            $cartList = ProductCart::where('user_id', $user_id)->with('product')->get();
            return ResponseHelper::success($cartList, 'Product added to cart',200);
        
        }catch(\Exception $e){
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createCartProduct(Request $request)
    {
        try{
            $user_id = $request->header('id');
            $product_id = $request->input('product_id');
            $color = $request->input('color');
            $size = $request->input('size');
            $qty = $request->input('qty');

            $productDetails = Product::where('id', "=", $product_id)->first();
            $unitPrice = 0;

            if( $productDetails->discount == 1 ){
                $unitPrice = $productDetails->discount_price;
            }else{
                $unitPrice = $productDetails->price;
            }

            $totalPrice = $unitPrice * $qty;
            $productCart = ProductCart::updateOrCreate(
                [   "user_id" => $user_id,
                    "product_id" => $product_id
                ],
                [
                    "user_id" => $user_id,
                    "product_id" => $product_id,
                    "color" => $color,
                    "size" => $size,
                    "qty" => $qty,
                    "price" => $totalPrice,
                ],
            );
            return ResponseHelper::success(
                new CartResource($productCart),'Product added to cart',200
            );
            
        }catch(\Exception $e){
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteCartProduct(Request $request, $product_id)
    {
        try{
            $user_id = $request->header('id');
            $cartDelete = ProductCart::where('user_id', $user_id)->where('product_id', $product_id)->delete();

            if(!$cartDelete){
                return ResponseHelper::error('Invalid product ID not found in cart', 400);
            }
            return ResponseHelper::success($cartDelete, 'cart remove successfully', 200);
        
        }catch(\Exception $e){
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }
}
