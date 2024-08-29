<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $result,
        ];

        return response()->json($response, 200);
    }

    public function sendError($message, $error = [], $code = 404)
    {
        $response = [
            'status' => false,
            'message' => $message,
        ];
        if (! empty($error)) {
            // code...
            $response['data'] = $error;
        }

        return response()->json($response, $code);
    }
}
