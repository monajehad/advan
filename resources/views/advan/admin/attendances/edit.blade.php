@extends('layouts.cpanel.app')
@section('content')

<div class="card w-50 mr-10">
    <div class="card-header  d-flex justify-content-between ">
        <div class="py-5 h3">تعديل  الحضور</div>
        <div class="form-group text-left  mb-0 py-3">
            <a href="{{route("admin.attendances.index")}}" class="btn btn-primary " type="submit">
                الرجوع
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attendances.update", [$attendance->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">المندوب</label>
                <select class="form-control  {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $attendance->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="date">التاريخ</label>
                <input class="form-control  {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="kt_datepicker_1" value="{{ old('date', $attendance->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>
            {{-- <div class="col-lg-4 col-md-9 col-sm-12">
                <input type="text" class="form-control" id="kt_datepicker_1" readonly="readonly" placeholder="Select date">
            </div> --}}
            <div class="form-group">
                <label class="required" for="start_time">بداية الوقت</label>
                <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="kt_timepicker_3" value="{{ old('start_time', $attendance->start_time) }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="end_date">نهاية الوقت</label>
                <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="kt_timepicker_2" value="{{ old('end_time', $attendance->end_time) }}">
                @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
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
