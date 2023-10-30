<?php

namespace App\Http\Requests\ApiRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemApiRequest extends BaseClientApiRequest
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
            'name' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'storage' => 'required',
            'barcode' => [
                'required',
                Rule::unique('items', "barcode")->ignore($this->route('item'), 'id')
            ],
        ];
    }
}
