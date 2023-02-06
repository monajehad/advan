  <!--begin::Table-->
<div class="table-responsive">
    <table class="table table-bordered" id="suppliers-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>اسم التخصص</th>

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
            @forelse($clients_specialt as $client_specialt)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td class="name">{{$client_specialt->name}}</td>

                    {{-- @can('suppliers-status') --}}
                        @if($client_specialt->status==1)
                        <td class="status">
                            <button class="btn btn-sm  btn-shadow btn-success change-status"
                            {{-- data-client_specialt-id="{{$client_specialt->id}}" --}}
                                 {{-- @cannot('suppliers-status') disabled @endcannot --}}
                                 >
                                مفعل
                            </button>
                        </td>
                        @elseif($client_specialt->status==0)
                        <td class="status">

                            <button class="btn btn-sm  btn-shadow btn-danger change-status"
                            {{-- data-client_specialt-id="{{$client_specialt->id}}" --}}
                                {{-- @cannot('suppliers-status') disabled @endcannot --}}

                                >
                                غير مفعل
                            </button>
                        </td>
                        @endif
                    {{-- @endcan --}}
                    <td>
                        {{-- <button class="" --}}
                        {{-- data-client_specialt-id="{{$client_specialt->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" href="/admin/clients-specialties/{{$client_specialt->id}}">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @can('suppliers-update') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" --}}
                        {{-- data-client_specialt-id="{{$client_specialt->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" href="/admin/clients-specialties/{{$client_specialt->id}}/edit">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('suppliers-delete') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" --}}
                         {{-- data-client_specialt-id="{{$client_specialt->id}}" --}}
                         {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" href="{{route('admin.clients-specialties.destroy', $client_specialt->id)}}">

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
{!! $clients_specialt->links() !!}
</div>
<!--End::Table-->
