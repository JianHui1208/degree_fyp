@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.warehouse.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.warehouses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouse.fields.id') }}
                        </th>
                        <td>
                            {{ $warehouse->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouse.fields.title') }}
                        </th>
                        <td>
                            {{ $warehouse->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouse.fields.type') }}
                        </th>
                        <td>
                            {{ $warehouse->type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.warehouses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection