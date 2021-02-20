@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.batch.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.batches.update", [$batch->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.batch.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $batch->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="course_id">{{ trans('cruds.batch.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id" required>
                    @foreach($courses as $id => $course)
                        <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $batch->course->id ?? '') == $id ? 'selected' : '' }}>{{ $course }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="class_time">{{ trans('cruds.batch.fields.class_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('class_time') ? 'is-invalid' : '' }}" type="text" name="class_time" id="class_time" value="{{ old('class_time', $batch->class_time) }}">
                @if($errors->has('class_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.class_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="strength">{{ trans('cruds.batch.fields.strength') }}</label>
                <input class="form-control {{ $errors->has('strength') ? 'is-invalid' : '' }}" type="number" name="strength" id="strength" value="{{ old('strength', $batch->strength) }}" step="1">
                @if($errors->has('strength'))
                    <div class="invalid-feedback">
                        {{ $errors->first('strength') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.strength_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="batch_content">{{ trans('cruds.batch.fields.batch_content') }}</label>
                <div class="needsclick dropzone {{ $errors->has('batch_content') ? 'is-invalid' : '' }}" id="batch_content-dropzone">
                </div>
                @if($errors->has('batch_content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('batch_content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.batch_content_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="instructors">{{ trans('cruds.batch.fields.instructor') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('instructors') ? 'is-invalid' : '' }}" name="instructors[]" id="instructors" multiple required>
                    @foreach($instructors as $id => $instructor)
                        <option value="{{ $id }}" {{ (in_array($id, old('instructors', [])) || $batch->instructors->contains($id)) ? 'selected' : '' }}>{{ $instructor }}</option>
                    @endforeach
                </select>
                @if($errors->has('instructors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instructors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.instructor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.batch.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $batch->description) !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="batch_thumbnail">{{ trans('cruds.batch.fields.batch_thumbnail') }}</label>
                <div class="needsclick dropzone {{ $errors->has('batch_thumbnail') ? 'is-invalid' : '' }}" id="batch_thumbnail-dropzone">
                </div>
                @if($errors->has('batch_thumbnail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('batch_thumbnail') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.batch.fields.batch_thumbnail_helper') }}</span>
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
    var uploadedBatchContentMap = {}
Dropzone.options.batchContentDropzone = {
    url: '{{ route('admin.batches.storeMedia') }}',
    maxFilesize: 100, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 100
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="batch_content[]" value="' + response.name + '">')
      uploadedBatchContentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBatchContentMap[file.name]
      }
      $('form').find('input[name="batch_content[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($batch) && $batch->batch_content)
          var files =
            {!! json_encode($batch->batch_content) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="batch_content[]" value="' + file.file_name + '">')
            }
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
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/batches/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $batch->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.batchThumbnailDropzone = {
    url: '{{ route('admin.batches.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="batch_thumbnail"]').remove()
      $('form').append('<input type="hidden" name="batch_thumbnail" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="batch_thumbnail"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($batch) && $batch->batch_thumbnail)
      var file = {!! json_encode($batch->batch_thumbnail) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="batch_thumbnail" value="' + file.file_name + '">')
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