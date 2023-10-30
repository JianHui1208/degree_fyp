@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.item.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.items.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.item.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="barcode">{{ trans('cruds.item.fields.bar_code') }}</label> 
                <input class="form-control {{ $errors->has('barcode') ? 'is-invalid' : '' }}" type="text" name="barcode" id="barcode" value="{{ old('barcode', '') }}">
                @if($errors->has('barcode'))
                <div class="invalid-feedback">
                    {{ $errors->first('barcode') }}
                </div>
                @endif
                <br>
                <button class="btn btn-primary" type="button" onclick="generateBarcode()">Generate Barcode</button>
                <span class="help-block">{{ trans('cruds.item.fields.bar_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cost">{{ trans('cruds.item.fields.cost') }}</label>
                <input class="form-control {{ $errors->has('cost') ? 'is-invalid' : '' }}" type="number" name="cost" id="cost" value="{{ old('cost', '') }}">
                @if($errors->has('cost'))
                <div class="invalid-feedback">
                    {{ $errors->first('cost') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.cost_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.item.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}">
                @if($errors->has('price'))
                <div class="invalid-feedback">
                    {{ $errors->first('price') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.item.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}">
                @if($errors->has('quantity'))
                <div class="invalid-feedback">
                    {{ $errors->first('quantity') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="item_category_id">{{ trans('cruds.item.fields.item_category_id') }}</label>
                <select class="form-control select2 {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_category_id" id="item_category_id">
                    @foreach($itemCategories as $id => $entry)
                    <option value="{{ $id }}" {{ old('item_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('item'))
                <div class="invalid-feedback">
                    {{ $errors->first('item') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.item_category_id_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_id">{{ trans('cruds.item.fields.company_id') }}</label>
                <select class="form-control select2 {{ $errors->has('item') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                    @foreach($companies as $id => $entry)
                    <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('item'))
                <div class="invalid-feedback">
                    {{ $errors->first('item') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.company_id_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image_id">{{ trans('cruds.item.fields.image_id') }}</label>
                <select class="form-control select2 {{ $errors->has('item') ? 'is-invalid' : '' }}" name="image_id" id="image_id">
                    @foreach($images as $id => $entry)
                    <option value="{{ $id }}" {{ old('image_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('item'))
                <div class="invalid-feedback">
                    {{ $errors->first('item') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.image_id_helper') }}</span>
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
@parent
<script>
    function generateBarcode() {
        var value = Math.floor(1000000000000 + Math.random() * 900000000000);
        document.getElementById("barcode").value = value;
    }
</script>
@endsection