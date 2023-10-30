@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.item_category.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.item-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.item_category.fields.id') }}
                        </th>
                        <td>
                            {{ $item_category->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item_category.fields.title') }}
                        </th>
                        <td>
                            {{ $item_category->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item_category.fields.type') }}
                        </th>
                        <td>
                            {{ $item_category->type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.item-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection