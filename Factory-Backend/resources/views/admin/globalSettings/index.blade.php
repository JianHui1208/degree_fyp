@extends('layouts.admin')
@section('content')
    @can('global_setting_create')
        <!-- <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.global-settings.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.globalSetting.title_singular') }}
                </a>
            </div>
        </div> -->
    @endcan

    @foreach ($type as $item)
        <div class="card">
            <div class="card-header">
                {{ $item->type }}
            </div>

            <div class="card-body">
            <form action="{{ route("admin.global-settings.custom_edit") }}" class="custom_edit_form">
                    @csrf
                    @foreach ($GlobalSetting as $GlobalSetting_item)
                        @if ($item->type == $GlobalSetting_item->type)
                            <div class="form-group">
                                @if($GlobalSetting_item->layout == 1)
                                    <label for="{{ $GlobalSetting_item->id }}">{{ $GlobalSetting_item->title }}</label>
                                    <input class="form-control" type="text" name="{{ $GlobalSetting_item->id }}"
                                        id="{{ $GlobalSetting_item->id }}" value="{{ $GlobalSetting_item->value }}"
                                        placeholder="{{ $GlobalSetting_item->title }}"  required>
                                @elseif($GlobalSetting_item->layout == 2)
                                    <div class="form-check">
                                        <input type="hidden" name="{{ $GlobalSetting_item->id }}" id="{{ $GlobalSetting_item->id }}" value="0">
                                        <input class="form-check-input" type="checkbox" name="{{ $GlobalSetting_item->id }}" id="{{ $GlobalSetting_item->id }}" value="1" {{ $GlobalSetting_item->value == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $GlobalSetting_item->id }}">{{ $GlobalSetting_item->title }}</label>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <button type="submit" class="btn btn-danger btn-submit">{{ trans('global.save') }}</button>
                </form>
            </div>
        </div>
    @endforeach

@endsection

@section('scripts')
@parent

<script>
    $(function() {
        $(".custom_edit_form").on('submit', function(e) {

            e.preventDefault();

            var form = $(this);

            var formData = form.serializeArray();
            var type = "POST";

            var btn_submit = form.find('.btn-submit');
            var value = btn_submit.text();

            btn_submit.html("{{ trans('global.loading') }}");

            $.ajax({
                type: type,
                url: form.attr('action'),
                data: formData,
                success: function(data, textStatus, xhr) {
                    if (xhr.status == 200) {
                        alert(data.ret_msg);
                    }
                },
                complete: function(xhr, textStatus) {
                    btn_submit.html(value);
                }
            });
        });
    })
</script>
@endsection
