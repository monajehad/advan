@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.clinic.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clinics.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.clinic.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="doctor_name">{{ trans('cruds.clinic.fields.doctor_name') }}</label>
                <input class="form-control {{ $errors->has('doctor_name') ? 'is-invalid' : '' }}" type="text" name="doctor_name" id="doctor_name" value="{{ old('doctor_name', '') }}" required>
                @if($errors->has('doctor_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('doctor_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.doctor_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="specialty_id">{{ trans('cruds.clinic.fields.specialty') }}</label>
                <select class="form-control select2 {{ $errors->has('specialty') ? 'is-invalid' : '' }}" name="specialty_id" id="specialty_id" required>
                    @foreach($specialties as $id => $entry)
                        <option value="{{ $id }}" {{ old('specialty_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('specialty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.specialty_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.clinic.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.clinic.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.clinic.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="clinic_phone">{{ trans('cruds.clinic.fields.clinic_phone') }}</label>
                <input class="form-control {{ $errors->has('clinic_phone') ? 'is-invalid' : '' }}" type="text" name="clinic_phone" id="clinic_phone" value="{{ old('clinic_phone', '') }}">
                @if($errors->has('clinic_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clinic_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.clinic_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_1">{{ trans('cruds.clinic.fields.address_1') }}</label>
                <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', '') }}">
                @if($errors->has('address_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.address_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_2">{{ trans('cruds.clinic.fields.address_2') }}</label>
                <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                @if($errors->has('address_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_3">{{ trans('cruds.clinic.fields.address_3') }}</label>
                <input class="form-control {{ $errors->has('address_3') ? 'is-invalid' : '' }}" type="text" name="address_3" id="address_3" value="{{ old('address_3', '') }}">
                @if($errors->has('address_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.address_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="latitude">{{ trans('cruds.clinic.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}" required>
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.clinic.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.clinic.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Clinic::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.status_helper') }}</span>
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
    url: '{{ route('admin.clinics.storeMedia') }}',
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
@if(isset($clinic) && $clinic->image)
      var file = {!! json_encode($clinic->image) !!}
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
