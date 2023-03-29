@extends('layouts.cpanel.app')
@section('content')

    {{-- <div class="card"> --}}
        <div class="card w-50 mr-10">
            <div class="card-header  d-flex justify-content-between ">
                <div class="py-5 h3">اضافة العميل </div>
                <div class="form-group text-left  mb-0 py-3">
                    <a href="{{route("admin.clients.index")}}" class="btn btn-primary " type="submit">
                        الرجوع
                    </a>
                </div>
            </div>
        <div class="card-body">
            <form method="POST" action="{{ route("admin.clients.store") }}"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">الاسم ثلاثي</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.name_helper') }}</span> --}}
                </div>
                <div class="form-group">
                    <label class="" for="qualification">المؤهلات</label>
                    <input class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}" type="text"
                           name="qualification" id="qualification" value="{{ old('qualification','') }}"
                           required
                           >
                    @if($errors->has('qualification'))
                        <div class="invalid-feedback">
                            {{ $errors->first('qualification') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.qualification') }}</span> --}}
                </div>
                <div class="form-group">
                    <label class="required" for="specialty_id">نوع العميل</label>
                    <select class="form-control pl-0 pb-0 pt-0  {{ $errors->has('specialty') ? 'is-invalid' : '' }}"
                            name="specialty_id" id="specialty_id" required>
                        @foreach($specialties as $id => $entry)
                            <option
                                value="{{ $id }}" >{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('specialty'))
                        <div class="invalid-feedback">
                            {{ $errors->first('specialty') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.specialty_helper') }}</span> --}}
                </div>
                <div class="form-group ">
                    <div class="">
                        <label>التصنيف</label>
                        <select class="form-control pl-0 pb-0 pt-0" id="category" name="category">
                            <option value="" disabled selected>التصنيف </option>
                            @foreach($data['category_select'] as $category)
                                <option value="{{$category->value}}">{{$category->name}}		</option>

                            @endforeach


                        </select>
                        <label class="form-text text-muted text-danger" id="unit-error"></label>
                    </div>
                    <div class="form-group ">
                        <div class="">
                            <label>الصنف</label>
                            <select class="form-control pl-0 pb-0 pt-0" id="item" name="item">
                                <?php    $items=array('A','B','C','D')?>
                                <option value="" disabled selected>الصنف </option>
                                @foreach($items as $item1)
                                    <option value="{{$item1}}" >  {{$item1 }}	</option>

                                @endforeach


                            </select>
                            <label class="form-text text-muted text-danger" id="unit-error"></label>
                        </div>
                        <div class="form-group">
                            <label class="required" for="home_address">عنوان السكن</label>
                            <input
                                class="form-control {{ $errors->has('home_address') ? 'is-invalid' : '' }}"
                                type="text" name="home_address" id="home_address"
                                value="{{ old('home_address', '') }}" required>
                            @if($errors->has('home_address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('home_address') }}
                            </div>
                            @endif
                        </div>

                        <h3>بيانات التواصل والاتصال</h3>
                <div class="form-group">
                    <label class="" for="email">البريد الالكتروني</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email"
                           id="email" value="{{ old('email', '') }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.email_helper') }}</span> --}}
                </div>
                <div class="form-group">
                    <label class="required" for="phone">الهاتف</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                           id="phone" value="{{ old('phone', '') }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.phone_helper') }}</span> --}}
                </div>
                <div class="form-group">
                    <label for="mobile">الجوال</label>
                    <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text"
                           name="mobile" id="mobile"
                           value="{{ old('mobile', '') }}">
                    @if($errors->has('mobile'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.mobile_helper') }}</span> --}}
                </div>
                <div class="form-group">
                    <label class="required" for="whatsapp_phone">الواتساب</label>
                    <input class="form-control {{ $errors->has('whatsapp_phone') ? 'is-invalid' : '' }}"
                        type="text" name="whatsapp_phone" id="whatsapp_phone"
                        value="{{ old('whatsapp_phone', '') }}" required>
                    @if($errors->has('whatsapp_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('whatsapp_phone') }}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="facebook">فيسبوك</label>
                    <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                        type="text" name="facebook" id="facebook" value="" required>
                    @if($errors->has('facebook'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facebook') }}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="instagram">انستجرام</label>
                    <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                        type="text" name="instagram" id="instagram" value="" required>
                    @if($errors->has('instagram'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instagram') }}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="website">موقع ويب</label>
                    <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
                        type="text" name="website" id="website" value="" required>
                    @if($errors->has('website'))
                    <div class="invalid-feedback">
                        {{ $errors->first('website') }}
                    </div>
                    @endif
                </div>
                       <h3>عناوين العمل</h3>
                        <div class="form-group ">
                            <div class="">
                                <label> المنطقة الاولى</label>
                                <select class="form-control pl-0 pb-0 pt-0" id="area_1" name="area_1">
                                    <option value="" disabled selected>المنطقة </option>
                                    @foreach($data['area_1_select'] as $area_1)
                                        <option value="{{$area_1->value}}" >{{$area_1->name}}	</option>

                                    @endforeach


                                </select>
                                <label class="form-text text-muted text-danger" id="unit-error"></label>
                            </div>
                <div class="form-group">
                    <label for="address_1">العنوان الاولى</label>
                    <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text"
                           name="address_1" id="address_1" >
                    @if($errors->has('address_1'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_1') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.address_1_helper') }}</span> --}}
                </div>
                <div class="form-group ">
                    <div class="">
                        <label>المنطقة </label>
                        <select class="form-control pl-0 pb-0 pt-0" id="area_2" name="area_2">
                            <?php    $areas_2=array('الشمال','الجنوب','الوسطى','غزة')?>
                            <option value="" disabled selected>المنطقة الثانية </option>
                            @foreach($areas_2 as $area_2)
                                <option value="{{$area_2}}" >  {{$area_2 }}	</option>

                            @endforeach


                        </select>
                        <label class="form-text text-muted text-danger" id="unit-error"></label>
                    </div>
                <div class="form-group">
                    <label for="address_2">العنوان الثاني</label>
                    <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text"
                           name="address_2" id="address_2" value="{{ old('address_2','') }}">
                    @if($errors->has('address_2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_2') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.address_2_helper') }}</span> --}}
                </div>
                <div class="form-group ">
                    <div class="">
                        <label>المنطقة </label>
                        <select class="form-control pl-0 pb-0 pt-0" id="area_2" name="area_2">
                            <?php    $areas_3=array('الشمال','الجنوب','الوسطى','غزة')?>
                            <option value="" disabled selected>المنطقة الثالثة </option>
                            @foreach($areas_3 as $area_3)
                                <option value="{{$area_3}}" >  {{$area_3 }}	</option>

                            @endforeach


                        </select>
                        <label class="form-text text-muted text-danger" id="unit-error"></label>
                    </div>
                <div class="form-group">
                    <label for="address_3">العنوان الثالث</label>
                    <input class="form-control {{ $errors->has('address_3') ? 'is-invalid' : '' }}" type="text"
                           name="address_3" id="address_3" value="">
                    @if($errors->has('address_3'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_3') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.address_3_helper') }}</span> --}}
                </div>

                <div class="form-group">
                    <label for="latitude"> خط العرض</label>
                    <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text"
                           name="latitude" id="latitude" value="">
                    @if($errors->has('latitude'))
                        <div class="invalid-feedback">
                            {{ $errors->first('latitude') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.address_3_helper') }}</span> --}}
                </div>

                <div class="form-group">
                    <label for="longitude"> خط الطول</label>
                    <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text"
                           name="longitude" id="longitude" value="">
                    @if($errors->has('longitude'))
                        <div class="invalid-feedback">
                            {{ $errors->first('longitude') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.client.fields.address_3_helper') }}</span> --}}
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

