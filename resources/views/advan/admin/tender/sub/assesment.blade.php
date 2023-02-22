<div class="modal fade" id="assesment-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تقييم الأسعار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="assesment-form">
                    @if(isset($tender_data))
                        <input type="hidden" id="tender_id" name="tender_id" value="{{$tender_data['tender_id']}}">
                        <div class="row mx-6  my-3">
                            <div class="col-md-6 col-lg-6 col-sm-10">
                                <select class="form-control" name="citem_name" id="citem_name">
                                    <option value="" selected disabled>اختر الصنف</option>
                                    @forelse($tender_data['tenderItems'] as $item)
                                        <option value="{{$item->item_id}}">{{$item->item}}</option>
                                    @empty
                                        <option value="" disabled>لا يوجد أصناف لهذه المناقصة</option>
                                     @endforelse
                                </select>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-2">
                                <button type="button" id="add_competitor_item" name="add_competitor_item" class="btn btn-success btn-sm">
                                    إضافة  <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row mx-6">
                            <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table">
                                <table class="table table-bordered pricing-table text-center">
                                    <thead>
                                        <tr>
                                            <th>اسم الصنف</th>
                                            <th width="15%">السعر</th>
                                            <th width="15%">العملة</th>
                                            <th>الشركة المنافسة</th>
                                            <th>ملاحظات</th>
                                            <th>إجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pricing-table-body">
                                        @forelse($tender_data['competitorsItems'] as $citem)
                                            <tr class="tr_{{$citem->item_id}}">
                                                <td><input type="hidden" name="citems[]" value="{{$citem->item_id}}">{{$citem->item}}</td>
                                                <td><input type="text" name="cprices[]" value="{{$citem->item_price}}" class="form-control"></td>
                                                <td>
                                                    <select class="form-control" name="currency_id[]" id="currency_id">
                                                        <option value="" selected>اختر العملة</option>
                                                        @foreach($currency_select as $currency)
                                                            <option value="{{$currency->value}}" {{($currency->value==$citem->currency_id)? 'selected' :''}}>{{$currency->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="competitors[]" id="competitors">
                                                        <option value="" selected>اختر المنافس</option>
                                                        @foreach($tender_data['competitors'] as $competitor)
                                                            <option value="{{$competitor->id}}" {{($competitor->id==$citem->competitor_id)? 'selected' :''}}>{{$competitor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" name="note[]" value="{{$citem->note}}" class="form-control"></td>
                                                
                                                <td>
                                                    <button class="btn btn-icon btn-danger btn-circle btn-sm remove-citem" title="حذف"><i class="fa fa-close"></i></button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="tr-no-data">
                                                <td class="text-muted text-center font-size-lg" colspan="6">لا يوجد أسعار لأصناف المنافسين</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row mx-6 my-3">
                            <div class="col-md-12 col-lg-12 buttons">
                                <button type="button" id="save_pricing" name="save_pricing" class="btn btn-sm btn-success" data-type="2">حفظ البيانات</button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
