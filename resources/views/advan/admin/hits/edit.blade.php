

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


<div class="modal fade modal-lg" id="edit-hit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل الزيارة</h5>
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

            <form class="form"
            method="POST" action="{{ route("admin.hits.update", [$hit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label class="required" for="client_id">{{ trans('cruds.hit.fields.client') }}</label>
                        <select class="form-control select {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
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
                        <label for="date">{{ trans('cruds.hit.fields.date_time') }}</label>
                        <input class="form-control datepiker {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="kt_datepicker_1" value="{{ old('date', $hit->date) }}">
                        @if($errors->has('date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('date') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="time">{{ trans('cruds.hit.fields.time_time') }}</label>
                        <input class="form-control timepiker {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="kt_timepicker_2" value="{{ old('time', $hit->time) }}">
                        @if($errors->has('time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('time') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="visit_type_id">{{ trans('cruds.hit.fields.visit_type') }}</label>
                        <select class="form-control select {{ $errors->has('visit_type') ? 'is-invalid' : '' }}" name="visit_type_id" id="visit_type_id" required>
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
                        <label for="duration_visit">{{ trans('cruds.hit.fields.duration_visit') }}</label>
                        <input class="form-control {{ $errors->has('duration_visit') ? 'is-invalid' : '' }}" type="text" name="duration_visit" id="duration_visit" value="{{ old('duration_visit', $hit->duration_visit) }}">
                        @if($errors->has('duration_visit'))
                            <div class="invalid-feedback">
                                {{ $errors->first('duration_visit') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="number_samples">{{ trans('cruds.hit.fields.number_samples') }}</label>
                        <input class="form-control {{ $errors->has('number_samples') ? 'is-invalid' : '' }}" type="text" name="number_samples" id="number_samples" value="{{ old('number_samples', $hit->number_samples) }}">
                        @if($errors->has('number_samples'))
                            <div class="invalid-feedback">
                                {{ $errors->first('number_samples') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="address">{{ trans('cruds.hit.fields.address') }}</label>
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $hit->address) }}">
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="report_type">{{ trans('cruds.hit.fields.report_type') }}</label>
                        <input class="form-control {{ $errors->has('report_type') ? 'is-invalid' : '' }}" type="text" name="report_type" id="report_type" value="{{ old('report_type', $hit->report_type) }}">
                        @if($errors->has('report_type'))
                            <div class="invalid-feedback">
                                {{ $errors->first('report_type') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="report_status">{{ trans('cruds.hit.fields.report_status') }}</label>
                        <input class="form-control {{ $errors->has('report_status') ? 'is-invalid' : '' }}" type="text" name="report_status" id="report_status" value="{{ old('report_status', $hit->report_status) }}">
                        @if($errors->has('report_status'))
                            <div class="invalid-feedback">
                                {{ $errors->first('report_status') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="user_id">{{ trans('cruds.hit.fields.user') }}</label>
                        <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
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
                            <label>النوع</label>
                            <select class="form-control" id="category" name="category">
                                <option value="" disabled selected>التصنيف </option>
                                @foreach($data['category_select'] as $category)
                                    <option value="{{$category->value}}"{{ (old('category_id')? old('category_id') : $hit->category ?? '') == $category->value ? 'selected' : '' }}>{{$category->name}}		</option>

                                @endforeach


                            </select>
                            <label class="form-text text-muted text-danger" id="unit-error"></label>
                        </div>
                    <div class="form-group">
                        <label for="note">{{ trans('cruds.hit.fields.note') }}</label>
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
                    <div class="form-group">
                        <label for="sms_message">{{ trans('cruds.hit.fields.sms_message') }}</label>
                        <textarea class="form-control {{ $errors->has('sms_message') ? 'is-invalid' : '' }}" name="sms_message" id="sms_message">{{ old('sms_message', $hit->sms_message) }}</textarea>
                        @if($errors->has('sms_message'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sms_message') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.hit.fields.sms_message_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('cruds.hit.fields.type') }}</label>
                        <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                            <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
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
                    {{-- <div class="form-group">
                        <label for="doctors">{{ trans('cruds.hit.fields.doctors') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('doctors') ? 'is-invalid' : '' }}" name="doctors[]" id="doctors" multiple>
                            @foreach($doctors as $id => $doctor)
                                <option value="{{ $id }}" {{ (in_array($id, old('doctors', [])) || $hit->doctors->contains($id)) ? 'selected' : '' }}>{{ $doctor }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('doctors'))
                            <div class="invalid-feedback">
                                {{ $errors->first('doctors') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.hit.fields.doctors_helper') }}</span>
                    </div> --}}
                    <div class="form-group">
                        <label>{{ trans('cruds.hit.fields.status') }}</label>
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
</div>
