  <!--begin::Table-->
<div class="table-responsive">
    <table class="table table-bordered" id="sample-stocks-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>اسم الصنف</th>
                <th> العائلة</th>
                <th> الوحدة</th>
                <th>  المندوب</th>
                <th>  كمية المندوب</th>
                <th> المخزون </th>
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
            @forelse($samples as $sample)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td class="name">
                        {{$sample->sample->name}}
                    </td>
                    <td class="name">
                        {{$sample->category->name }}
                    </td>
                    <td class="unit">

                   {{-- @foreach ($items as $item) --}}


                        {{-- @if ($item->id == $item->id) --}}

                           {{$sample->unit_name}}

                        {{-- @endif --}}
                     {{-- @endforeach --}}
                    </td>

                    <td class="name">{{$sample->user->name}}</td>
                    <td class="name">{{$sample->quantity_request}}</td>
                    <td class="name">{{$sample->sample->available}}</td>
                    <td class="name">{{$sample->date}}</td>

                    {{-- <td class="name">{{$sample_stock->clinetHits->id}}</td> --}}

                    {{-- @can('suppliers-status') --}}
                        @if($sample->status==1)
                        <td class="status">
                            <button class="btn btn-sm  btn-shadow btn-success change-status"
                            {{-- data-sample-id="{{$sample->id}}" --}}
                                 {{-- @cannot('suppliers-status') disabled @endcannot --}}
                                 >
                                مفعل
                            </button>
                        </td>
                        @elseif($sample->status==0)
                        <td class="status">

                            <button class="btn btn-sm  btn-shadow btn-danger change-status"
                            {{-- data-sample-id="{{$sample->id}}" --}}
                                {{-- @cannot('suppliers-status') disabled @endcannot --}}

                                >
                                غير مفعل
                            </button>
                        </td>
                        @endif
                    {{-- @endcan --}}
                    <td>
                        {{-- <button class="" --}}
                        {{-- data-sample-id="{{$sample->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" href="/admin/samples/{{$sample->id}}">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @can('suppliers-update') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" --}}
                        {{-- data-sample-id="{{$sample->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" href="/admin/samples/{{$sample->id}}/edit">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('suppliers-delete') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" --}}
                         {{-- data-sample-id="{{$sample->id}}" --}}
                         {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" href="{{route('admin.samples.destroy', $sample->id)}}">

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
{!! $samples->links() !!}
</div>
<!--End::Table-->
