<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        // Registration logic here
        // bdhfbvdfvdfhfvbdfvdf vdfbvhj
        // bvfhdjbvdfjhvdfvdhjvbdfv
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        // Login logic here
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        // Logout logic here
    }

    /**
     * Send OTP to user.
     * (Corrected method name from sandOTP → sendOtp)
     */
    public function sendOtp(Request $request)
    {
        // Send OTP logic here
    }

    /**
     * Verify OTP.
     */
    public function verifyOtp(Request $request)
    {
        // Verify OTP logic here
    }

    /**
     * Reset user password.
     */
    public function resetPassword(Request $request)
    {
        // Reset password logic here
    }
}
