<?php

namespace App\Http\Requests\ApiRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserInforRequest extends BaseClientApiRequest
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
                'unique:users,phone_number,' . Auth::id(),
            ],
            'username' => [
                'string',
                'required',
                'unique:users,username,' . Auth::id(),
            ],
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . Auth::id(),
            ],
        ];
    }
}
