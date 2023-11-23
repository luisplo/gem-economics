<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait JsonResponseTrait
{
    public function successResponse($data, $httpCode = null): JsonResponse
    {
        return response()->json($data, $httpCode ?? Response::HTTP_OK);
    }
}
