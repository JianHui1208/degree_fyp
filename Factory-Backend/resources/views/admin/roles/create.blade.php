@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                @if($errors->has('permissions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('permissions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                <div class="row">
                    @foreach($unique as $u)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header a" data-l="{{ $u->type }}">
                                    {{ $u->type }}
                                </div>
                                <div class="card-body overflow-auto b" style="height: 200px;">
                                    @foreach ($permissions as $permission)
                                        @if ($permission->type == $u->type)
                                        <div class="form-check c">
                                            <input type="checkbox" class="check2 {{$u->type}}" name="permissions[]" id='{{ $permission->id }}' value="{{ $permission->id }}">
                                            <label for="{{ $permission->id }}">{{ $permission->title }}</label>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
    $(function(){
        $(document).on('click' , '.a' , function(e){
            var v = $(this).attr('data-l');
            if($('.'+v+'').is(':checked')) {
                $('.'+v+'').prop('checked', false);
            } else {
                $('.'+v+'').prop('checked', true);
            }
        });
    });

    $(document).ready(function() {
        $('.select-all').click(function() {
            var checked = true;
            $('input[type="checkbox"]').each(function() {
            this.checked = checked;
            });
        })
    });

    $(document).ready(function() {
        $('.deselect-all').click(function() {
            var checked = false;
            $('input[type="checkbox"]').each(function() {
            this.checked = checked;
            });
        })
    });
</script>

@endsection
