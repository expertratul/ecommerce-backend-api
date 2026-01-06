<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\JWTToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class tokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $payload = JWTToken::verifyToken($token);

        if($payload === 'invalid Token'){
            // return response()->json([
            //     'status'  => 'failed',
            //     'message' => 'invalid Token',
            // ], 200);

            return redirect('userLogin');
        }else{
            $request->headers->set('email', $payload->userEmail);

            if (isset($payload->userId)) {
                $request->headers->set('id', $payload->userId);
            }
        }
        return $next($request);
    }
}
