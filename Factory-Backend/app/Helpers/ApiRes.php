<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class ApiRes
{
    /**
     * @param string 为了检测数据传输正确
     * @param int $status 状态码
     * @param mixed $data 需要传输的资料
     * @param string $message 信息，非null 拿其相对的message，是null 拿status的default message
     * @param string $locale 返回的语言
     * @return array
     */
    public static function resFormat(int $xhr_code, int $status, string $message = null, $data = [], string $locale = null, $replace = [])
    {
        return response()->json(array(
            'status'   => $status,
            'message'  => $message ?? Lang::get('api.' . $status, $replace, $locale),
            'response' => $data
        ), $xhr_code);
    }
}
