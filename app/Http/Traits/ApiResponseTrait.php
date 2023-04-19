<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    public function ApiResponse($status = true, $statu_code = 200, $message = null, $error = null, $data = null)
    {
        $response = [
            'status' => $status,
            'statu_code' => $statu_code,
            'message' => $message,
            'error' => $error,
        ];
        if (!is_null($data)) {
            $response['data'] = $data;
        }
        return response($response, 200);
    }
}
