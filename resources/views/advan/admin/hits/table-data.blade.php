  <!--begin::Table-->
<div class="table-responsive">
    <table class="table table-bordered" id="sample-stocks-table">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>اسم العميل</th>
                <th> النوع</th>
                <th> المنطقة</th>
                <th>  المندوب</th>
                <th>  تاريخ الزيارة</th>
                <th> الوقت </th>

                <th> الملاحظات</th>


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
            @forelse($hits as $hit)
                <tr class="data-row">
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td class="name">
                        {{$hit->client->name}}
                    </td>
                    <td class="category">

                        {{$hit->category_name}}

                    </td>
                    <td class="unit">

                   {{-- @foreach ($items as $item) --}}


                        {{-- @if ($item->id == $item->id) --}}

                           {{$hit->client->address_1 ??''}}

                        {{-- @endif --}}
                     {{-- @endforeach --}}
                    </td>

                    <td class="name">{{$hit->user->name ??''}}</td>
                    <td class="name">{{$hit->date_time}}</td>
                    <td class="name">{{$hit->date_time}}</td>




                    {{-- <td class="name">{{$hit->sample->sample->name}}</td> --}}


                    <td class="name">{{$hit->note}}</td>

                    {{-- <td class="name">{{$hit_stock->clinetHits->id}}</td> --}}

                    {{-- @can('suppliers-status') --}}
                        @if($hit->status==1)
                        <td class="status">
                            <button class="btn btn-sm  btn-shadow btn-success change-status"
                            {{-- data-hit-id="{{$hit->id}}" --}}
                                 {{-- @cannot('suppliers-status') disabled @endcannot --}}
                                 >
                                مفعل
                            </button>
                        </td>
                        @elseif($hit->status==0)
                        <td class="status">

                            <button class="btn btn-sm  btn-shadow btn-danger change-status"
                            {{-- data-hit-id="{{$hit->id}}" --}}
                                {{-- @cannot('suppliers-status') disabled @endcannot --}}

                                >
                                غير مفعل
                            </button>
                        </td>
                        @endif
                    {{-- @endcan --}}
                    <td>
                        {{-- <button class="" --}}
                        {{-- data-hit-id="{{$hit->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" href="/admin/hits/{{$hit->id}}">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @can('suppliers-update') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" --}}
                        {{-- data-hit-id="{{$hit->id}}" --}}
                        {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-primary edit-supplier" href="/admin/hits/{{$hit->id}}/edit">
                             <i class="fa fa-pencil-square-o text-white font-weight-bold">
                            </i>

                            </a>

                        {{-- </button> --}}
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('suppliers-delete') --}}
                    <td>
                        {{-- <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" --}}
                         {{-- data-hit-id="{{$hit->id}}" --}}
                         {{-- > --}}
                            <a class="btn btn-sm btn-icon  btn-shadow btn-danger delete-supplier" href="{{route('admin.hits.destroy', $hit->id)}}">

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
{!! $hits->links() !!}
</div>
<!--End::Table-->
