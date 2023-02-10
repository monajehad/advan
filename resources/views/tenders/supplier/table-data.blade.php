  <!--begin::Table-->
<div class="table-responsive">
    <table class="table table-bordered" id="suppliers-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>الاسم بالعربي</th>
                <th>اسم بالانجليزي</th>
                <th>البريد الإلكتروني</th>
                <th>الجوال</th>
                <th>الهاتف</th>
                <th>العنوان</th>
                @can('suppliers-status')<th>الحالة</th>@endcan

                @can('suppliers-update')<th>التعديل</th>@endcan
                @can('suppliers-delete')<th>حذف</th>@endcan
            </tr>
        </thead>
        <tbody class="text-center font-size-sm">
            @forelse($suppliers as $supplier)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td class="ar_name">{{$supplier->ar_name}}</td>
                    <td class="en_name">{{$supplier->en_name}}</td>
                    <td class="email">{{$supplier->email}}</td>
                    <td class="mobile">{{$supplier->mobile}}</td>
                    <td class="phone">{{$supplier->phone}}</td>
                    <td class="address">{{$supplier->address}}</td>
                    {{-- @can('suppliers-status') --}}
                        @if($supplier->status==1)
                        <td class="status">
                            <button class="btn btn-sm  btn-shadow btn-success change-status" data-supplier-id="{{$supplier->id}}"
                                {{-- @cannot('suppliers-status') disabled @endcannot --}}
                                >
                                مفعل
                            </button>
                        </td>
                        @elseif($supplier->status==0)
                        <td class="status">

                            <button class="btn btn-sm  btn-shadow btn-danger change-status" data-supplier-id="{{$supplier->id}}"
                                 {{-- @cannot('suppliers-status') disabled @endcannot --}}
                                 >
                                غير مفعل
                            </button>
                        </td>
                        @endif
                    {{-- @endcan --}}

                    {{-- @can('suppliers-update') --}}
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" data-supplier-id="{{$supplier->id}}">
                        <i class="fa fa-pencil-square-o text-white font-weight-bold"></i>
                        </button>
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('suppliers-delete') --}}
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" data-supplier-id="{{$supplier->id}}">
                            <i class="fa fa-trash text-white font-weight-bold"></i>
                        </button>
                    </td>
                    {{-- @endcan --}}

                </tr>
            @empty
                <tr>
                    <td class="text-muted text-center font-size-lg" colspan="10">لا يوجد موردين</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="paging">
{!! $suppliers->links() !!}
</div>
<!--End::Table-->
