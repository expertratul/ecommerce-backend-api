<?php

namespace App\Helpers;

use App\Models\Invoice;
use App\Models\SSLCommerzAccount;
use Exception;
use Illuminate\Support\Facades\Http;

class SSLCommerz {
    public static function InitiatePayment ($user_email, $trans_id, $profile, $payable){
        try{
            $ssl= SSLCommerzAccount::first();

            $response = Http::asForm()->post($ssl->init_url,[
              "store_id"=>$ssl->store_id,
              "store_passwd"=>$ssl->store_passwd,
              "total_amount"=>$payable,
              "currency"=>$ssl->currency,
              "tran_id"=>$trans_id,
              "success_url"=>"$ssl->success_url?tran_id=$trans_id",
              "fail_url"=>"$ssl->fail_url?tran_id=$trans_id",
              "cancel_url"=>"$ssl->cancel_url?tran_id=$trans_id",
              "ipn_url"=>$ssl->ipn_url,
              "cus_name"=>$profile->cus_name,
              "cus_email"=>$user_email,
              "cus_add1"=>$profile->cus_add,
              "cus_add2"=>$profile->cus_add,
              "cus_city"=>$profile->cus_city,
              "cus_state"=>$profile->cus_city,
              "cus_postcode"=>"1200",
              "cus_country"=>$profile->cus_country,
              "cus_phone"=>$profile->cus_phone,
              "cus_fax"=>$profile->cus_phone,
              "shipping_method"=>"YES",
              "ship_name"=>$profile->ship_name,
              "ship_add1"=>$profile->ship_add,
              "ship_add2"=>$profile->ship_add,
              "ship_city"=>$profile->ship_city,
              "ship_state"=>$profile->ship_city,
              "ship_country"=>$profile->ship_country ,
              "ship_postcode"=>"12000",
              "product_name"=>"My Ecommerce Product",
              "product_category"=>"My Ecommerce Category",
              "product_profile"=>"My Ecommerce Profile",
              "product_amount"=>$payable,
          ]);

            return $response->json('desc');

        }catch(Exception $e){
            return $ssl;
        }
    }

    static function InitiateSuccess($trans_id):int
    {
        Invoice::where(["tran_id" => $trans_id, "val_id" => 0])->update(["payment_status" => "success"]);
        return 1;
    }

    static function InitiateCancel($trans_id):int
    {
        Invoice::where(["tran_id" => $trans_id, "val_id" => 0])->update(["payment_status" => "cancel"]);
        return 1;
    }

    static function InitiateFail($trans_id):int
    {
        Invoice::where(["tran_id" => $trans_id, "val_id" => 0])->update(["payment_status" => "fail"]);
        return 1;
    }


    static function InitiateIPN($trans_id, $status, $val_id)
    {
        Invoice::where(["tran_id" => $trans_id, "val_id" => 0])->update(["payment_status" => $status, "val_id" => $val_id]);
        return 0;
    }

}