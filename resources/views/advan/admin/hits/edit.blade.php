

@extends('layouts.cpanel.app')
@section('content')

<div class="card w-50 mr-10">
    <div class="card-header  d-flex justify-content-between ">
        <div class="py-5 h3">تعديل الزيارات </div>
        <div class="form-group text-left  mb-0 py-3">
            <a href="{{route("admin.hits.index")}}" class="btn btn-primary " type="submit">
                الرجوع
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.hits.update", [$hit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">العميل</label>
                <select class="form-control pb-0  {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $hit->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="date">التاريخ</label>
                <input class="form-control  {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="kt_datepicker_1" value="{{ old('date', $hit->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="time">الوقت</label>
                <input class="form-control timepiker {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="kt_timepicker_2" value="{{ old('time', $hit->time) }}">
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="visit_type_id">نوع الزيارة</label>
                <select class="form-control pb-0 {{ $errors->has('visit_type') ? 'is-invalid' : '' }}" name="visit_type_id" id="visit_type_id" required>
                    @foreach($visit_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('visit_type_id') ? old('visit_type_id') : $hit->visit_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('visit_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visit_type') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="duration_visit">مدة الزيارة</label>
                <input class="form-control {{ $errors->has('duration_visit') ? 'is-invalid' : '' }}" type="text" name="duration_visit" id="duration_visit" value="{{ old('duration_visit', $hit->duration_visit) }}">
                @if($errors->has('duration_visit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('duration_visit') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="number_samples">عدد العينات</label>
                <input class="form-control {{ $errors->has('number_samples') ? 'is-invalid' : '' }}" type="text" name="number_samples" id="number_samples" value="{{ old('number_samples', $hit->number_samples) }}">
                @if($errors->has('number_samples'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number_samples') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="address">العنوان</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $hit->address) }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="report_type">نوع التقرير</label>
                <input class="form-control {{ $errors->has('report_type') ? 'is-invalid' : '' }}" type="text" name="report_type" id="report_type" value="{{ old('report_type', $hit->report_type) }}">
                @if($errors->has('report_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_type') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="report_status">حالة التقرير</label>
                <input class="form-control {{ $errors->has('report_status') ? 'is-invalid' : '' }}" type="text" name="report_status" id="report_status" value="{{ old('report_status', $hit->report_status) }}">
                @if($errors->has('report_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_status') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="user_id">المندوب</label>
                <select class="form-control pb-0 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $hit->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <label>التصنيف</label>
                    <select class="form-control pb-0" id="category" name="category">
                        <option value="" disabled selected>التصنيف </option>
                        @foreach($data['category_select'] as $category)
                            <option value="{{$category->value}}"{{ (old('category_id')? old('category_id') : $hit->category ?? '') == $category->value ? 'selected' : '' }}>{{$category->name}}		</option>

                        @endforeach


                    </select>
                    <label class="form-text text-muted text-danger" id="unit-error"></label>
                </div>
            <div class="form-group">
                <label for="note">الملاحظة</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note', $hit->note) }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
            </div>
            {{-- <div class="form-group">
                <label for="sms_id">{{ trans('cruds.hit.fields.sms') }}</label>
                <select class="form-control select2 {{ $errors->has('sms') ? 'is-invalid' : '' }}" name="sms_id" id="sms_id">
                    @foreach($sms as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sms_id') ? old('sms_id') : $hit->sms->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sms'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sms') }}
                    </div>
                @endif
            </div> --}}
            {{-- <div class="form-group">
                <label for="sms_message">{{ trans('cruds.hit.fields.sms_message') }}</label>
                <textarea class="form-control {{ $errors->has('sms_message') ? 'is-invalid' : '' }}" name="sms_message" id="sms_message">{{ old('sms_message', $hit->sms_message) }}</textarea>
                @if($errors->has('sms_message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sms_message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hit.fields.sms_message_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label>نوع الزيارة</label>
                <select class="form-control pb-0 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>النوع</option>
                    @foreach(App\Models\Hit::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $hit->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="categories">{{ trans('cruds.hit.fields.category') }}</label>--}}
{{--                <div style="padding-bottom: 4px">--}}
{{--                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>--}}
{{--                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>--}}
{{--                </div>--}}
{{--                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>--}}
{{--                    @foreach($categories as $id => $category)--}}
{{--                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $hit->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                @if($errors->has('categories'))--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('categories') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <span class="help-block">{{ trans('cruds.hit.fields.category_helper') }}</span>--}}
{{--            </div>--}}
<div class="form-group">
    <label>الحالة</label>
    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
        @foreach(App\Models\Hit::STATUS_SELECT as $key => $label)
            <option value="{{ $key }}" {{ old('status', $hit->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    @if($errors->has('status'))
        <div class="invalid-feedback">
            {{ $errors->first('status') }}
        </div>
    @endif
    {{-- <span class="help-block">{{ trans('cruds.hit.fields.status_helper') }}</span> --}}
</div>
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

