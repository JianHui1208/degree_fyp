<?php

namespace App\Http\Requests\ApiRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemApiRequest extends FormRequest
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
            'barcode' => ['required', 'unique:items'],
            'cost' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'company_id' => 'required',
        ];
    }
}
