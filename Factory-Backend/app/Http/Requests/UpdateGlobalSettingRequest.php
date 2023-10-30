<?php

namespace App\Http\Requests;

use App\Models\GlobalSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGlobalSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('global_setting_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'type' => [
                'nullable',
            ],
            'is_active' => [
                'nullable'
            ]
        ];
    }
}
