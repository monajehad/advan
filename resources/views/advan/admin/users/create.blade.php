
<style>
    .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 480px !important;

    top: -20px;
    pointer-events: auto;
    background-color: #fafafa;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0;
    outline: 0;
}

.image-input .image-input-wrapper {
    width: 100px;
    height: 100px;
    margin-bottom: 15px;
    border-radius: 0.42rem;
    background-repeat: no-repeat;
    background-size: cover;
}

.modal {
    position: fixed;
    top: 0;
    left: -122px;
    z-index: 1055;
    display: none;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
}
</style>


<div class="modal fade modal-lg" id="add_button" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة  تقرير</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Close.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect x="0" y="7" width="16" height="2" rx="1" />
                                    <rect opacity="0.3"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) "
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>

                </button>
            </div>
            <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="qualification">{{ trans('cruds.user.fields.qualification') }}</label>
                        <input class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}" type="text" name="qualification" id="qualification" value="{{ old('qualification', '') }}" required>
                        @if($errors->has('qualification'))
                            <div class="invalid-feedback">
                                {{ $errors->first('qualification') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.qualification_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" >
                        @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="mobile">{{ trans('cruds.user.fields.mobile') }}</label>
                        <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}" required>
                        @if($errors->has('mobile'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.mobile_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="whatsapp_phone">{{ trans('cruds.user.fields.whatsapp_phone') }}</label>
                        <input class="form-control {{ $errors->has('whatsapp_phone') ? 'is-invalid' : '' }}" type="text" name="whatsapp_phone" id="whatsapp_phone" value="{{ old('whatsapp_phone', '') }}" required>
                        @if($errors->has('whatsapp_phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('whatsapp_phone') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.mobile_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="home_address">{{ trans('cruds.user.fields.home_address') }}</label>
                        <input class="form-control {{ $errors->has('home_address') ? 'is-invalid' : '' }}" type="text" name="home_address" id="home_address" value="{{ old('home_address', '') }}" required>
                        @if($errors->has('home_address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('home_address') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.home_address_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="jobId">{{ trans('cruds.user.fields.jobId') }}</label>
                        <input class="form-control {{ $errors->has('jobId') ? 'is-invalid' : '' }}" type="text" name="jobId" id="jobId" value="{{ old('jobId', '') }}" required>
                        @if($errors->has('jobId'))
                            <div class="invalid-feedback">
                                {{ $errors->first('jobId') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.jobId_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="image">{{ trans('cruds.user.fields.image') }}</label>
                            <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">
                        @if($errors->has('image'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.image_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="category_id">عائلة الصنف</label>
                        <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                            @foreach($categories as $id => $entry)
                                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category'))
                            <div class="invalid-feedback">
                                {{ $errors->first('category') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.sample.fields.category_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="item_id">{{ trans('cruds.sampleStock.fields.item') }}</label>
                        <select class="form-control select2 {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_id" id="item_id" required>
                            @foreach($items as $id => $entry)
                                <option value="{{ $id }}" {{ old('item_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('item'))
                            <div class="invalid-feedback">
                                {{ $errors->first('item') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.sampleStock.fields.item_helper') }}</span>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12 status-div">
                            <label>الحالة</label>
                            <span class="switch">
                                <label>
                                    <input type="checkbox" checked="checked" name="status" id="status">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>

                </div>
                    <div class="card-footer">
                        <button type="submit"  class="btn btn-primary">حفظ</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>



            </form>


        </div>
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
