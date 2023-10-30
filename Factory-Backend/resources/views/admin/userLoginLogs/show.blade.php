@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userLoginLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-login-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userLoginLog.fields.id') }}
                        </th>
                        <td>
                            {{ $userLoginLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userLoginLog.fields.user') }}
                        </th>
                        <td>
                            {{ $userLoginLog->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userLoginLog.fields.login_time') }}
                        </th>
                        <td>
                            {{ $userLoginLog->login_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userLoginLog.fields.login_ip') }}
                        </th>
                        <td>
                            {{ $userLoginLog->login_ip }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-login-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection