  <!--begin::Table-->
  <div class="table-responsive ">
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>الاسم</th>
                <th>النوع</th>
                {{-- @can('constants-status') --}}
                <th>الحالة</th>
                {{-- @endcan --}}
                {{-- @can('constants-update') --}}
                <th>التعديل</th>
                {{-- @endcan --}}
                {{-- @can('constants-delete') --}}
                <th>حذف</th>
                {{-- @endcan --}}
            </tr>
        </thead>
        <tbody class="text-center font-size-sm">
        @forelse($data['constants'] as $constant)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td>{{$constant->name}}</td>
                    <td>

                             {{$constant->type_name}}</td>
                             {{-- @can('constants-status') --}}

                    @if($constant->status==1)
                    <td class="status">
                        <button class="btn btn-sm  btn-shadow btn-success change-status" data-constant-id="{{$constant->id}}"
                             {{-- @cannot('constants-status') disabled @endcannot --}}
                             >
                             مفعل
                        </button>
                    </td>
                    @elseif($constant->status==0)
                    <td class="status">

                        <button class="btn btn-sm  btn-shadow btn-danger change-status" data-constant-id="{{$constant->id}}"
                             {{-- @cannot('constants-status') disabled @endcannot --}}
                             >
                             غير مفعل
                        </button>
                    </td>
                    @endif
                    {{-- @endcan --}}
                    {{-- @can('constants-update') --}}
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-constant" data-constant-id="{{$constant->id}}">
                        <i class="fa fa-pencil-square-o text-white font-weight-bold"></i>
                        </button>
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('constants-delete') --}}
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-constant" data-constant-id="{{$constant->id}}">
                            <i class="fa fa-trash text-white font-weight-bold"></i>
                        </button>
                    </td>
                    {{-- @endcan --}}
                </tr>
            @empty
                <tr>
                    <td class="text-muted text-center font-size-lg" colspan="12">لا يوجد ثوابت</td>
                </tr>
            @endforelse
        </tbody>
    </table>



</div>
<div class="paging">
{!! $data['constants']->links() !!}
</div>
