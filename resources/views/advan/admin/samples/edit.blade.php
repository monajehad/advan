@extends('layouts.cpanel.app')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sample.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.samples.update", [$sample->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="sample_id">الاصناف</label>
                <select class="form-control select2 {{ $errors->has('sample') ? 'is-invalid' : '' }}" name="sample_id" id="sample_id" required>
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
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $sample->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sample.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity_request">كمية المندوب</label>
                <input class="form-control {{ $errors->has('quantity_request') ? 'is-invalid' : '' }}" type="text" name="quantity_request" id="quantity_request" value="{{ old('quantity_request', $sample->quantity_request) }}">
                @if($errors->has('quantity_request'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity_request') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sample.fields.quantity_request_helper') }}</span>
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
                <span class="help-block">{{ trans('cruds.sampleStock.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">العائلة</label>
                <select class="form-control select {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $sample->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sampleStock.fields.category_helper') }}</span>
            </div>

            <div class="form-group row">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <label>نوع العينة</label>
                    <select class="form-control" id="type" name="type">
                        <?php    $types=array('تسويق','توزيع')?>
                        <option value="" disabled selected>نوع العينة </option>
                        @foreach($types as $type)
                            <option value="{{$type}}" {{ ($sample->type ??'') == $type ? 'selected':'' }}>  {{$type }}	</option>

                        @endforeach


                    </select>
                    <label class="form-text text-muted text-danger" id="unit-error"></label>
                </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.sample.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Sample::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $sample->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sample.fields.status_helper') }}</span>
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
