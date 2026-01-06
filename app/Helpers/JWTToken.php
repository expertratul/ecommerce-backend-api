<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {
    //Create Token
    public static function CreateToken($userEmail, $userId) 
    {
        $key = env('JWT_SECRET'); //env file teke JWT value ashce
        $payload = [
            'iss'        => 'Laravel Token',
            'iat'        => time(),
            'exp'        => time() + 24 * 3600, // 24 hours = 1 day
            'userEmail'  => $userEmail,
            'userId'     => $userId,
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    //Create Token for reset Password
    public static function createTokenForResetPassword($userEmail) 
    {
        $key = env('JWT_SECRET'); //env file teke JWT value ashce
        $payload = [
            'iss'        => 'Laravel Token',
            'iat'        => time(),
            'exp'        => time() + 60 * 5,
            'userEmail' => $userEmail,
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    //verify Token
    public static function verifyToken($token) 
    {
        try {
            if (!$token) {
                return 'invalid Token';
            } else {
                $key = env('JWT_SECRET');
                $payload = JWT::decode($token, new Key($key, 'HS256'));
                return $payload;

                // return JWT::decode($jwt, new Key($key, 'HS256'));
            }
        } catch (\Throwable $error) {
            return 'invalid Token';
        }
    }
}