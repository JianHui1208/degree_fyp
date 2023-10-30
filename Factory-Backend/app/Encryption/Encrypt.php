<?php

namespace App\Encryption;

class Encrypt
{
    public static function encrypt2($data)
    {
        $en_data = base64_encode(json_encode($data));
        return $en_data;
    }
}
