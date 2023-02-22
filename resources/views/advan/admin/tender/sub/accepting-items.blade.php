<div class="modal fade" id="accepting-items-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">مرحلة الترسية</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <form class="form" action="" id="accepting-items-form">
                <div class="modal-body">
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

                        {{-- <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table">
                            <table class="table table-bordered items-pricing-table text-center">
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>اسم الصنف</th>
                                        <th>تمت الترسية / عدم الترسية</th>
                                        <th>الأولوية</th>
                                    </tr>
                                </thead>
                                <tbody id="pricing-table-body">
                                    @forelse($items_data['tenderItems'] as $item)
                                        <tr id="tr_{{$item->id}}" class="{{($item->accepted_item==1)? 'bg-success-o-50':''}}">
                                            <td>{{$loop->iteration}}</td>
                                            <td><input type="hidden" name="items[]" value="{{$item->item_id}}">{{$item->item}}</td>
                                            <td>
                                                <span class="switch accept-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="accepted[]" value="yes" {{($item->accepted_item==1)? 'checked':''}}>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="switch priority-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="priorities[]" id="priorities" value="yes" {{($item->has_priority==1)? 'checked':''}} disabled>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="tr-no-data">
                                            <td class="text-muted text-center font-size-lg" colspan="3">لا يوجد أصناف للمناقصة</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                    <div class="form-group row mx-6 my-3">
                        <div class="col-md-12 col-lg-12 buttons">
                            <button type="button" id="save_accepted_items" name="save_accepted_items" class="btn btn-sm btn-success">حفظ</button>
                        </div>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
