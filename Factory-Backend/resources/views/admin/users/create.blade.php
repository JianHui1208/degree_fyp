@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" required>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::TYPE_SELECT as $key => $label)
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
                <span class="help-block">{{ trans('cruds.user.fields.type_helper') }}</span>
            </div>

            <div id="customer_form" class="d-none">
                <div class="form-group">
                    <label class="required">{{ trans('cruds.user.fields.mobile_code') }}</label>
                    <select class="form-control {{ $errors->has('mobile_code') ? 'is-invalid' : '' }}" name="mobile_code" id="mobile_code">
                        <option value disabled {{ old('mobile_code', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($countries as $item)
                            <option value="{{ $item->id }}" {{ old('mobile_code', '0') === (string) $item->id ? 'selected' : '' }}>+{{ $item->mobile_code }}&nbsp;({{$item->name}})</option>
                        @endforeach
                    </select>
                    @if($errors->has('mobile_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile_code') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.mobile_code_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="mobile_number">{{ trans('cruds.user.fields.mobile_number') }}</label>
                    <input class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}" type="number" name="mobile_number" id="mobile_number" value="{{ old('mobile_number', '') }}">
                    @if($errors->has('mobile_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.mobile_number_helper') }}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 0) == 1 || old('is_active') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.user.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.is_active_helper') }}</span>
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

@section('scripts')
<script>
    $(function(){

        $('#type').on('change', function() {
            
            CustomerFormController();

        });

        function CustomerFormController() {

            const id = $('#type').val();

            if (id == 2) {
                $('#customer_form').removeClass('d-none');
            } else {
                $('#customer_form').addClass('d-none');
            }
        }

        CustomerFormController();

    });

</script>
@endsection