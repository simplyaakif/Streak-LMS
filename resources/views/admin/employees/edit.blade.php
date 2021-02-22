@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employee.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employees.update", [$employee->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.employee.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dp">{{ trans('cruds.employee.fields.dp') }}</label>
                <div class="needsclick dropzone {{ $errors->has('dp') ? 'is-invalid' : '' }}" id="dp-dropzone">
                </div>
                @if($errors->has('dp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.dp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.employee.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $employee->user->id ?? '') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mobile">{{ trans('cruds.employee.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $employee->mobile) }}" required>
                @if($errors->has('mobile'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.employee.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $employee->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.employee.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address', $employee->address) }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.employee.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $employee->city) }}">
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_birth">{{ trans('cruds.employee.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth) }}">
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.employee.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Employee::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', $employee->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.employee.fields.marital_status') }}</label>
                <select class="form-control {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" name="marital_status" id="marital_status">
                    <option value disabled {{ old('marital_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Employee::MARITAL_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('marital_status', $employee->marital_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('marital_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marital_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.marital_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="job_title">{{ trans('cruds.employee.fields.job_title') }}</label>
                <input class="form-control {{ $errors->has('job_title') ? 'is-invalid' : '' }}" type="text" name="job_title" id="job_title" value="{{ old('job_title', $employee->job_title) }}">
                @if($errors->has('job_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.job_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cnic_passport">{{ trans('cruds.employee.fields.cnic_passport') }}</label>
                <input class="form-control {{ $errors->has('cnic_passport') ? 'is-invalid' : '' }}" type="text" name="cnic_passport" id="cnic_passport" value="{{ old('cnic_passport', $employee->cnic_passport) }}">
                @if($errors->has('cnic_passport'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cnic_passport') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.cnic_passport_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qualification">{{ trans('cruds.employee.fields.qualification') }}</label>
                <input class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}" type="text" name="qualification" id="qualification" value="{{ old('qualification', $employee->qualification) }}">
                @if($errors->has('qualification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qualification') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.qualification_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="experience">{{ trans('cruds.employee.fields.experience') }}</label>
                <input class="form-control {{ $errors->has('experience') ? 'is-invalid' : '' }}" type="text" name="experience" id="experience" value="{{ old('experience', $employee->experience) }}">
                @if($errors->has('experience'))
                    <div class="invalid-feedback">
                        {{ $errors->first('experience') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.experience_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="relegion">{{ trans('cruds.employee.fields.relegion') }}</label>
                <input class="form-control {{ $errors->has('relegion') ? 'is-invalid' : '' }}" type="text" name="relegion" id="relegion" value="{{ old('relegion', $employee->relegion) }}">
                @if($errors->has('relegion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('relegion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.relegion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="documents_cv_experience">{{ trans('cruds.employee.fields.documents_cv_experience') }}</label>
                <div class="needsclick dropzone {{ $errors->has('documents_cv_experience') ? 'is-invalid' : '' }}" id="documents_cv_experience-dropzone">
                </div>
                @if($errors->has('documents_cv_experience'))
                    <div class="invalid-feedback">
                        {{ $errors->first('documents_cv_experience') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.documents_cv_experience_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.employee.fields.earning_type') }}</label>
                <select class="form-control {{ $errors->has('earning_type') ? 'is-invalid' : '' }}" name="earning_type" id="earning_type">
                    <option value disabled {{ old('earning_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Employee::EARNING_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('earning_type', $employee->earning_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('earning_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('earning_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.earning_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="basic_salary">{{ trans('cruds.employee.fields.basic_salary') }}</label>
                <input class="form-control {{ $errors->has('basic_salary') ? 'is-invalid' : '' }}" type="number" name="basic_salary" id="basic_salary" value="{{ old('basic_salary', $employee->basic_salary) }}" step="0.01">
                @if($errors->has('basic_salary'))
                    <div class="invalid-feedback">
                        {{ $errors->first('basic_salary') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.basic_salary_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="medical">{{ trans('cruds.employee.fields.medical') }}</label>
                <input class="form-control {{ $errors->has('medical') ? 'is-invalid' : '' }}" type="number" name="medical" id="medical" value="{{ old('medical', $employee->medical) }}" step="0.01">
                @if($errors->has('medical'))
                    <div class="invalid-feedback">
                        {{ $errors->first('medical') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.medical_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="conveyance">{{ trans('cruds.employee.fields.conveyance') }}</label>
                <input class="form-control {{ $errors->has('conveyance') ? 'is-invalid' : '' }}" type="number" name="conveyance" id="conveyance" value="{{ old('conveyance', $employee->conveyance) }}" step="0.01">
                @if($errors->has('conveyance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('conveyance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.conveyance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deduction_leave">{{ trans('cruds.employee.fields.deduction_leave') }}</label>
                <input class="form-control {{ $errors->has('deduction_leave') ? 'is-invalid' : '' }}" type="number" name="deduction_leave" id="deduction_leave" value="{{ old('deduction_leave', $employee->deduction_leave) }}" step="0.01">
                @if($errors->has('deduction_leave'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deduction_leave') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.deduction_leave_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deduction_loan">{{ trans('cruds.employee.fields.deduction_loan') }}</label>
                <input class="form-control {{ $errors->has('deduction_loan') ? 'is-invalid' : '' }}" type="number" name="deduction_loan" id="deduction_loan" value="{{ old('deduction_loan', $employee->deduction_loan) }}" step="0.01">
                @if($errors->has('deduction_loan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deduction_loan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.deduction_loan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deduction_tax">{{ trans('cruds.employee.fields.deduction_tax') }}</label>
                <input class="form-control {{ $errors->has('deduction_tax') ? 'is-invalid' : '' }}" type="number" name="deduction_tax" id="deduction_tax" value="{{ old('deduction_tax', $employee->deduction_tax) }}" step="0.01">
                @if($errors->has('deduction_tax'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deduction_tax') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.deduction_tax_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deduction_other">{{ trans('cruds.employee.fields.deduction_other') }}</label>
                <input class="form-control {{ $errors->has('deduction_other') ? 'is-invalid' : '' }}" type="number" name="deduction_other" id="deduction_other" value="{{ old('deduction_other', $employee->deduction_other) }}" step="0.01">
                @if($errors->has('deduction_other'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deduction_other') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.deduction_other_helper') }}</span>
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
    url: '{{ route('admin.employees.storeMedia') }}',
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
@if(isset($employee) && $employee->dp)
      var file = {!! json_encode($employee->dp) !!}
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
    var uploadedDocumentsCvExperienceMap = {}
Dropzone.options.documentsCvExperienceDropzone = {
    url: '{{ route('admin.employees.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="documents_cv_experience[]" value="' + response.name + '">')
      uploadedDocumentsCvExperienceMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentsCvExperienceMap[file.name]
      }
      $('form').find('input[name="documents_cv_experience[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($employee) && $employee->documents_cv_experience)
          var files =
            {!! json_encode($employee->documents_cv_experience) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="documents_cv_experience[]" value="' + file.file_name + '">')
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