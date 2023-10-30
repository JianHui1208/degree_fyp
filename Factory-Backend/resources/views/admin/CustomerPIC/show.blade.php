@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.Name.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.Names.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.Name.fields.id') }}
                        </th>
                        <td>
                            {{ $Name->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.Name.fields.title') }}
                        </th>
                        <td>
                            {{ $Name->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.Name.fields.type') }}
                        </th>
                        <td>
                            {{ $Name->type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.Names.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection