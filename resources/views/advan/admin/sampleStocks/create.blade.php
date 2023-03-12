
<style>
    .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 480px !important;

    top: -20px;
    pointer-events: auto;
    background-color: #fafafa;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0;
    outline: 0;
}

.image-input .image-input-wrapper {
    width: 100px;
    height: 100px;
    margin-bottom: 15px;
    border-radius: 0.42rem;
    background-repeat: no-repeat;
    background-size: cover;
}

.modal {
    position: fixed;
    top: 0;
    left: -122px;
    z-index: 1055;
    display: none;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
}
</style>


<div class="modal fade modal-lg" id="add_button" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة مخزون العينة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Close.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect x="0" y="7" width="16" height="2" rx="1" />
                                    <rect opacity="0.3"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) "
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>

                </button>
            </div>
            <form method="POST" action="{{ route("admin.sample-stocks.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>اسم العينة <span class="text-danger">*</span></label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
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
                        <label class="required" for="quantity">الكمية</label>
                        <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="text" name="quantity" id="quantity" value="{{ old('quantity', '') }}" required>
                        @if($errors->has('quantity'))
                            <div class="invalid-feedback">
                                {{ $errors->first('quantity') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="received_quantity">الكمية المستلمة</label>
                        <input class="form-control {{ $errors->has('received_quantity') ? 'is-invalid' : '' }}" type="text" name="received_quantity" id="received_quantity" value="{{ old('received_quantity', '') }}" required>
                        @if($errors->has('received_quantity'))
                            <div class="invalid-feedback">
                                {{ $errors->first('received_quantity') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="date">التاريخ</label>
                        <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                        @if($errors->has('date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('date') }}
                            </div>
                        @endif
                    </div>
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
                        <label class="required" for="category_id">التصنيف</label>
                        <select class="form-control  {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                            @foreach($categories as $id => $entry)
                                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <select class="form-control  {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_id" id="item_id" required>
                            @foreach($items as $id => $entry)
                                <option value="{{ $id }}" {{ old('item_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                                    <option value="{{$unit->value}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                            <label class="form-text text-muted text-danger" id="unit-error"></label>
                        </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12 status-div">
                            <label>الحالة</label>
                            <span class="switch">
                                <label>
                                    <input type="checkbox" checked="checked" name="status" id="status">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>

                </div>
                    <div class="card-footer">
                        <button type="submit"  class="btn btn-primary">حفظ</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>



            </form>


        </div>
    </div>
</div>

