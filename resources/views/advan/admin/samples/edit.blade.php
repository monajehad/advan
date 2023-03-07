
@extends('layouts.cpanel.app')
@section('content')

<div class="card w-50 mr-10">

    <div class="card-header  d-flex justify-content-between ">
        <div class="py-5 h3">تعديل العينة </div>
        <div class="form-group text-left  mb-0 py-3">
            <a href="{{route("admin.samples.index")}}"class="btn btn-primary " type="submit">
                الرجوع
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.samples.update", [$sample->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="sample_id">الاصناف</label>
                <select class="form-control selectpicker {{ $errors->has('sample') ? 'is-invalid' : '' }}" name="sample_id" id="sample_id" required>
                    @foreach($samples as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sample_id') ? old('sample_id') : $sample->sample->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sample'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sample') }}
                    </div>
                @endif
                <span class="help-block">المندوب</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.sample.fields.user') }}</label>
                <select class="form-control selectpicker {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $sample->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="quantity_request">كمية المندوب</label>
                <input class="form-control {{ $errors->has('quantity_request') ? 'is-invalid' : '' }}" type="text" name="quantity_request" id="quantity_request" value="{{ old('quantity_request', $sample->quantity_request) }}">
                @if($errors->has('quantity_request'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity_request') }}
                    </div>
                @endif
            </div>

            {{-- <div class="form-group">
                <label for="end_date">{{ trans('cruds.sample.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $sample->end_date) }}">
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sample.fields.end_date_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="date">شهر/سنة</label>
                <input class="form-control  {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $sample->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="category_id">العائلة</label>
                <select class="form-control selectpicker {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $sample->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
            </div>

            <div class="form-group row">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <label>نوع العينة</label>
                    <select class="form-control selectpicker" id="type" name="type">
                        <?php    $types=array('تسويق','توزيع')?>
                        <option value="" disabled selected>نوع العينة </option>
                        @foreach($types as $type)
                            <option value="{{$type}}" {{ ($sample->type ??'') == $type ? 'selected':'' }}>  {{$type }}	</option>

                        @endforeach


                    </select>
                    <label class="form-text text-muted text-danger" id="unit-error"></label>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <label>الوحدة</label>
                        <select class="form-control selectpicker" id="unit" name="unit">
                            <option value="" disabled selected>اختر الوحدة</option>
                            @foreach($data['unit_select'] as $unit)
                                <option value="{{$unit->value}}"{{ (old('unit_id')? old('unit_id') : $sample->unit ?? '') == $unit->value ? 'selected' : '' }}>{{$unit->name}}</option>
                            @endforeach
                        </select>
                        <label class="form-text text-muted text-danger" id="unit-error"></label>
                    </div>
                    <?php if($sample->status=='1')
                $sample->status='on';
                ?>
                    <div class="col-md-6 col-lg-6 col-sm-12 status-div">
                        <label>الحالة</label>
                        <span class="switch">
                            <label>
                                <input type="checkbox"   {{$sample->status ? 'checked' : ''}} name="status" id="status">
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
{{--
            <h2>تاريخ العينة </h2>

            <h4>تاريخ الاضافة للمخزون :  {{ $sampleStock->received_date }}</h4>
            <h4>تاريخ النفاذ للمخزون :  {{ $sampleStock->end_date }}</h4>

                --}}
            <div class="form-group text-center">
                <button class="btn btn-primary w-50" type="submit">
                    حفظ
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
