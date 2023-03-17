<div class="col-md-12 col-lg-12 col-sm-12 scrollable-table">
    <table class="table table-bordered items-pricing-table text-center">
        <thead>
            <tr class="text-center fw-bold fs-6 text-gray-800">
                
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
                    <td><input type="hidden" name="items[]" class="items" value="{{$item->item_id}}">{{$item->item}}</td>
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
</div>