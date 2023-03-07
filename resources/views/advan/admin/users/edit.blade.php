@extends('layouts.cpanel.app')
@section('content')

<div class="card w-50 mr-10">
    <div class="card-header  d-flex justify-content-between ">
        <div class="py-5 h3"> تعديل  المندوب</div>
        <div class="form-group text-left  mb-0 py-3">
            <a href="{{route("admin.users.index")}}" class="btn btn-primary " type="submit">
                الرجوع
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">الاسم الثلاثي</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="qualification">المؤهل</label>
                <input class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}" type="text" name="qualification" id="qualification" value="{{ old('qualification', $user->qualification) }}" required>
                @if($errors->has('qualification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qualification') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="home_address">عنوان السكن</label>
                <input class="form-control {{ $errors->has('home_address') ? 'is-invalid' : '' }}" type="text" name="home_address" id="home_address" value="{{ old('home_address', $user->home_address) }}" required>
                @if($errors->has('home_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('home_address') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="jobId">الرقم الوظيفي</label>
                <input class="form-control {{ $errors->has('jobId') ? 'is-invalid' : '' }}" type="text" name="jobId" id="jobId" value="{{ old('jobId', $user->jobId) }}" required>
                @if($errors->has('jobId'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jobId') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="email">البريد الالكتروني</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="password">كلمة السر</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="mobile">الجوال</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $user->mobile) }}" required>
                @if($errors->has('mobile'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="phone">الهاتف</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="facebook">فيسبوك</label>
                <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text" name="facebook" id="facebook" value="{{ old('facebook', $user->facebook) }}" required>
                @if($errors->has('facebook'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facebook') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="instagram">انستجرام</label>
                <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text" name="instagram" id="instagram" value="{{ old('instagram', $user->instagram) }}" required>
                @if($errors->has('instagram'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instagram') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="website">موقع ويب</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', $user->website) }}" required>
                @if($errors->has('website'))
                    <div class="invalid-feedback">
                        {{ $errors->first('website') }}
                    </div>
                @endif
            </div>


            <div class="form-group">
                <label class="required" for="category_id">عائلة الصنف</label>
                <select class="form-control select {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $user->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="item_id">الصنف</label>
                <select class="form-control select {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_id" id="item_id" required>
                    @foreach($items as $id => $entry)
                        <option value="{{ $id }}" {{ (old('item_id')? old('item_id') : $user->item->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('item'))
                    <div class="invalid-feedback">
                        {{ $errors->first('item') }}
                    </div>
                @endif
            </div>
            {{-- <div class="form-group">
                <label for="image">{{ trans('cruds.user.fields.image') }}</label>
                @if($user->image)
                    <a href="{{ $user->image_url }}" target="_blank">
                        <img src="{{ $user->image_url }}" width="50px" height="50px">
                    </a>
                @endif

                <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.image_helper') }}</span>
            </div> --}}

            <div class="form-group">
                <?php if($user->status=='1')
                $user->status='on';
                ?>
            <div class="col-md-6 col-lg-6 col-sm-12 status-div">
                <label>الحالة</label>
                <span class="switch">
                    <label>
                        <input type="checkbox"   {{$user->status ? 'checked' : ''}} name="status" id="status">
                        <span></span>
                    </label>
                </span>
            </div>

            @if($errors->has('status'))
                <div class="invalid-feedback">
                    {{ $errors->first('status') }}
                </div>
            @endif
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary w-50" type="submit">
                حفظ
            </button>
        </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
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
@if(isset($user) && $user->image)
      var file = {!! json_encode($user->image) !!}
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
