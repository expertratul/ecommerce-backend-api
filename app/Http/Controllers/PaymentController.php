<?php

namespace App\Http\Controllers;

use App\Helpers\SSLCommerz;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function paymentSuccess(Request $request)
    {
        $tran_id = $request->query('tran_id');

        if (!$tran_id) {
            return redirect('/profile')->with('error', 'Invalid Transaction ID');
        }
        SSLCommerz::InitiateSuccess($tran_id);

        return redirect('/profile')->with('success', 'Payment Successful');
    }

    /**
     * Show the form for creating a new resource.
     */
    function paymentCancel(Request $request)
    {
        $tran_id = $request->query('tran_id');
        SSLCommerz::InitiateCancel($tran_id);

        return redirect('/profile');
    }

    /**
     * Store a newly created resource in storage.
     */
    function paymentFail(Request $request)
    {
        $tran_id = $request->query('tran_id');
        SSLCommerz::InitiateFail($tran_id);

        return redirect('/profile');
    }

    /**
     * Display the specified resource.
     */
    function paymentIPN(Request $request)
    {
        $trans_id = $request->input("tran_id");
        $status = $request->input("status");
        $val_id = $request->input("val_id");

        SSLCommerz::InitiateIPN($trans_id, $status, $val_id);
        return ResponseHelper::success("success", 200);
    }

    
}
