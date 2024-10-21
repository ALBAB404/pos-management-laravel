<?php

namespace App\Classes;

class Helper {

    public static function sendResponse($message = null, $status = null, $result = null)
    {
        $response = [
            'message' => $message,
            'status' => $status,
            'result' => $result,
        ];
        return response()->json($response);
    }

    public static function sendError($message = null, $status = null)
    {
        $response = [
            'message' => $message,
            'status' => $status,
        ];
        return response()->json($response);
    }

}
