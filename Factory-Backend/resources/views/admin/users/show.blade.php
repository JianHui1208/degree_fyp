@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.uid') }}
                        </th>
                        <td>
                            {{ $user->uid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.two_factor') }}
                        </th>
                        <td>
                            {{ App\Models\User::TWO_FACTOR_SELECT[$user->two_factor] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.invitation_code') }}
                        </th>
                        <td>
                            {{ $user->invitation_code }}
                        </td>
                    </tr>
                    @if ($user->invited_by)
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.invite_by') }}
                        </th>
                        <td>
                            <a href="{{ route('admin.users.show', $user->invited_by->id) }}">{{ $user->invited_by->uid }}&nbsp;({{ $user->invited_by->name }})</a>
                        </td>
                    </tr>
                    @endif
                    @if (!$user->invited->isEmpty())
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.invited') }}
                        </th>
                        <td>
                            @foreach($user->invited as $key => $value)
                                <a href="{{route('admin.users.show', $value->id)}}">
                                    <span class="label label-info">{{$key + 1}}. {{ $value->uid }}&nbsp;({{ $value->name }})</span>
                                </a>
                                <br>
                            @endforeach
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.register_time') }}
                        </th>
                        <td>
                            {{ $user->register_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\User::TYPE_SELECT[$user->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\User::STATUS_SELECT[$user->is_active] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection