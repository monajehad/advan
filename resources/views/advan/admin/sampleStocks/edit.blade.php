@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sampleStock.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sample-stocks.update", [$sampleStock->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.sampleStock.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $sampleStock->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.name_helper') }}</span>
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
                <label class="required" for="quantity">{{ trans('cruds.sampleStock.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" id="quantity" value="{{ old('quantity', $sampleStock->quantity) }}" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.quantity_helper') }}</span>
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
                <label for="date">{{ trans('cruds.sampleStock.fields.date') }}</label>
                <input class="form-control  {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $sampleStock->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.sampleStock.fields.category') }}</label>
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
                <span class="help-block">{{ trans('cruds.sampleStock.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="item_id">{{ trans('cruds.sampleStock.fields.item') }}</label>
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
                <span class="help-block">{{ trans('cruds.sampleStock.fields.item_helper') }}</span>
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
            <div class="form-group">
                <label class="required">{{ trans('cruds.sampleStock.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SampleStock::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $sampleStock->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.status_helper') }}</span>
            </div>

            <h2>تاريخ العينة </h2>

            <h4>تاريخ الاضافة للمخزون :  {{ $sampleStock->received_date }}</h4>
            <h4>تاريخ النفاذ للمخزون :  {{ $sampleStock->end_date }}</h4>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
