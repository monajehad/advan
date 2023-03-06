
@extends('layouts.cpanel.app')
@section('content')

<div class="card w-50 mr-10">
    <div class="card-header py-5 h3">
        تعديل مخزون العينة    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sample-stocks.update", [$sampleStock->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">اسم العينة</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $sampleStock->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="name">رقم الباتش</label>
                <input class="form-control {{ $errors->has('patch_number') ? 'is-invalid' : '' }}" type="text" name="patch_number" id="patch_number" value="{{ old('patch_number', $sampleStock->patch_number) }}" required>
                @if($errors->has('patch_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patch_number') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">الكمية</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" id="quantity" value="{{ old('quantity', $sampleStock->quantity) }}" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="received_quantity">الكمية المستلمة</label>
                <input class="form-control {{ $errors->has('received_quantity') ? 'is-invalid' : '' }}" type="text" name="received_quantity" id="received_quantity" value="{{ old('received_quantity', $sampleStock->received_quantity) }}" required>
                @if($errors->has('received_quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('received_quantity') }}
                    </div>
                @endif
            </div>
            {{-- <div class="form-group">
                <label for="received_date">{{ trans('cruds.sampleStock.fields.received_date') }}</label>
                <input class="form-control date {{ $errors->has('received_date') ? 'is-invalid' : '' }}" type="text" name="received_date" id="received_date" value="{{ old('received_date', $sampleStock->received_date) }}">
                @if($errors->has('received_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('received_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.received_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.sampleStock.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $sampleStock->end_date) }}">
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.end_date_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="date">التاريخ</label>
                <input class="form-control  {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $sampleStock->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="category_id">التصنيف</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $sampleStock->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="item_id">الصنف</label>
                <select class="form-control select2 {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_id" id="item_id" required>
                    @foreach($items as $id => $entry)
                        <option value="{{ $id }}" {{ (old('item_id')? old('item_id') : $sampleStock->item->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('item'))
                    <div class="invalid-feedback">
                        {{ $errors->first('item') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <label>الوحدة</label>
                    <select class="form-control" id="unit" name="unit">
                        <option value="" disabled selected>اختر الوحدة</option>
                        @foreach($data['unit_select'] as $unit)
                            <option value="{{$unit->value}}"{{ (old('unit_id')? old('unit_id') : $sampleStock->unit ?? '') == $unit->value ? 'selected' : '' }}>{{$unit->name}}</option>
                        @endforeach
                    </select>
                    <label class="form-text text-muted text-danger" id="unit-error"></label>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 status-div">
                    <label>الحالة</label>
                    <span class="switch">
                        <label>
                            <input type="checkbox"   {{$sampleStock->status ? 'checked' : ''}} name="status" id="status">
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
            <div class="form-group text-left">
                <button class="btn btn-primary w-50" type="submit">
                    حفظ
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
