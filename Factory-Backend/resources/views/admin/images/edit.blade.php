@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.image.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.images.update', [$image->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title">{{ trans('cruds.image.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                        id="title" value="{{ old('title', $image->title) }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.image.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="document">{{ trans('cruds.image.fields.document') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('document') ? 'is-invalid' : '' }}"
                        id="document-dropzone">
                    </div>
                    @if ($errors->has('document'))
                        <div class="invalid-feedback">
                            {{ $errors->first('document') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.image.fields.document_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.image.fields.type') }}</label>
                    <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                        <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Image::TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('type', (string)$image->type) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.image.fields.type_helper') }}</span>
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
        Dropzone.options.documentDropzone = {
            url: '{{ route('admin.images.storeMedia') }}',
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
            success: function(file, response) {
                $('form').find('input[name="document"]').remove()
                $('form').append('<input type="hidden" name="document" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="document"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($image) && $image->document)
                    var file = {!! json_encode($image->document) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="document" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
