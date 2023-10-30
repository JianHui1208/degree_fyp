@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.image.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.images.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.title') }}
                        </th>
                        <td>
                            {{ $image->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.document') }}
                        </th>
                        <td>
                            @if($image->document)
                                <a href="{{ $image->document->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $image->document->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Image::TYPE_SELECT[$image->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Image::STATUS_SELECT[$image->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.images.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection