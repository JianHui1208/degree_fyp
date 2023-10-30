<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class BaseController extends Controller
{
   /**
    * @param int $status 状态码
    * @param mixed $data 需要传输的资料
    * @param string $message 信息，非null 拿其相对的message，是null 拿status的default message
    * @param string $locale 返回的语言
    * @return array
    */
   public function resFormat(int $status, string $message = null, $data = [], string $locale = null, int $xhr_code = 200, $replace = [])
   {

      if ($locale == null) {
         $locale = App::getLocale();
      }

      return response()->json(array(
         'status'   => $status,
         'message'  => $message ?? Lang::get('api.' . $status, $replace, $locale),
         'response' => $data
      ), $xhr_code);
   }

   public function success(int $status)
   {
      return $this->resFormat($status);
   }

   public function error(string $message = null)
   {
      return $this->resFormat(-1, $message);
   }

   /**
    * @param string $word 关键字
    * @param string $length uid长度 (word+date+lengthStr)
    * @return string
    */
   public function generateUID($word, $length = 8)
   {
      $word = strtoupper($word);
      $now = Carbon::now()->format('ymd');
      $randNum1 = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, $length);

      $UID = $word . $now . $randNum1;
      return $UID;
   }

   public function generateKey($length = 16)
   {
      $randNum1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, $length);
      return $randNum1;
   }
}
