<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\OTPMail;
use App\Helpers\JWTToken;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function userLogin(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required|email'
            ]);

            $email = $request->email;
            $otp   = random_int(100000, 999999);
            $details = ['code' => $otp];

            User::updateOrCreate(
                ['email' => $email],
                ['otp' => $otp]
            );

            Mail::to($email)->send(new OTPMail($details));

            return ResponseHelper::success(
                'success',
                "A 6 digit OTP has been sent to your email address",
                200
            );
        }catch (Exception $e) {
            return response()->json([
                'status'  => 'Failed',
                'message' => ''.$e->getMessage(),

            ], 500);
        }
    }


    //verify OTP
    public function verifyLogin(Request $request)
    {
        try {

            // 1. Validation
            $request->validate([
                'email' => 'required|email',
                'otp'   => 'required|min:6'
            ]);

            $userEmail = $request->input('email');
            $otp       = $request->input('otp');

            // 2. Verify User
            $user = User::where('email', $userEmail)->where('otp', $otp)->first();

            if (!$user) {
                return ResponseHelper::error(
                    'Invalid OTP or Email',
                    401
                );
            }

            // 3. Clear OTP
            User::where('email',$userEmail)->where('otp',$otp)->update(['otp'=>'0']);

            $token = JWTToken::CreateToken($userEmail, $user->id);

            // 5. Success Response
            return ResponseHelper::success(
                'success',
                'Login successful',
                200
            )->cookie('token',$token,60 * 24 * 30 ); // 30 days

        } catch (Exception $e) {
            return ResponseHelper::error(
                $e->getMessage(),
                500
            );
        }
    }

    //User Logout
    function userLogout(){
        return redirect('/')->cookie('token','',-1);
    }

}
