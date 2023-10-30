@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.noticeBoard.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notice-boards.update", [$noticeBoard->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.noticeBoard.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $noticeBoard->title) }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noticeBoard.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.noticeBoard.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\NoticeBoard::TYPE_SELECT as $key => $label)
                        @if($key != 0)
                        <option value="{{ $key }}" {{ old('type') ? old('type') : $noticeBoard->type === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endif()
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noticeBoard.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="post_at">{{ trans('cruds.noticeBoard.fields.post_at') }}</label>
                <input class="form-control datetime {{ $errors->has('post_at') ? 'is-invalid' : '' }}" type="text" name="post_at" id="post_at" value="{{ old('post_at', $noticeBoard->post_at) }}">
                @if($errors->has('post_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noticeBoard.fields.post_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image_id">{{ trans('cruds.noticeBoard.fields.image_id') }}</label>
                <select class="form-control select2 {{ $errors->has('image_id') ? 'is-invalid' : '' }}" name="image_id" id="image_id">
                    @foreach($images as $id => $entry)
                    <option value="{{ $id }}" {{ (old('image_id') ? old('image_id') : $noticeBoard->image->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('image_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('image_id') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.noticeBoard.fields.image_id_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="1">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="2" {{ $noticeBoard->status == 2 || old('status') === 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.noticeBoard.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noticeBoard.fields.status_helper') }}</span>
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
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.notice-boards.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($noticeBoard) && $noticeBoard->image)
      var file = {!! json_encode($noticeBoard->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection