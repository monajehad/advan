  <!--begin::Table-->
  <div class="table-responsive ">
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                {{-- @can('tenders-delete')  --}}
                <th class="text-center">
                    <label class="m-checkbox">
                        <input type="checkbox" class="check_main">
                        <span></span>
                    </label>
                </th>
                {{-- @endcan --}}
                <th>#</th>
                <th>رقم المناقصة</th>
                <th>فرع الشركة</th>
                <th>العميل</th>

                <th>تاريخ تقديم المناقصة</th>
                {{-- @can('tenders-another-branch')<th> تكرار </th>@endcan --}}


                {{-- @can('tenders-competitor')<th>تقييم الاسعار</th>@endcan --}}
                {{-- @can('tenders-accept-items') <th>الترسية</th>@endcan --}}
                {{-- @can('tenders-supply')<th>التوريد</th>@endcan --}}
                {{-- @can('tenders-update') --}}
                 <th>التعديل</th>
                 {{-- @endcan --}}
                {{-- @can('tenders-list')  --}}
                <th>عرض</th>
                {{-- @endcan --}}
                {{-- @can('tenders-delete') --}}
                  <th>حذف</th>
                  {{-- @endcan --}}
                {{-- @can('tenders-print-pdf') <th>إنشاء PDF</th>@endcan --}}
            </tr>
        </thead>
        <tbody class="text-center font-size-sm">
        @forelse($data['tenders'] as $tender)
                <tr class="data-row" @if($tender->bid_status==0) style="background-color: #f64e602b !important;"  @elseif($tender->bid_status==1)  style="background-color: #eef0f8 !important;"   @elseif($tender->bid_status==2) style="background-color: #9fed95 !important;"    @endif >
                    @can('tenders-delete')
                        <td class="text-center">
                            <label class="m-checkbox">
                                <input data-id="{{$tender->id }}"   type="checkbox" name="check_sub[]" class="check_sub">
                                <span></span>
                            </label>
                        </td>
                    @endcan
                    <td class="iteration">{{$loop->iteration}}</td>
                    <td>
                        <a href="" class="row_tender_no" data-tender-id="{{$tender->id}}"><span class="text-dark font-weight-bolder">{{$tender->tender_no}}</span></a>

                    </td>
                    <td>{{$tender->branch_name}}</td>
                    <td class="font-weight-boldest text-info">{{$tender->client}}</td>

                    <td>{{$tender->representation_date}}</td>
                    {{-- @can('tenders-another-branch')
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-secondary add_to_branch" data-tender-id="{{$tender->id}}" data-branch-name="{{$tender->branch_name}}" data-branch-id="{{$tender->comany_branch}}">
                            <i class="fa fa-exchange text-black font-weight-bold"></i>
                        </button>
                    </td>
                    @endcan --}}

                    {{-- @can('tenders-competitor')
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-warning asses-prices" data-tender-id="{{$tender->id}}">
                            <i class="fa fa-money text-white font-weight-bold"></i>
                        </button>
                    </td>
                    @endcan --}}
                    {{-- @can('tenders-accept-items')
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-info accept-tender-items" data-tender-id="{{$tender->id}}">
                            <i class="fa fa-check-square-o text-white font-weight-bold"></i>
                        </button>
                    </td>
                    @endcan --}}
                    {{-- @can('tenders-supply')
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-dark supply-tender-items" data-tender-id="{{$tender->id}}">
                            <i class="fa fa-truck text-white font-weight-bold"></i>
                        </button>
                    </td>
                    @endcan --}}
                    {{-- @can('tenders-update') --}}
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-primary edit-tender" data-tender-id="{{$tender->id}}">
                            <i class="fa fa-pencil-square-o text-white font-weight-bold"></i>
                        </button>
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('tenders-list') --}}
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-success show-tender" data-tender-id="{{$tender->id}}">
                            <i class="fa fa-eye text-white font-weight-bold"></i>
                        </button>
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('tenders-delete') --}}
                    <td>
                        <button class="btn btn-sm btn-icon  btn-shadow btn-danger delete-tender" data-tender-id="{{$tender->id}}">
                            <i class="fa fa-trash text-white font-weight-bold"></i>
                        </button>
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('tenders-print-pdf')
                        <td>
                            <a target="_blank" class="btn btn-sm btn-icon  btn-shadow btn-danger generate-tender-pdf" data-tender-id="{{$tender->id}}">
                                <i class="fa fa-file-pdf-o text-white font-weight-bold"></i>
                            </a>
                        </td>
                    @endcan --}}
                </tr>
            @empty
                <tr>
                    <td class="text-muted text-center font-size-lg" colspan="12">لا يوجد مناقصات</td>
                </tr>
            @endforelse
        </tbody>
    </table>



</div>
<div class="paging">
{!! $data['tenders']->links() !!}
</div>
