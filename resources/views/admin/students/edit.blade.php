@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.student.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.students.update", [$student->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="dp">{{ trans('cruds.student.fields.dp') }}</label>
                <div class="needsclick dropzone {{ $errors->has('dp') ? 'is-invalid' : '' }}" id="dp-dropzone">
                </div>
                @if($errors->has('dp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.dp_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.student.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.student.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $student->user->id ?? '') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="father_name">{{ trans('cruds.student.fields.father_name') }}</label>
                <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}" type="text" name="father_name" id="father_name" value="{{ old('father_name', $student->father_name) }}">
                @if($errors->has('father_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('father_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.father_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.student.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Student::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', $student->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nationality">{{ trans('cruds.student.fields.nationality') }}</label>
                <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', $student->nationality) }}">
                @if($errors->has('nationality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nationality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.nationality_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="place_of_birth">{{ trans('cruds.student.fields.place_of_birth') }}</label>
                <input class="form-control {{ $errors->has('place_of_birth') ? 'is-invalid' : '' }}" type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth', $student->place_of_birth) }}">
                @if($errors->has('place_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('place_of_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.place_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="first_language">{{ trans('cruds.student.fields.first_language') }}</label>
                <input class="form-control {{ $errors->has('first_language') ? 'is-invalid' : '' }}" type="text" name="first_language" id="first_language" value="{{ old('first_language', $student->first_language) }}">
                @if($errors->has('first_language'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_language') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.first_language_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_birth">{{ trans('cruds.student.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}">
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cnic_passport">{{ trans('cruds.student.fields.cnic_passport') }}</label>
                <input class="form-control {{ $errors->has('cnic_passport') ? 'is-invalid' : '' }}" type="text" name="cnic_passport" id="cnic_passport" value="{{ old('cnic_passport', $student->cnic_passport) }}">
                @if($errors->has('cnic_passport'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cnic_passport') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.cnic_passport_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mobile">{{ trans('cruds.student.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $student->mobile) }}" required>
                @if($errors->has('mobile'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.student.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $student->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="landline">{{ trans('cruds.student.fields.landline') }}</label>
                <input class="form-control {{ $errors->has('landline') ? 'is-invalid' : '' }}" type="text" name="landline" id="landline" value="{{ old('landline', $student->landline) }}">
                @if($errors->has('landline'))
                    <div class="invalid-feedback">
                        {{ $errors->first('landline') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.landline_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="admission_form">{{ trans('cruds.student.fields.admission_form') }}</label>
                <div class="needsclick dropzone {{ $errors->has('admission_form') ? 'is-invalid' : '' }}" id="admission_form-dropzone">
                </div>
                @if($errors->has('admission_form'))
                    <div class="invalid-feedback">
                        {{ $errors->first('admission_form') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.admission_form_helper') }}</span>
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
    Dropzone.options.dpDropzone = {
    url: '{{ route('admin.students.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 1000,
      height: 1000
    },
    success: function (file, response) {
      $('form').find('input[name="dp"]').remove()
      $('form').append('<input type="hidden" name="dp" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="dp"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($student) && $student->dp)
      var file = {!! json_encode($student->dp) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="dp" value="' + file.file_name + '">')
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
<script>
    var uploadedAdmissionFormMap = {}
Dropzone.options.admissionFormDropzone = {
    url: '{{ route('admin.students.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="admission_form[]" value="' + response.name + '">')
      uploadedAdmissionFormMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAdmissionFormMap[file.name]
      }
      $('form').find('input[name="admission_form[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($student) && $student->admission_form)
          var files =
            {!! json_encode($student->admission_form) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="admission_form[]" value="' + file.file_name + '">')
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