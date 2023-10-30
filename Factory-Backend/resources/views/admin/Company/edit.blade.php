@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.company.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.companies.update", [$company->id]) }}" encemail="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.company.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $company->name) }}" required>
                @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.company.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $company->email) }}">
                @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $company->status == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.company.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                <div class="invalid-feedback">
                    {{ $errors->first('status') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('subscription') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="subscription" value="0">
                    <input class="form-check-input" type="checkbox" name="subscription" id="subscription" value="1" {{ $company->subscription == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="subscription">{{ trans('cruds.company.fields.subscription') }}</label>
                </div>
                @if($errors->has('subscription'))
                <div class="invalid-feedback">
                    {{ $errors->first('subscription') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.subscription_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.company.fields.user_id') }}</label>
                <select class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                    <option value="{{ $id }}" {{ ($company->user_id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('user_id') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.user_id_helper') }}</span>
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