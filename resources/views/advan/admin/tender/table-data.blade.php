  <!--begin::Table-->
  <div class="table-responsive ">
    <table class="table table-bordered">
        <thead>
            <tr class="text-center fw-bold fs-6 text-gray-800">
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
                                <input data-id="{{$tender->id }}" type="checkbox" name="check_sub[]" class="check_sub">
                                <span>
                                    
                                </span>
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
                        <button class="btn btn-sm btn-icon btn-secondary add_to_branch" data-tender-id="{{$tender->id}}" data-branch-name="{{$tender->branch_name}}" data-branch-id="{{$tender->comany_branch}}">
                            <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Map\Marker2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                        </button>
                    </td>
                    @endcan --}}

                    {{-- @can('tenders-competitor')
                    <td>
                        <button class="btn btn-sm btn-icon btn-warning asses-prices" data-tender-id="{{$tender->id}}">
                           <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Group.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span>
                        </button>
                    </td>
                    @endcan --}}
                    {{-- @can('tenders-accept-items')
                    <td>
                        <button class="btn btn-sm btn-icon  btn-primary accept-tender-items" data-tender-id="{{$tender->id}}">
                            
                        <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Clipboard-check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
        <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                        </button>
                    </td>
                    @endcan --}}
                    {{-- @can('tenders-supply')
                    <td>
                        <button class="btn btn-sm btn-icon  btn-dark supply-tender-items" data-tender-id="{{$tender->id}}">
                            <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Loader.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M8,4 C8.55228475,4 9,4.44771525 9,5 L9,17 L18,17 C18.5522847,17 19,17.4477153 19,18 C19,18.5522847 18.5522847,19 18,19 L9,19 C8.44771525,19 8,18.5522847 8,18 C7.44771525,18 7,17.5522847 7,17 L7,6 L5,6 C4.44771525,6 4,5.55228475 4,5 C4,4.44771525 4.44771525,4 5,4 L8,4 Z" fill="#000000" opacity="0.3"/>
        <rect fill="#000000" opacity="0.3" x="11" y="7" width="8" height="8" rx="4"/>
        <circle fill="#000000" cx="8" cy="18" r="3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                        </button>
                    </td>
                    @endcan --}}
                    {{-- @can('tenders-update') --}}
                    <td>
                        <button class="btn btn-sm btn-icon btn-warning edit-tender" data-tender-id="{{$tender->id}}">
                            <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Edit.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
    </g>
</svg><!--end::Svg Icon--></span>
                        </button>
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('tenders-list') --}}
                    <td>
                        <button class="btn btn-sm btn-icon btn-info show-tender" data-tender-id="{{$tender->id}}">
                           
                        <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                        </button>
                    </td>
                    {{-- @endcan --}}
                    {{-- @can('tenders-delete') --}}
                    <td>
                        <button class="btn btn-sm btn-icon btn-danger delete-tender" data-tender-id="{{$tender->id}}">
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
