  <!--begin::Table-->
<div class="table-responsive">
    <table class="table table-bordered" id="suppliers-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>اسم العميل</th>
                <th> النوع</th>
                <th> التخصص</th>
                <th> التصنيف</th>
                <th> المنطقة</th>
                <th> الزيارات</th>
                <th> العينات</th>


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
            @forelse($data['clients'] as $client)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td class="name">{{$client->name}}</td>
                    <td class="name">{{$client->category}}</td>
                    <td class="name">{{$client->specialty->name}}</td>
                    <td class="name">{{$client->item}}</td>
                    <td class="name">{{$client->area_1}}</td>
                    <td class="name">{{$client->clientHits()->count()}}</td>
                    {{-- <td class="name">{{$client->clientHits->number_samples->count()}}</td> --}}

                    {{-- <td class="name">{{$client->clinetHits->id}}</td> --}}

                    {{-- @can('suppliers-status') --}}
                        @if($client->status==1)
                        <td class="status">
                            <button class="btn btn-sm  btn-shadow btn-success change-status"
                            {{-- data-client-id="{{$client->id}}" --}}
                                 {{-- @cannot('suppliers-status') disabled @endcannot --}}
                                 >
                                مفعل
                            </button>
                        </td>
                        @elseif($client->status==0)
                        <td class="status">

                            <button class="btn btn-sm  btn-shadow btn-danger change-status"
                            {{-- data-client-id="{{$client->id}}" --}}
                                {{-- @cannot('suppliers-status') disabled @endcannot --}}

                                >
                                غير مفعل
                            </button>
                        </td>
                        @endif
                    {{-- @endcan --}}
                    <td>
                        {{-- <button class="" --}}
                        {{-- data-client-id="{{$client->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" href="/admin/clients/{{$client->id}}">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @can('suppliers-update') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" --}}
                        {{-- data-client-id="{{$client->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" href="/admin/clients/{{$client->id}}/edit">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('suppliers-delete') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" --}}
                         {{-- data-client-id="{{$client->id}}" --}}
                         {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" href="{{route('admin.clients.destroy', $client->id)}}">

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
{!! $data['clients']->links() !!}
</div>
<!--End::Table-->
