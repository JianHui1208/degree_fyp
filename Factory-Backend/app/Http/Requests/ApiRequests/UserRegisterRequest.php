<?php

namespace App\Http\Requests\ApiRequests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends BaseClientApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone_number' => [
                'string',
                'required',
                'unique:users',
            ],
            'username' => [
                'string',
                'required',
                'unique:users',
            ],
            // 'name' => [
            //     'string',
            //     'required',
            // ],
            'email' => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            // 'pin' => [
            //     'integer',
            // ],
            // 'type' => [
            //     'integer',
            //     'required'
            // ],
        ];
    }
}
