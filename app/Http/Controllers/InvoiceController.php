<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Helpers\SSLCommerz;
use App\Models\CustomerProfile;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\ProductCart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function invoiceList(Request $request)
    {
        try{
            $user_id = $request->header('id');

            if(!$user_id){
                return ResponseHelper::error('User ID not found.', 400);
            }

            $invoice = Invoice::where('user_id', $user_id)->get();
            return ResponseHelper::success($invoice, 'success', 200);

        }catch(Exception $e){
            return ResponseHelper::error('Internal Server Error', 500);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function invoiceCreate(Request $request)
    {
        DB::beginTransaction();

        try{
            $user_id = $request->header('id');
            $user_email = $request->header('email');
            $trans_id = uniqid();
            $delivery_status = 'pending';
            $payment_status = 'pending';

            $profile = CustomerProfile::where("user_id", $user_id)->first();

            if (!$profile) {
                return ResponseHelper::error("Customer profile not found", 404);
            }

            $cus_details = "
                Name: $profile->cus_name, Address: $profile->cus_add, City: $profile->cus_city, Phone: $profile->cus_phone,
            ";

            $ship_details = "
                Name: $profile->ship_name, Address: $profile->ship_add, City: $profile->ship_city, Phone: $profile->cus_phone,
            ";

            $total = 0;
            $cartList = ProductCart::where("user_id", $user_id)->get();

            foreach($cartList as $cartItem){
                $total = $total + $cartItem->price ;
            }

            $vat = ($total * 5)/100;
            $payable = $total + $vat;

            $invoice = Invoice::create([
                "user_id" => $user_id,
                "tran_id" => $trans_id,
                "delivery_status" => $delivery_status,
                "payment_status" => $payment_status,
                "cus_details" => $cus_details,
                "ship_details" => $ship_details,
                "total" => $total,
                "vat" => $vat,
                "payable" => $payable,
            ]);

            $invoiceID = $invoice->id;

            foreach($cartList as $eachProduct){
                InvoiceProduct::create([
                    "invoice_id" => $invoiceID,
                    "product_id" => $eachProduct['product_id'],
                    "user_id" => $user_id,
                    "qty" => $eachProduct['qty'],
                    "sale_price" => $eachProduct['price'],
                ]);
            }

            $paymentMethod = SSLCommerz::InitiatePayment($profile, $payable, $trans_id, $user_email);
            DB::commit();

            return ResponseHelper::success(array([
                "paymentMethod" => $paymentMethod,"payable" => $payable,"vat" => $vat,"total" => $total,
            ]), 200);

        }catch(Exception $e){
            DB::rollBack();
            return ResponseHelper::error('Internal Server Error ', 500);
        }
    }

    public function InvoiceProductList(Request $request)
    {
        $user_id = $request->header('id');
        $invoice_id = $request->invoice_id;

        return InvoiceProduct::where(['user_id'=> $user_id, 'invoice_id'=> $invoice_id])->with('product')->get();
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function invoiceDelete(string $id)
    {
        //
    }
}
