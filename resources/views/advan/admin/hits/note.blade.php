@extends('layouts.cpanel.app')
@section('content')

<div class="card" style="width:70vw;margin-right: 24px;">
    <div class="card-header bg-white">

        <div class="title title-color purple">
            <h3 class="pr-6">
                الملاحظات
            </h3>
        </div>
    </div>
    <div class="card-body">
        <form method="get" action="{{url('admin/note')}}">
            <div class="row">
                <div class="col-3 form-group">
                    <label class="control-label" for="y">{{ trans('global.year') }}</label>
                    <select name="y" id="y" class="form-control">
                        @foreach(array_combine(range(date("Y"), 2000), range(date("Y"), 2000)) as $year)
                        <option value="{{ $year }}" @if($year===old('y', Request::get('y', date('Y')))) selected @endif>
                            {{ $year }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3 form-group">
                    <label class="control-label" for="m">{{ trans('global.month') }}</label>
                    <select name="m" for="m" class="form-control">
                        <option value="0">اختر الشهر</option>
                        @foreach(cal_info(0)['months'] as $month)
                        {{--                                <option value="{{ $month }}" @if($month===old('m',
                        Request::get('m', date('F')))) selected @endif>--}}
                        <option value="{{ $month }}" @if($month===old('m', \Illuminate\Support\Facades\Request::get('m',
                            date('F')))) selected @endif>
                            {{ month()[$month] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3 form-group">
                    <label class="control-label" for="m">اليوم</label>
                    <select name="d" for="d" class="form-control">
                        <option value="0">اختر اليوم</option>
                        @for ($x = 1; $x <= 31; $x++) <option value="{{ $x }}" @if ($x===old('d',
                            \Illuminate\Support\Facades\Request::get('d') , date('D'))) selected @endif>
                            {{$x }}
                            </option>
                            @endfor
                    </select>
                </div>

                <div class="col-4">
                    <label class="control-label">&nbsp;</label><br>
                    <button class="btn btn-primary" type="submit">عرض</button>
                </div>
            </div>


        </form>

        <br>
        <br>
        <br>
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Hit">

            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.user') }}
                    </th>

                    <th>
                        وقت الاعتماد
                    </th>
                    <th>
                        الملاحظة
                    </th>
                </tr>
            </thead>
            <tbody>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>

                <td>
                </td>

            </tbody>
        </table>

        <div
 class="table-responsive datatable datatable-bordered datatable-head-custom datatable-default  table-striped table-hover   datatable-primary datatable-loaded">
 <table class="table table-bordered " id="kt-table">
     <thead class="datatable-head">
         <tr class="text-center fw-bold fs-6 text-gray-800">
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
            <td class="checkbox--solid"> <input type="checkbox" class="sub_chk" data-id="{{$hit->id}}"></td>
            <td class="name">
                {{$hit->client->name}}
            </td>
            <td class="category">
                {{$hit->category_name}}
            </td>
            <td class="unit">
                   {{$hit->area_1_name ??''}}
            </td>

            <td class="name">{{$hit->user->name ??''}}</td>
            <td class="name">{{$hit->date}}</td>
            <td class="name">{{$hit->time}}</td>
            <td class="name">{{$hit->note}}</td>

            {{-- <td class="name">{{$hit_stock->clinetHits->id}}</td> --}}

            {{-- @can('suppliers-status') --}}
                {{-- @if($hit->status==1) --}}
                <td class="status">
                    <button class="badge badge-pill badge-success "
                    {{-- data-hit-id="{{$hit->id}}" --}}
                         {{-- @cannot('suppliers-status') disabled @endcannot --}}
                         >
                       {{App\Models\Hit::STATUS_SELECT[$hit->status]}}
                    </button>
                </td>
                {{-- @elseif($hit->status==0) --}}
                {{-- <td class="status"> --}}

                    {{-- <button class="badge badge-pill badge-warning" --}}
                    {{-- data-hit-id="{{$hit->id}}" --}}
                        {{-- @cannot('suppliers-status') disabled @endcannot --}}

                        {{-- >
                        غير مفعل
                    </button>
                </td>
                @endif --}}
            {{-- @endcan --}}
      {{-- @can('hits-show') --}}
      <td>
        <a class=" edit-category" href="/admin/hits/{{$hit->id}}">
            <span class="svg-icon svg-icon-dark svg-icon-md"> <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--> </span>
        </a>
    </td>
    {{-- @endcan --}}
             {{-- @can('hits-update') --}}
             <td>
                 <a class=" edit-hit"
                 href="/admin/hits/{{$hit->id}}/edit"
                 >
                     <span class="svg-icon svg-icon-md"> <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                             viewBox="0 0 24 24" version="1.1">
                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 <rect x="0" y="0" width="24" height="24"></rect>
                                 <path
                                     d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                     fill="#000000" fill-rule="nonzero"
                                     transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                 </path>
                                 <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1">
                                 </rect>
                             </g>
                         </svg> </span>
                 </a>
             </td>
             {{-- @endcan --}}
             {{-- @can('hits-delete') --}}
             <td>
                 <button class=" btn-icon delete-hit" data-hit-id="{{$hit->id}}">
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
             <td class="text-muted text-center font-size-lg" colspan="10">لا يوجد زيارات</td>
         </tr>
         @endforelse
     </tbody>
 </table>
</div>
<div class="paging">
    {!! $hits->links() !!}
</div>








    </div>
</div>



@endsection
@section('script')
@parent
<script>
$(function() {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

    let dtOverrideGlobals = {
        buttons: dtButtons,
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        {
            {
                --ajax: "{{ route('admin.hits.note') }}", --
            }
        }
        "ajax": {
            url: "{{ route('admin.hits.note') }}",
            data: function(d) {
                d.y = '{{ request()->get('
                y ') }}';
                d.m = '{{ request()->get('
                m ') }}';
                d.start = '{{ request()->get('
                start ') }}';
                d.end = '{{ request()->get('
                end ') }}';
                d.d = '{{ request()->get('
                d ') }}';
            },
        },
        columns: [{
                data: 'placeholder',
                name: 'placeholder'
            },
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'client_name',
                name: 'client.name'
            },
            {
                data: 'user_name',
                name: 'user.name'
            },
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'note',
                name: 'note'
            },
        ],
        orderCellsTop: true,
        order: [
            [1, 'desc']
        ],
        pageLength: 100,
    };
    let table = $('.datatable-Hit').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    let visibleColumnsIndexes = null;
    $('.datatable thead').on('input', '.search', function() {
        let strict = $(this).attr('strict') || false
        let value = strict && this.value ? "^" + this.value + "$" : this.value

        let index = $(this).parent().index()
        if (visibleColumnsIndexes !== null) {
            index = visibleColumnsIndexes[index]
        }

        table
            .column(index)
            .search(value, strict)
            .draw()
    });
    table.on('column-visibility.dt', function(e, settings, column, state) {
        visibleColumnsIndexes = []
        table.columns(":visible").every(function(colIdx) {
            visibleColumnsIndexes.push(colIdx);
        });
    })
});
</script>
@endsection
