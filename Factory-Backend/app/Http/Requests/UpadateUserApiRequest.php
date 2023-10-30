<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpadateUserApiRequest extends EncryptionDataRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                // 'unique:users,email,' . request()->route('user')->id,
            ],
        ];
    }
}
