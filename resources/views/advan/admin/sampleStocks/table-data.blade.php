  <!--begin::Table-->
<div class="table-responsive">
    <table class="table table-bordered" id="sample-stocks-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>اسم الصنف</th>
                <th> العائلة</th>
                <th> الوحدة</th>
                <th> كمية المخزون</th>
                <th> الكمية الموزعة</th>
                <th> الكمية المتبقية</th>
                <th> شهر/سنة</th>


                {{-- @can('suppliers-status') --}}
                <th>الحالة</th>
                {{-- @endcan --}}
                <th>العرض</th>

                {{-- @can('suppliers-update') --}}
                <th>التعديل</th>
                {{-- @endcan --}}

                {{-- @can('suppliers-delete') --}}
                <th>حذف</th>
                {{-- @endcan --}}
            </tr>
        </thead>
        <tbody class="text-center font-size-sm">
            @forelse($samples_stock as $sample_stock)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td class="name">
                        {{-- {{$sample_stock->item->name}} --}}
                    </td>
                    <td class="name">{{$sample_stock->category->name}}</td>
                    <td class="name">
                        {{-- {{$sample_stock->item->unit}} --}}
                    </td>
                    <td class="name">{{$sample_stock->quantity}}</td>
                    <td class="name">{{$sample_stock->received_quantity}}</td>
                    <td class="name">{{$sample_stock->quantity - $sample_stock->received_quantity}}</td>

                    {{-- <td class="name">{{$sample_stock->clinetHits->id}}</td> --}}

                    {{-- @can('suppliers-status') --}}
                        @if($sample_stock->status==1)
                        <td class="status">
                            <button class="btn btn-sm  btn-shadow btn-success change-status"
                            {{-- data-sample_stock-id="{{$sample_stock->id}}" --}}
                                 {{-- @cannot('suppliers-status') disabled @endcannot --}}
                                 >
                                مفعل
                            </button>
                        </td>
                        @elseif($sample_stock->status==0)
                        <td class="status">

                            <button class="btn btn-sm  btn-shadow btn-danger change-status"
                            {{-- data-sample_stock-id="{{$sample_stock->id}}" --}}
                                {{-- @cannot('suppliers-status') disabled @endcannot --}}

                                >
                                غير مفعل
                            </button>
                        </td>
                        @endif
                    {{-- @endcan --}}
                    <td>
                        {{-- <button class="" --}}
                        {{-- data-sample_stock-id="{{$sample_stock->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" href="/admin/sample_stocks/{{$sample_stock->id}}">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @can('suppliers-update') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" --}}
                        {{-- data-sample_stock-id="{{$sample_stock->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" href="/admin/sample_stocks/{{$sample_stock->id}}/edit">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('suppliers-delete') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" --}}
                         {{-- data-sample_stock-id="{{$sample_stock->id}}" --}}
                         {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" href="{{route('admin.sample-stocks.destroy', $sample_stock->id)}}">

                            <i class="fa fa-trash text-white font-weight-bold"></i>
                            {{-- </a> --}}
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
{!! $samples_stock->links() !!}
</div>
<!--End::Table-->
