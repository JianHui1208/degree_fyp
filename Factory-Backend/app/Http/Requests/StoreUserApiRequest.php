<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:users',
            ],
            'country_id' => [
                'required',
            ],
            'phone_number' => [
                'required',
                // 'unique:customers',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            'otp_number' => [
                'nullable',
            ],
            'invitation_code' => [
                'nullable',
            ]
        ];
    }
}
