@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.globalSetting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.global-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.globalSetting.fields.title') }}
                        </th>
                        <td>
                            {{ $globalSetting->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.globalSetting.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\GlobalSetting::TYPE_SELECT[$globalSetting->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.globalSetting.fields.created_at') }}
                        </th>
                        <td>
                            {{ $globalSetting->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.global-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection