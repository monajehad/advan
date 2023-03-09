
@extends('layouts.cpanel.app')
@section('content')


<div class="card w-50 mr-10">
    <div class="card-header  d-flex justify-content-between ">
        <div class="py-5 px-4 h3"> التفاصيل </div>
        <div class="form-group text-left  mb-0 py-3">
            <a href="{{route("admin.sample-stocks.index")}}" class="btn btn-primary " type="submit">
                الرجوع
            </a>
        </div>
    </div>
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <div class="card-toolbar">
                    <ul class="nav nav-light-success nav-bold nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_4_1">

                                <span class="nav-text h4">بيانات العينة</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_2">

                                <span class="nav-text h4">تاريخ العينة</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="tab-content"></div>
                <div class="tab-pane fade show " id="kt_tab_pane_4_1" role="tabpanel" aria-labelledby="kt_tab_pane_4_1">
                    <form >
                        <h3>تفاصيل العينة </h3>

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
                        <div class="form-group">
                            <label class="required" for="available">الكمية المتبقية</label>
                            <input class="form-control {{ $errors->has('available') ? 'is-invalid' : '' }}" type="text" name="available" id="available" value="{{ old('available', $sampleStock->available) ??''}}" required>
                            @if($errors->has('available'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('available') }}
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
                            <select disabled="disabled" class="form-control selectpicker {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
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
                            <select disabled="disabled" class="form-control  {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_id" id="item_id" required>
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
                                <label>الوحدة</label>
                                <select class="form-control " id="unit" name="unit">
                                    <option value="" disabled="disabled" > الوحدة</option>
                                    @foreach($data['unit_select'] as $unit)
                                        <option  value="{{$unit->value}}"{{ (old('unit_id')? old('unit_id') : $sampleStock->unit ?? '') == $unit->value ? 'selected' : '' }}>{{$unit->name}}</option>
                                    @endforeach
                                </select>
                                <label class="form-text text-muted text-danger" id="unit-error"></label>
                            </div>


                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                        </div>


                    </form>
                 </div>
                <div class="tab-pane fade" id="kt_tab_pane_4_2" role="tabpanel" aria-labelledby="kt_tab_pane_4_2">
                    <form >
                        <h3>تاريخ العينة </h3>

                        <div class="form-group">
                            <label class="required" for="name"> تاريخ الاضافة للمخزون</label>
                            <input class="form-control {{ $errors->has('received_date') ? 'is-invalid' : '' }}" type="text" name="received_date" id="received_date" value="{{ old('received_date', $sampleStock->received_date) }}" required>
                            @if($errors->has('received_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('received_date') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="required" for="end_date"> تاريخ النفاذ للمخزون</label>
                            <input class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $sampleStock->end_date) }}" required>
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                        </div>




                    </form>
            </div>

         </div>
        </div>
    </div>



@endsection
