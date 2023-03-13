
@extends('layouts.cpanel.app')
@section('content')

<div class="card w-50 mr-10">
    <div class="card-header  d-flex justify-content-between ">
        <div class="py-5 h3"> تعديل طلب اجازة</div>
        <div class="form-group text-left  mb-0 py-3">
            <a href="{{route("admin.vacation-requests.index")}}" class="btn btn-primary " type="submit">
                الرجوع
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.vacation-requests.update", [$vacationRequest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">المندوب</label>
                <select class="form-control selectpicker {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $vacationRequest->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="days">الايام</label>
                <input class="form-control {{ $errors->has('days') ? 'is-invalid' : '' }}" type="text" name="days" id="days" value="{{ old('days', $vacationRequest->days) }}" required>
                @if($errors->has('days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('days') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="start_time"> تاريخ بداية الاجازة</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="kt_datepicker_2" value="{{ old('start_date', $vacationRequest->start_date) }}" required>
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="end_date">تاريخ انتهاء الاجازة</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="kt_datepicker_1" value="{{ old('end_date', $vacationRequest->end_date) }}">
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="reason">السبب</label>
                <textarea class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" name="reason" id="reason" required>{{ old('reason', $vacationRequest->reason) }}</textarea>
                @if($errors->has('reason'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reason') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required">الحالة</label>
                <select class="form-control selectpicker {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\VacationRequest::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $vacationRequest->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
            </div>
            <div class="form-group text-left">
                <button class="btn btn-primary w-50" type="submit">
                    حفظ
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
