@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userLoginLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-login-logs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.userLoginLog.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userLoginLog.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="login_time">{{ trans('cruds.userLoginLog.fields.login_time') }}</label>
                <input class="form-control datetime {{ $errors->has('login_time') ? 'is-invalid' : '' }}" type="text" name="login_time" id="login_time" value="{{ old('login_time') }}">
                @if($errors->has('login_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('login_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userLoginLog.fields.login_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="login_ip">{{ trans('cruds.userLoginLog.fields.login_ip') }}</label>
                <input class="form-control {{ $errors->has('login_ip') ? 'is-invalid' : '' }}" type="text" name="login_ip" id="login_ip" value="{{ old('login_ip', '') }}">
                @if($errors->has('login_ip'))
                    <div class="invalid-feedback">
                        {{ $errors->first('login_ip') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userLoginLog.fields.login_ip_helper') }}</span>
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