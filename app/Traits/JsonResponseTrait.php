<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait JsonResponseTrait
{
    public function successResponse($data, $httpCode = null, $message = 'Success operation')
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $httpCode ?? Response::HTTP_OK);
    }
}
