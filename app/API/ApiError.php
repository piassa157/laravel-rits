<?php

namespace App\API;

class ApiError
{
    public static function errorMsg($message, $code) {
        return [
            'message' => $message,
            'code' => $code
        ];
    }
}
