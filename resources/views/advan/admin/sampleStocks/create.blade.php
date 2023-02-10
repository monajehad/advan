@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sampleStock.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sample-stocks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.sampleStock.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">رقم الباتش</label>
                <input class="form-control {{ $errors->has('patch_number') ? 'is-invalid' : '' }}" type="text" name="patch_number" id="patch_number" value="{{ old('patch_number', '') }}" required>
                @if($errors->has('patch_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patch_number') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.sampleStock.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" id="quantity" value="{{ old('quantity', '') }}" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="received_quantity">{{ trans('cruds.sampleStock.fields.received_quantity') }}</label>
                <input class="form-control {{ $errors->has('received_quantity') ? 'is-invalid' : '' }}" type="text" name="received_quantity" id="received_quantity" value="{{ old('received_quantity', '') }}" required>
                @if($errors->has('received_quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('received_quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.received_quantity') }}</span>
            </div>
            {{-- <div class="form-group">
                <label for="received_date">{{ trans('cruds.sampleStock.fields.received_date') }}</label>
                <input class="form-control date {{ $errors->has('received_date') ? 'is-invalid' : '' }}" type="text" name="received_date" id="received_date" value="{{ old('received_date') }}">
                @if($errors->has('received_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('received_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.received_date_helper') }}</span>
            </div> --}}
            {{-- <div class="form-group">
                <label for="end_date">{{ trans('cruds.sampleStock.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}">
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.end_date_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.sampleStock.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.category_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label class="required" for="item_id">{{ trans('cruds.sampleStock.fields.item') }}</label>
                <select class="form-control select2 {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_id" id="item_id" required>
                    @foreach($items as $id => $entry)
                        <option value="{{ $id }}" {{ old('item_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('item'))
                    <div class="invalid-feedback">
                        {{ $errors->first('item') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.item_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label class="required">{{ trans('cruds.sampleStock.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SampleStock::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.status_helper') }}</span>
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
