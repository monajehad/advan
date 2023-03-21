<!--begin::Table-->
<div
class="table-responsive datatable datatable-bordered datatable-head-custom datatable-default table-striped table-hover    datatable-primary datatable-loaded">
<table class="table table-bordered " id="kt-table">
    <thead class="datatable-head">
        <tr class="text-center fw-bold fs-6 text-gray-800">
            <th>#</th>
            <th>المرسل اليه</th>

            <th>العنوان </th>
            <th>المحتوى </th>

            <th>الحذف </th>
            {{-- <th>العرض </th> --}}

            {{-- <th>المحتوى </th> --}}

            {{-- @can('suppliers-status') --}}
            {{-- @endcan --}}


        </tr>
    </thead>
    <tbody class="text-center font-size-sm">
        @forelse($notifications as $notification)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td class="name">{{$notification->user->name ??''}}</td>

                    <td class="name">{{$notification->title}}</td>
                    <td class="name">{{$notification->body}}</td>

                    {{-- <td class="name">{{$notification->body}}</td> --}}



            {{-- @can('categories-delete') --}}
            <td>
                <button class=" btn-icon delete-type"  data-notification-id="{{$notification->id}}">
                    <span class="svg-icon svg-icon-md"> <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path
                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                    fill="#000000" fill-rule="nonzero"></path>
                                <path
                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                    fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg> </span>
                </button>
            </td>
            {{-- @endcan --}}

        </tr>
        @empty
        <tr>
            <td class="text-muted text-center font-size-lg" colspan="10">لا يوجد  اشعار</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>
<div class="paging">
    {{-- {!! $notifications->links() !!} --}}

</div>
