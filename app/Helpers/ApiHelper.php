<?php

namespace App\Helpers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;

class ApiHelper
{
    /**
     * Validation Error Response
     */
    public static function validationErrorResponse(Validator $validator): JsonResponse
    {
        $errors = $validator->errors()->all();
        $message = implode(', ', $errors);

        return response()->json([
            'status' => 0,
            'message' => $message,
            'result' => null
        ]);
    }

    /**
     * Success Response
     */
    public static function apiSuccessResponse($message = null, $result = null): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'result' => $result
        ]);
    }

    /**
     * Error Response
     */
    public static function apiErrorResponse($message = null, $result = null): JsonResponse
    {
        return response()->json([
            'status' => 0,
            'message' => $message,
            'result' => $result
        ]);
    }
}
