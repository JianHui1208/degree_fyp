<?php

namespace App\Http\Requests;

use App\Models\GlobalSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGlobalSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('global_setting_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
            'is_active' => [
                'nullable'
            ]
        ];
    }
}
