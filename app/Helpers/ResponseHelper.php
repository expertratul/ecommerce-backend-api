<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{   
    /**
     * Return a success JSON response.
     *
     * @param mixed|null $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
    */
    public static function success($data = null, string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $status,
            'data' => $data,
        ], $status);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int $status
     * @param mixed|null $errors
     * @return JsonResponse
    */
    public static function error(string $message = 'Error', int $status = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'status' => $status,
            'errors' => $errors,
        ], $status);
    }
}