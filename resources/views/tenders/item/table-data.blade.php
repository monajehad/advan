  <!--begin::Table-->
<div class="table-responsive ">
    <table class="table table-bordered" id="items-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>رقم الصنف</th>
                <th>الاسم</th>
                <th>الوحدة</th>
                <th>الشكل الصيدلاني</th>
                @can('items-status')<th>الحالة</th>@endcan

                @can('items-update')<th>التعديل</th>@endcan
                @can('items-delete')<th>حذف</th>@endcan
            </tr>
        </thead>
        <tbody class="text-center font-size-sm">
        @forelse($data['items'] as $item)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td class="item_no">{{$item->item_no}}</td>
                    <td class="name">{{$item->name}}</td>
                    <td class="unit">{{$item->unit_name}}</td>
                    <td>
                       {{$item->shape_name}}
                    </td>
                    @can('items-status')
                        @if($item->status==1)
                        <td class="status">
                            <button class="btn btn-sm  btn-shadow btn-success change-status" data-item-id="{{$item->id}}" @cannot('items-status') disabled @endcannot>
                                مفعل
                            </button>
                        </td>
                        @elseif($item->status==0)
                        <td class="status">

                            <button class="btn btn-sm  btn-shadow btn-danger change-status" data-item-id="{{$item->id}}" @cannot('items-status') disabled @endcannot>
                                غير مفعل
                            </button>
                        </td>
                        @endif
                    @endcan
                    @can('items-update')
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-item" data-item-id="{{$item->id}}">
                        <i class="fa fa-pencil-square-o text-white font-weight-bold"></i>
                        </button>
                    </td>
                    @endcan
                    @can('items-delete')
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-item" data-item-id="{{$item->id}}">
                            <i class="fa fa-trash text-white font-weight-bold"></i>
                        </button>
                    </td>
                    @endcan
                </tr>
            @empty
                <tr>
                    <td class="text-muted text-center font-size-lg" colspan="8">لا يوجد أصناف</td>
                </tr>
            @endforelse
        </tbody>
    </table>
   
   

</div>
<div class="paging">
       {!! $data['items']->links() !!}
</div>
          

<!--End::Table-->