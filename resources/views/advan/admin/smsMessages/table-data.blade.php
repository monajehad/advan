  <!--begin::Table-->
<div class="table-responsive">
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>العنوان </th>
                <th> الرسالة </th>
                <th> المستخدم</th>




            </tr>
        </thead>
        <tbody class="text-center font-size-sm">
            @forelse($messages as $message)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td class="name">{{$message->name}}</td>
                    <td class="name">{{$message->email}}</td>
                    <td class="name">{{$message->mobile}}</td>

                    {{-- <td class="name">{{$user->clinetHits->id}}</td> --}}


                    <td>
                        {{-- <button class="" --}}
                        {{-- data-message-id="{{$message->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-message" href="/admin/messages/{{$message->id}}">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @can('message-update') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" --}}
                        {{-- data-message-id="{{$message->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-message" href="/admin/messages/{{$message->id}}/edit">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('message-delete') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-message" --}}
                         {{-- data-message-id="{{$message->id}}" --}}
                         {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-danger delete-message" data-message-id="{{$message->id}}">

                            <i class="fa fa-trash text-white font-weight-bold"></i>
                            {{-- </a> --}}
                        </button>
                    </td>
                    {{-- @endcan --}}

                </tr>
            @empty
                <tr>
                    <td class="text-muted text-center font-size-lg" colspan="10">لا يوجد رسالة</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="paging">
{!! $messages->links() !!}
</div>
<!--End::Table-->
