<?php

namespace App\Http\Requests;

use App\Models\NoticeBoard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNoticeBoardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('notice_board_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required'
            ],
            'type' => [
                'string',
                'required'
            ],
            'status' => [
                'string',
                'required'
            ],
            'image_id' => [
                'string',
                'required'
            ],
            'post_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
