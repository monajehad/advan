
                        <input type="hidden" id="tender_i" name="tender_i" value="{{$tender_supply_data['tender_id']}}">
                        <div class="row mx-6 my-3">
                            <div class="col-md-3 col-lg-3">
                                <select class="form-control" name="supply_item" id="supply_item">
                                    <option value="" selected>اختر الصنف</option>
                                    @forelse($tender_supply_data['tenderItems'] as $item)
                                        <option value="{{$item->item_id}}">{{$item->item}}</option>
                                    @empty
                                    <option value="" disabled>لا يوجد أصناف تم ترسيتها لهذه المناقصة</option>
                                    @endforelse
                                </select>  
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <input type="text" name="item_quantity" id="item_quantity" class="form-control" placeholder="كمية الصنف">
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <input style="width:inherit" type="text" class="form-control datepicker" name="sdate" id="sdate" readonly="readonly" placeholder="تاريخ التوريد">
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <button type="button" id="add_item_supply" name="add_item_supply" class="btn btn-success btn-sm" data-value="1">إضافة  <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="row mx-6" >
                            <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table">
                                <table class="table table-bordered supplied-items-table text-center">
                                    <thead>
                                        <tr>
                                            <th>اسم الصنف</th>
                                            <th>الكمية</th>
                                            <th>تاريخ التوريد</th>
                                            <th>إجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="supplied-items-body">
                                        @forelse($tender_supply_data['supplied_items'] as $sitem)
                                            <tr>
                                                <td>{{$sitem->item}}</td>
                                                <td>{{$sitem->quantity}}</td>
                                                <td>{{$sitem->date}}</td>
                                                <td>
                                                    <button class="btn btn-icon btn-danger btn-circle btn-sm remove-supplied-item" title="حذف" data-supplied-item="{{$sitem->id}}"><i class="fa fa-close"></i></button></td>
                                            </tr>
                                        @empty
                                            <tr class="tr-no-data">
                                                <td class="text-muted text-center font-size-lg" colspan="4">لا يوجد أصناف تم توريدها</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
