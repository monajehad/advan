
<style>
    .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 600px !important;

    top: -20px;
    pointer-events: auto;
    background-color: #fafafa;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0;
    outline: 0;
}
@media (min-width: 1080px){
.modal-lg, .modal-xl {
    max-width: 1000px;
}}
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


<div class="modal fade modal-lg" id="add_button" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة  عميل</h5>
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
            <div class="card card-custom">
                <div class="card-body p-0">
                    <!--begin: Wizard-->
                    <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first" data-wizard-clickable="true">
                        <!--begin: Wizard Nav-->
                        <div class="wizard-nav">
                            <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3" style="display:none;">
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                        <span>1.</span>Setup Location</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 1 Nav-->
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                        <span>2.</span>Enter Details</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                        <span>3.</span>Select Services</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 3 Nav-->
                                <!--begin::Wizard Step 4 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                        <span>4.</span>Delivery Address</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 4 Nav-->
                            </div>
                        </div>
                        <!--end: Wizard Nav-->
                        <!--begin: Wizard Body-->
                        <div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                            <div class="col-xl-12 col-xxl-12">
                                <!--begin: Wizard Form-->
                                <form class="form" id="form"
                               method="POST" action="{{ route("admin.clients.store") }}" enctype="multipart/form-data">
                                    @csrf
                                    <!--begin: Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <h4 class="mb-10 font-weight-bold text-dark">اضافة بيانات الشخصية</h4>
                                        <div class="image-input image-input-outline image-input-circle align-center" id="kt_image_3">
                                            <div class="image-input-wrapper" style="background-image: url(assets/media/users/100_3.jpg)">
                                            </div>

                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title="" data-original-title="تعديل الصورة">
                                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Edit.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="profile_avatar_remove" />
                                            </label>

                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="حذف الصورة">

                                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Close.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                            </span>
                                        </div>

                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label class="required" for="name">الاسم ثلاثي</label>
                                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                            @if($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                        <!--end::Input-->
                                        <div class="form-group">
                                            <label class="required" for="qualification">المؤهل العلمي</label>
                                            <input class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}" type="text" name="qualification" id="qualification" value="{{ old('qualification', '') }}" required>
                                            @if($errors->has('qualification'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('qualification') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="specialty_id">التخصص</label>
                                            <select class="form-control pl-0 pb-0 pt-0 {{ $errors->has('specialty') ? 'is-invalid' : '' }}" name="specialty_id" id="specialty_id" required>
                                                @foreach($specialties as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('specialty_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('specialty'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('specialty') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group ">
                                            {{-- <div class="col-md-6 col-lg-6 col-sm-12"> --}}
                                                <label>التصنيف</label>
                                                <select class="form-control pl-0 pb-0 pt-0" id="item" name="item">
                                                    <?php    $items=array('A','B','C','D')?>
                                                    <option value="" disabled selected>التصنيف </option>
                                                    @foreach($items as $item)
                                                        <option value="{{$item}}">  {{$item }}	</option>

                                                    @endforeach


                                                </select>
                                                <label class="form-text text-muted text-danger" id="unit-error"></label>
                                            </div>
                                        <div class="form-group">
                                            <label class="required" for="home_address">عنوان السكن</label>
                                            <input class="form-control {{ $errors->has('home_address') ? 'is-invalid' : '' }}" type="text" name="home_address" id="home_address" value="{{ old('home_address', '') }}" required>
                                            @if($errors->has('home_address'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('home_address') }}
                                                </div>
                                            @endif
                                        </div>


                                        </div>

                                    </div>
                                    <!--end: Wizard Step 1-->
                                    <!--begin: Wizard Step 2-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h4 class="mb-10 font-weight-bold text-dark">اضافة بيانات الاتصال والتواصل</h4>
                                        <div class="form-group">
                                            <label class="required" for="email">البريد الالكتروني</label>
                                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                                            @if($errors->has('email'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="" for="phone">الهاتف</label>
                                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" >
                                            @if($errors->has('phone'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="mobile">الجوال</label>
                                            <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}" required>
                                            @if($errors->has('mobile'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('mobile') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="whatsapp_phone">الواتساب</label>
                                            <input class="form-control {{ $errors->has('whatsapp_phone') ? 'is-invalid' : '' }}" type="text" name="whatsapp_phone" id="whatsapp_phone" value="{{ old('whatsapp_phone', '') }}" required>
                                            @if($errors->has('whatsapp_phone'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('whatsapp_phone') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="password">كلمة السر</label>
                                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                                            @if($errors->has('password'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label class="required" for="jobId">الرقم الوظيفي</label>
                                            <input class="form-control {{ $errors->has('jobId') ? 'is-invalid' : '' }}" type="text" name="jobId" id="jobId" value="" required>
                                            @if($errors->has('jobId'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('jobId') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="email">البريد الالكتروني</label>
                                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="" required>
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
                                            <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="" required>
                                            @if($errors->has('mobile'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('mobile') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="phone">الهاتف</label>
                                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="" required>
                                            @if($errors->has('phone'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="facebook">فيسبوك</label>
                                            <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text" name="facebook" id="facebook" value="" required>
                                            @if($errors->has('facebook'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('facebook') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="instagram">انستجرام</label>
                                            <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text" name="instagram" id="instagram" value="" required>
                                            @if($errors->has('instagram'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('instagram') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="website">موقع ويب</label>
                                            <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="" required>
                                            @if($errors->has('website'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('website') }}
                                                </div>
                                            @endif
                                        </div>


                                    </div>
                                    <!--end: Wizard Step 2-->
                                    <!--begin: Wizard Step 3-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h4 class="mb-10 font-weight-bold text-dark">اضافة عناوين العمل</h4>
                                        <div class="form-group">
                                            <label for="address_1">العنوان الاول</label>
                                            <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', '') }}">
                                            @if($errors->has('address_1'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('address_1') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <label>المنطقة</label>
                                                <select class="form-control pl-0 pb-0 pt-0" id="area_1" name="area_1">
                                                    <option value="" disabled selected> الشمال</option>
                                                    @foreach($data['area_1_select'] as $area_1)
                                                        <option value="{{$area_1->value}}">{{$area_1->name}}</option>
                                                    @endforeach
                                                </select>
                                                <label class="form-text text-muted text-danger" id="area_1-error"></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="address_2">العنوان الثاني</label>
                                                <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                                                @if($errors->has('address_2'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('address_2') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                    <label>المنطقة</label>
                                                    <select class="form-control pl-0 pb-0 pt-0" id="area_2" name="area_2">
                                                        <?php    $areas_2=array('الشمال','الجنوب','الوسطى','غزة')?>
                                                        <option value="" disabled selected>الشمال </option>
                                                        @foreach($areas_2 as $area_2)
                                                            <option value="{{$area_2}}">  {{$area_2 }}	</option>

                                                        @endforeach


                                                    </select>
                                                    <label class="form-text text-muted text-danger" id="unit-error"></label>
                                                </div>
                                            <div class="form-group">
                                                <label for="address_3">العنوان الثالث</label>
                                                <input class="form-control pl-0 pb-0 pt-0{{ $errors->has('address_3') ? 'is-invalid' : '' }}" type="text" name="address_3" id="address_3" value="{{ old('address_3', '') }}">
                                                @if($errors->has('address_3'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('address_3') }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.client.fields.address_3_helper') }}</span>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                    <label>المنطقة</label>
                                                    <select class="form-control pl-0 pb-0 pt-0" id="area_3" name="area_3">
                                                        <?php    $areas_3=array('الشمال','الجنوب','الوسطى','غزة')?>
                                                        <option value="" disabled selected>الشمال </option>
                                                        @foreach($areas_3 as $area_3)
                                                            <option value="{{$area_3}}">  {{$area_3 }}	</option>

                                                        @endforeach


                                                    </select>
                                                    <label class="form-text text-muted text-danger" id="unit-error"></label>
                                                </div>
                                                  <!--begin: Wizard Actions-->
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div class="mr-2">
                                            <button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-submit">Submit</button>
                                            <button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-next">Next</button>
                                        </div>
                                    </div>
                                    <!--end: Wizard Actions-->
                                    </div>
                                    <!--end: Wizard Step 3-->
                                    <!--begin: Wizard Step 4-->


                                </form>
                                <!--end: Wizard Form-->
                            </div>
                        </div>
                        <!--end: Wizard Body-->
                    </div>
                    <!--end: Wizard-->
                </div>
            </div>


        </div>
    </div>
</div>







{{--
@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.clients.storeMedia') }}',
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
@if(isset($client) && $client->image)
      var file = {!! json_encode($client->image) !!}
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
@endsection --}}
