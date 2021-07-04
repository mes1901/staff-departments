<?php

namespace App\Helpers;

class ResponseJson
{
    public static function responseArray($array,$httpCode = 200) {
        return response()->json($array,$httpCode);
    }

    public static function responseError($messages,$code=0,$httpCode = 400)
    {
        return self::responseArray([
            'error' => [
                'code' => $code,
                'message' => $messages
            ]
        ],$httpCode);
    }

    public static function responseSuccess($data = [], $message = '',$httpCode = 200)
    {
        $response = [
            'result' => 'success'
        ];

        if(is_array($data) || !empty($data)) {
            $response['data'] = $data;
        }
        if(!empty($message)) {
            $response['message'] = $message;
        }


        return self::responseArray($response,$httpCode);
    }
}