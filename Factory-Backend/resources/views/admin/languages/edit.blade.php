@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.language.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.languages.update", [$language->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.language.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $language->title) }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.language.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="short_key">{{ trans('cruds.language.fields.short_key') }}</label>
                <input class="form-control {{ $errors->has('short_key') ? 'is-invalid' : '' }}" type="text" name="short_key" id="short_key" value="{{ old('short_key', $language->short_key) }}">
                @if($errors->has('short_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.language.fields.short_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="filename">{{ trans('cruds.language.fields.filename') }}</label>
                <input class="form-control {{ $errors->has('filename') ? 'is-invalid' : '' }}" type="text" name="filename" id="filename" value="{{ old('filename', $language->filename) }}">
                @if($errors->has('filename'))
                    <div class="invalid-feedback">
                        {{ $errors->first('filename') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.language.fields.filename_helper') }}</span>
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