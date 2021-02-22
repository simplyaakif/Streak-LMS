@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.marketingAd.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.marketing-ads.update", [$marketingAd->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.marketingAd.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $marketingAd->title) }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingAd.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ad">{{ trans('cruds.marketingAd.fields.ad') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('ad') ? 'is-invalid' : '' }}" name="ad" id="ad">{!! old('ad', $marketingAd->ad) !!}</textarea>
                @if($errors->has('ad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingAd.fields.ad_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="publish_at">{{ trans('cruds.marketingAd.fields.publish_at') }}</label>
                <input class="form-control date {{ $errors->has('publish_at') ? 'is-invalid' : '' }}" type="text" name="publish_at" id="publish_at" value="{{ old('publish_at', $marketingAd->publish_at) }}">
                @if($errors->has('publish_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publish_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingAd.fields.publish_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="valid_till">{{ trans('cruds.marketingAd.fields.valid_till') }}</label>
                <input class="form-control date {{ $errors->has('valid_till') ? 'is-invalid' : '' }}" type="text" name="valid_till" id="valid_till" value="{{ old('valid_till', $marketingAd->valid_till) }}">
                @if($errors->has('valid_till'))
                    <div class="invalid-feedback">
                        {{ $errors->first('valid_till') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingAd.fields.valid_till_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ad_design">{{ trans('cruds.marketingAd.fields.ad_design') }}</label>
                <div class="needsclick dropzone {{ $errors->has('ad_design') ? 'is-invalid' : '' }}" id="ad_design-dropzone">
                </div>
                @if($errors->has('ad_design'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ad_design') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.marketingAd.fields.ad_design_helper') }}</span>
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
                xhr.open('POST', '/admin/marketing-ads/ckmedia', true);
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
                data.append('crud_id', '{{ $marketingAd->id ?? 0 }}');
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
    Dropzone.options.adDesignDropzone = {
    url: '{{ route('admin.marketing-ads.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="ad_design"]').remove()
      $('form').append('<input type="hidden" name="ad_design" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="ad_design"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($marketingAd) && $marketingAd->ad_design)
      var file = {!! json_encode($marketingAd->ad_design) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="ad_design" value="' + file.file_name + '">')
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