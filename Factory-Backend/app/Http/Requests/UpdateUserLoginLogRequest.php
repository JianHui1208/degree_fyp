<?php

namespace App\Http\Requests;

use App\Models\UserLoginLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserLoginLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_login_log_edit');
    }

    public function rules()
    {
        return [
            'login_time' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'login_ip' => [
                'string',
                'nullable',
            ],
        ];
    }
}
