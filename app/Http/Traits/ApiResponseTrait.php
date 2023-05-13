<?php

namespace App\Http\Traits;

trait ApiResponseTrait

{

    public function sendResponse($result, $message)
    {

        $response = [
            'status' => 1,

            'data'    => $result,

            'message' => $message
        ];

        return response()->json($response, 200);
    }

    public function sendError($errorMessages,$code)
    {

        $response = [
            'status' => 0,

            'message' => $errorMessages,

            'error_code' => $code,
        ];

        return response()->json($response,$code);
    }
}
