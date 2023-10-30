<?php

namespace App\Encryption;

class Decrypt
{
    public static function decrypt2($encrypted)
    {
        $statusCode = 9999;
        try {
            $data = base64_decode($encrypted);
            return json_decode($data);
        } catch (\Exception $e) {
            return $statusCode;
        }
    }
}
