<?php

namespace App\Http\Requests;

use App\Models\GlobalSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGlobalSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('global_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:global_settings,id',
        ];
    }
}
