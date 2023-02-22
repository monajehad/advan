<form class="form" action="" id="accepting-items-form">
        <div class="row mx-6 my-3">
            <div class="col-md-3 col-lg-3">
                <select class="form-control" name="item_name1" id="item_name1">
                    <option value="" selected >اختر الصنف</option>
                        <option value="0"> تفريغ </option>
                        @foreach($items as $item)
                            <option value="{{$item->item_id}}">{{$item->item}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        @if(isset($items_data))
        <input type="hidden" id="tender_id" name="tender_id" value="{{$items_data['tender_id']}}">

        <div class="row mx-6" id="table-container">
            @include('advan.admin.tender.sub.table-data-accepting-items')
        </div>
        <div class="form-group row mx-6 my-3">
            <div class="col-md-12 col-lg-12 buttons">
                <button type="button" id="save_accepted_items" name="save_accepted_items" class="btn btn-sm btn-success">حفظ البيانات</button>
                {{-- <button type="button" id="save_pricing" name="save_pricing" class="btn btn-sm btn-success" data-type="6">حفظ البيانات</button> --}}
                <button type="button" id="previous1" name="previous" class="btn btn-sm btn-primary">السابق</button>
                <button type="button" id="stepone" name="next" class="btn btn-sm btn-primary">التالي</button>
            </div>
        </div>

    @endif
</form>
