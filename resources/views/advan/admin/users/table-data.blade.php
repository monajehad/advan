  <!--begin::Table-->
<div class="table-responsive">
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>اسم الثلاثي</th>
                <th> البريد الالكتروني</th>
                <th> الجوال</th>
                <th> السكن</th>
                <th> الرقم الوظيفي</th>
                <th> الزيارات</th>


                {{-- @can('user-status') --}}
                <th>الحالة</th>
                {{-- @endcan --}}
                <th>العرض</th>

                {{-- @can('user-update') --}}
                <th>التعديل</th>
                {{-- @endcan --}}

                {{-- @can('user-delete') --}}
                <th>حذف</th>
                {{-- @endcan --}}
            </tr>
        </thead>
        <tbody class="text-center font-size-sm">
            @forelse($users as $user)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td class="name">{{$user->name}}</td>
                    <td class="name">{{$user->email}}</td>
                    <td class="name">{{$user->mobile}}</td>
                    <td class="name">{{$user->home_address}}</td>
                    <td class="name">{{$user->jobId}}</td>
                    <td class="name">{{$user->userHits()->count()}}</td>

                    {{-- <td class="name">{{$user->clinetHits->id}}</td> --}}

                    {{-- @can('user-status') --}}
                        @if($user->status==1)
                        <td class="status">
                            <button class="btn btn-sm  btn-shadow btn-success change-status"
                            {{-- data-user-id="{{$user->id}}" --}}
                                 {{-- @cannot('user-status') disabled @endcannot --}}
                                 >
                                مفعل
                            </button>
                        </td>
                        @elseif($user->status==0)
                        <td class="status">

                            <button class="btn btn-sm  btn-shadow btn-danger change-status"
                            {{-- data-user-id="{{$user->id}}" --}}
                                {{-- @cannot('user-status') disabled @endcannot --}}

                                >
                                غير مفعل
                            </button>
                        </td>
                        @endif
                    {{-- @endcan --}}
                    <td>
                        {{-- <button class="" --}}
                        {{-- data-user-id="{{$user->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-user" href="/admin/users/{{$user->id}}">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @can('user-update') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" --}}
                        {{-- data-user-id="{{$user->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-user" href="/admin/users/{{$user->id}}/edit">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('user-delete') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-user" --}}
                         {{-- data-user-id="{{$user->id}}" --}}
                         {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-danger delete-user" data-user-id="{{$user->id}}">

                            <i class="fa fa-trash text-white font-weight-bold"></i>
                            {{-- </a> --}}
                        </button>
                    </td>
                    {{-- @endcan --}}

                </tr>
            @empty
                <tr>
                    <td class="text-muted text-center font-size-lg" colspan="10">لا يوجد مندوبين</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="paging">
{!! $users->links() !!}
</div>
<!--End::Table-->
