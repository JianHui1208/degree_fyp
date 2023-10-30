@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.noticeBoard.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notice-boards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.id') }}
                        </th>
                        <td>
                            {{ $noticeBoard->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.title') }}
                        </th>
                        <td>
                            {{ $noticeBoard->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\NoticeBoard::TYPE_SELECT[$noticeBoard->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.post_at') }}
                        </th>
                        <td>
                            {{ $noticeBoard->post_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.image_id') }}
                        </th>
                        <td>
                            @if($noticeBoard->image)
                                <a href="{{ $noticeBoard->image->document->url }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $noticeBoard->image->document->url }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\NoticeBoard::STATUS_SELECT[$noticeBoard->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notice-boards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection