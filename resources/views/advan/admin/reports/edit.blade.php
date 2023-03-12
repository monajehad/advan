

@extends('layouts.cpanel.app')
@section('content')

<div class="card w-50 mr-10">
    <div class="card-header  d-flex justify-content-between ">
        <div class="py-5 h3">تعديل التقرير </div>
        <div class="form-group text-left  mb-0 py-3">
            <a href="{{route("admin.reports.index")}}" class="btn btn-primary " type="submit">
                الرجوع
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.update", [$report->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">المندوب</label>
                <select class="form-control  {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option class="text-right" value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $report->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="type_id">نوع التقرير</label>
                <select class="form-control  {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id" required>
                    @foreach($types as $id => $entry)
                        <option class="text-right" value="{{ $id }}" {{ (old('type_id') ? old('type_id') : $report->type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="name">اسم التقرير</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $report->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="client_id">العميل</label>
                <select class="form-control  {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $entry)
                        <option class="text-right" value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $report->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="date">التاريخ</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date"  value="{{ old('date', $report->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="time">الوقت</label>
                <input class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time"  value="{{ old('time', $report->time) }}" required>
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="title">عنوان</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $report->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $report->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="note">الملاحظة</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note', $report->note) }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <?php if($report->status=='1')
                $report->status='on';
                ?>
                <div class="col-md-6 col-lg-6 col-sm-12 status-div">
                    <label>الحالة</label>
                    <span class="switch">
                        <label>
                            <input type="checkbox"   {{$report->status ? 'checked' : ''}} name="status" id="status">
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
