@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.courseVideo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.course-videos.update", [$courseVideo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="course_material_id">{{ trans('cruds.courseVideo.fields.course_material') }}</label>
                <select class="form-control select2 {{ $errors->has('course_material') ? 'is-invalid' : '' }}" name="course_material_id" id="course_material_id">
                    @foreach($course_materials as $id => $course_material)
                        <option value="{{ $id }}" {{ (old('course_material_id') ? old('course_material_id') : $courseVideo->course_material->id ?? '') == $id ? 'selected' : '' }}>{{ $course_material }}</option>
                    @endforeach
                </select>
                @if($errors->has('course_material'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course_material') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseVideo.fields.course_material_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video">{{ trans('cruds.courseVideo.fields.video') }}</label>
                <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}" id="video-dropzone">
                </div>
                @if($errors->has('video'))
                    <div class="invalid-feedback">
                        {{ $errors->first('video') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseVideo.fields.video_helper') }}</span>
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
    Dropzone.options.videoDropzone = {
    url: '{{ route('admin.course-videos.storeMedia') }}',
    maxFilesize: 200, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 200
    },
    success: function (file, response) {
      $('form').find('input[name="video"]').remove()
      $('form').append('<input type="hidden" name="video" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="video"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($courseVideo) && $courseVideo->video)
      var file = {!! json_encode($courseVideo->video) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="video" value="' + file.file_name + '">')
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