<?php

namespace App\Http\Requests\ApiRequests;

class StoreImageRequest extends BaseClientApiRequest
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
            'document' => [
                'required',
            ],
            'title' => [
                'required',
            ],
            'type' => [
                'required',
            ]
        ];
    }
}
