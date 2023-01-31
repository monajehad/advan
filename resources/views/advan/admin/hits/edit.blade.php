@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.hit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.hits.update", [$hit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="clinic_id">{{ trans('cruds.hit.fields.clinic') }}</label>
                <select class="form-control select2 {{ $errors->has('clinic') ? 'is-invalid' : '' }}" name="clinic_id" id="clinic_id" required>
                    @foreach($clinics as $id => $entry)
                        <option value="{{ $id }}" {{ (old('clinic_id') ? old('clinic_id') : $hit->clinic->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('clinic'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clinic') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hit.fields.clinic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_time">{{ trans('cruds.hit.fields.date_time') }}</label>
                <input class="form-control datetime {{ $errors->has('date_time') ? 'is-invalid' : '' }}" type="text" name="date_time" id="date_time" value="{{ old('date_time', $hit->date_time) }}">
                @if($errors->has('date_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hit.fields.date_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="visit_type_id">{{ trans('cruds.hit.fields.visit_type') }}</label>
                <select class="form-control select2 {{ $errors->has('visit_type') ? 'is-invalid' : '' }}" name="visit_type_id" id="visit_type_id" required>
                    @foreach($visit_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('visit_type_id') ? old('visit_type_id') : $hit->visit_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('visit_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visit_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hit.fields.visit_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="duration_visit">{{ trans('cruds.hit.fields.duration_visit') }}</label>
                <input class="form-control {{ $errors->has('duration_visit') ? 'is-invalid' : '' }}" type="text" name="duration_visit" id="duration_visit" value="{{ old('duration_visit', $hit->duration_visit) }}">
                @if($errors->has('duration_visit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('duration_visit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hit.fields.duration_visit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="number_samples">{{ trans('cruds.hit.fields.number_samples') }}</label>
                <input class="form-control {{ $errors->has('number_samples') ? 'is-invalid' : '' }}" type="text" name="number_samples" id="number_samples" value="{{ old('number_samples', $hit->number_samples) }}">
                @if($errors->has('number_samples'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number_samples') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hit.fields.number_samples_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.hit.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $hit->address) }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hit.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="report_type">{{ trans('cruds.hit.fields.report_type') }}</label>
                <input class="form-control {{ $errors->has('report_type') ? 'is-invalid' : '' }}" type="text" name="report_type" id="report_type" value="{{ old('report_type', $hit->report_type) }}">
                @if($errors->has('report_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hit.fields.report_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="report_status">{{ trans('cruds.hit.fields.report_status') }}</label>
                <input class="form-control {{ $errors->has('report_status') ? 'is-invalid' : '' }}" type="text" name="report_status" id="report_status" value="{{ old('report_status', $hit->report_status) }}">
                @if($errors->has('report_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hit.fields.report_status_helper') }}</span>
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
                <span class="help-block">{{ trans('cruds.hit.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.hit.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note', $hit->note) }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hit.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
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
                <span class="help-block">{{ trans('cruds.hit.fields.sms_helper') }}</span>
            </div>
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
                <span class="help-block">{{ trans('cruds.hit.fields.type_helper') }}</span>
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
            </div>
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
                <span class="help-block">{{ trans('cruds.hit.fields.status_helper') }}</span>
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
