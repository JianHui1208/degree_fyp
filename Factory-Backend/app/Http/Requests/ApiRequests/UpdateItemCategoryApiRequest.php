<?php

namespace App\Http\Requests\ApiRequests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemCategoryApiRequest extends BaseClientApiRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => [
                'required',
                Rule::unique('item_categories', 'name')->ignore($this->route('itemCategory'), 'id'),
            ],
        ];
    }
}
