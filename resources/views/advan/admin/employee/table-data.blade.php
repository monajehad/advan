  <!--begin::Table-->
<div class="table-responsive">
    <table class="table table-bordered" id="kt-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>الاسم بالكامل</th>
                <th>اسم المستخدم</th>
                <th>البريد الإلكتروني</th>
                <th>الجوال</th>
                {{-- @can('users-status') --}}
                <th>الحالة</th>
                {{-- @endcan --}}
                {{-- @can('users-update') --}}
                 <th>التعديل</th>
                 {{-- @endcan --}}
               {{-- @can('users-password')  --}}
               <th>تغيير كلمة السر</th>
               {{-- @endcan --}}
               {{-- @can('users-permissions') --}}
                <th>الصلاحيات</th>
                {{-- @endcan --}}
               {{-- @can('users-delete') --}}
               <th>حذف</th>
               {{-- @endcan --}}
            </tr>
        </thead>
        <tbody class="text-center font-size-sm">
            @forelse($employees as $employee)
                    <tr class="data-row">
                        <td class="iteration">{{$loop->iteration}}</td>
                        <td class="name">{{$employee->name}}</td>
                        <td class="username">{{$employee->username}}</td>
                        <td class="email">{{$employee->email}}</td>
                        <td class="mobile">{{$employee->mobile}}</td>
                        {{-- @can('users-status') --}}

                        @if($employee->status==1)
                        <td class="status">
                            <button class="btn btn-sm  btn-shadow btn-success change-status" data-employee-id="{{$employee->id}}"
                                {{-- @cannot('users-status') disabled @endcannot --}}
                                >
                                مفعل
                            </button>
                        </td>
                        @elseif($employee->status==0)
                        <td class="status">

                            <button class="btn btn-sm  btn-shadow btn-danger change-status" data-employee-id="{{$employee->id}}"
                                 {{-- @cannot('users-status')
                                  disabled
                                  @endcannot --}}
                                  >
                                غير مفعل
                            </button>
                        </td>
                        @endif
                        {{-- @endcan --}}
                        {{-- @can('users-update') --}}
                        <td>
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-employee" data-employee-id="{{$employee->id}}">
                                <i class="fa fa-pencil-square-o text-white font-weight-bold"></i>
                            </a>
                        </td>
                        {{-- @endcan --}}
                        {{-- @can('users-password') --}}
                        <td>
                            <button class="btn btn-sm btn-icon btn-shadow btn-info change-password" data-employee-id="{{$employee->id}}">
                                <i class="fa fa-lock text-white font-weight-bold"></i>
                            </button>
                        </td>
                        {{-- @endcan --}}
                        {{-- @can('users-permissions')  --}}
                        {{-- <td>
                            <button class="btn btn-sm btn-icon  btn-shadow btn-warning permissions-button" data-user-id="{{$user->id}}">
                                <i class="fa fa-user text-white font-weight-bold"></i>
                            </button>
                        </td>
                        @endcan --}}
                        {{-- @can('users-delete') --}}
                        <td>
                            <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-user" data-employee-id="{{$employee->id}}">
                                <i class="fa fa-trash text-white font-weight-bold"></i>
                            </button>
                        </td>
                        {{-- @endcan --}}
                    </tr>
                @empty
                    <tr>
                        <td class="text-muted text-center font-size-lg" colspan="10">لا يوجد مستخدمين</td>
                    </tr>
                @endforelse
        </tbody>
    </table>
</div>
<div class="paging">
{!! $employees->links() !!}
</div>

<!--End::Table-->
