@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.noticeBoard.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notice-boards.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.noticeBoard.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noticeBoard.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.noticeBoard.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\NoticeBoard::TYPE_SELECT as $key => $label)
                        @if($key != 0)
                        <option value="{{ $key }}" {{ old('type', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endif()
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noticeBoard.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="post_at">{{ trans('cruds.noticeBoard.fields.post_at') }}</label>
                <input class="form-control datetime {{ $errors->has('post_at') ? 'is-invalid' : '' }}" type="text" name="post_at" id="post_at" value="{{ old('post_at') }}">
                @if($errors->has('post_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noticeBoard.fields.post_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image_id">{{ trans('cruds.noticeBoard.fields.image_id') }}</label>
                <select class="form-control select2 {{ $errors->has('image_id') ? 'is-invalid' : '' }}" name="image_id" id="image_id">
                    @foreach($images as $id => $entry)
                    <option value="{{ $id }}" {{ old('image_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('image_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('image_id') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.noticeBoard.fields.image_id_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="1">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="2" {{ old('status', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.noticeBoard.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noticeBoard.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
