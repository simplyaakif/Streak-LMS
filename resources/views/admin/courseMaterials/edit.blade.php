@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.courseMaterial.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.course-materials.update", [$courseMaterial->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="course_id">{{ trans('cruds.courseMaterial.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id">
                    @foreach($courses as $id => $course)
                        <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $courseMaterial->course->id ?? '') == $id ? 'selected' : '' }}>{{ $course }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseMaterial.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="batches">{{ trans('cruds.courseMaterial.fields.batch') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('batches') ? 'is-invalid' : '' }}" name="batches[]" id="batches" multiple>
                    @foreach($batches as $id => $batch)
                        <option value="{{ $id }}" {{ (in_array($id, old('batches', [])) || $courseMaterial->batches->contains($id)) ? 'selected' : '' }}>{{ $batch }}</option>
                    @endforeach
                </select>
                @if($errors->has('batches'))
                    <div class="invalid-feedback">
                        {{ $errors->first('batches') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseMaterial.fields.batch_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="chapter_number">{{ trans('cruds.courseMaterial.fields.chapter_number') }}</label>
                <input class="form-control {{ $errors->has('chapter_number') ? 'is-invalid' : '' }}" type="text" name="chapter_number" id="chapter_number" value="{{ old('chapter_number', $courseMaterial->chapter_number) }}">
                @if($errors->has('chapter_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('chapter_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseMaterial.fields.chapter_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="chapter_name">{{ trans('cruds.courseMaterial.fields.chapter_name') }}</label>
                <input class="form-control {{ $errors->has('chapter_name') ? 'is-invalid' : '' }}" type="text" name="chapter_name" id="chapter_name" value="{{ old('chapter_name', $courseMaterial->chapter_name) }}">
                @if($errors->has('chapter_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('chapter_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseMaterial.fields.chapter_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="chapter_details">{{ trans('cruds.courseMaterial.fields.chapter_details') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('chapter_details') ? 'is-invalid' : '' }}" name="chapter_details" id="chapter_details">{!! old('chapter_details', $courseMaterial->chapter_details) !!}</textarea>
                @if($errors->has('chapter_details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('chapter_details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseMaterial.fields.chapter_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="content">{{ trans('cruds.courseMaterial.fields.content') }}</label>
                <div class="needsclick dropzone {{ $errors->has('content') ? 'is-invalid' : '' }}" id="content-dropzone">
                </div>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseMaterial.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="position">{{ trans('cruds.courseMaterial.fields.position') }}</label>
                <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" type="number" name="position" id="position" value="{{ old('position', $courseMaterial->position) }}" step="1">
                @if($errors->has('position'))
                    <div class="invalid-feedback">
                        {{ $errors->first('position') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseMaterial.fields.position_helper') }}</span>
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
                xhr.open('POST', '/admin/course-materials/ckmedia', true);
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
                data.append('crud_id', '{{ $courseMaterial->id ?? 0 }}');
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
    var uploadedContentMap = {}
Dropzone.options.contentDropzone = {
    url: '{{ route('admin.course-materials.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="content[]" value="' + response.name + '">')
      uploadedContentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedContentMap[file.name]
      }
      $('form').find('input[name="content[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($courseMaterial) && $courseMaterial->content)
          var files =
            {!! json_encode($courseMaterial->content) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="content[]" value="' + file.file_name + '">')
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
@endsection