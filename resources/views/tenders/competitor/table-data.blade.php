  <!--begin::Table-->
  <div class="table-responsive">
    <table class="table table-bordered" id="kt-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الجوال</th>
                <th>الهاتف</th>
                <th>العنوان</th>
                {{-- @can('competitors-status') --}}
                <th>الحالة</th>
                {{-- @endcan --}}
                {{-- @can('competitors-update') --}}
                <th>التعديل</th>
                {{-- @endcan --}}
                {{-- @can('competitors-delete') --}}
                <th>حذف</th>
                {{-- @endcan --}}
            </tr>
        </thead>
        <tbody class="text-center font-size-sm">
            @forelse($competitors as $competitor)
                    <tr class="data-row">
                        <td class="iteration">{{$loop->iteration}}</td>
                        <td class="name">{{$competitor->name}}</td>
                        <td class="email">{{$competitor->email}}</td>
                        <td class="mobile">{{$competitor->mobile}}</td>
                        <td class="phone">{{$competitor->phone}}</td>
                        <td class="address">{{$competitor->address}}</td>
                        {{-- @can('delegators-status') --}}
                            @if($competitor->status==1)
                            <td class="status">
                                <button class="btn btn-sm  btn-shadow btn-success change-status" data-competitor-id="{{$competitor->id}}"
                                    {{-- @cannot('competitors-status') disabled @endcannot --}}
                                    >
                                    مفعل
                                </button>
                            </td>
                            @elseif($competitor->status==0)
                            <td class="status">

                                <button class="btn btn-sm  btn-shadow btn-danger change-status" data-competitor-id="{{$competitor->id}}"
                                    {{-- @cannot('competitors-status') disabled @endcannot --}}
                                    >
                                    غير مفعل
                                </button>
                            </td>
                            @endif
                        {{-- @endcan --}}

                        {{-- @can('competitors-update') --}}
                        <td>
                            <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-competitor" data-competitor-id="{{$competitor->id}}">
                            <i class="fa fa-pencil-square-o text-white font-weight-bold"></i>
                            </button>
                        </td>
                        {{-- @endcan --}}
                        {{-- @can('competitors-delete') --}}
                        <td>
                            <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-competitor" data-competitor-id="{{$competitor->id}}">
                                <i class="fa fa-trash text-white font-weight-bold"></i>
                            </button>
                        </td>
                        {{-- @endcan --}}

                    </tr>
                @empty
                    <tr>
                        <td class="text-muted text-center font-size-lg" colspan="8">لا يوجد منافسين</td>
                    </tr>
                @endforelse
        </tbody>
    </table>
</div>
<div class="paging">
{!! $competitors->links() !!}
</div>
<!--End::Table-->
