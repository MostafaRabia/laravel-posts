<?php

namespace App\Traits;

use App\Enums\HttpCode;

trait PrepareResponse
{
    public function prepareResponse(
        HttpCode $httpCode,
        $data = [],
        string $message = null
    ): \Illuminate\Http\JsonResponse
    {
        return response($httpCode->value)->json([
            'data' => $data,
            'message' => $message ?: $httpCode->message(),
        ]);
    }
}
