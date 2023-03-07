@extends('layouts.cpanel.app')

@section('title')
العينات
@endsection
@section('style')
<style>
#show-password,
#show-new-password,
#show-confirm-new-password {
    cursor: pointer;
}

.checkbox-cutom-label {
    font-size: 15px !important;
    font-weight: bold !important;
}
</style>
@endsection


@section('content')

<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4 mx-5 mb-4">
            <h2 class="card-title align-items-start flex-column">

                طلبات العينات
            </h2>
           <!--begin::Search Form-->
										<div class="mb-7">
											<div class="row align-items-center">
												<div class="col-lg-9 col-xl-8">
													<div class="row align-items-center">
														<div class="col-md-4 my-2 my-md-0">
															<div class="input-icon">
																<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
																<span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
															</div>
														</div>
														<div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Status:</label>
																<select class="form-control" id="kt_datatable_search_status">
																	<option value="">All</option>
																	<option value="1">Pending</option>
																	<option value="2">Delivered</option>
																	<option value="3">Canceled</option>
																	<option value="4">Success</option>
																	<option value="5">Info</option>
																	<option value="6">Danger</option>
																</select>
															</div>
														</div>
														{{-- <div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Type:</label>
																<select class="form-control" id="kt_datatable_search_type">
																	<option value="">All</option>
																	<option value="1">Online</option>
																	<option value="2">Retail</option>
																	<option value="3">Direct</option>
																</select>
															</div>
														</div> --}}
													</div>
												</div>
												<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
													<a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
												</div>
											</div>
										</div>
										<!--end::Search Form-->
										<!--end: Search Form-->
										<!--begin: Datatable-->
										<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
										<!--end: Datatable-->
									</div>
                </div>
            <div class="card-toolbar">
                {{-- @can('users-add') --}}
                <a data-toggle="modal" data-target="#add_button" class="btn btn-primary font-size-sm ml-3" >
                    <span class="svg-icon svg-icon-md svg-icon-2x">
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                <path
                                    d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                    fill="#000000" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    إضافة عينة
                </a>
                {{-- @endcan --}}

            </div>

        </div>
        <!--end::Header-->
        <!--begin::Body-->

        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="samples-table-body">

               @includeIf('advan.admin.samples.table-data')

            </div>

            <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>



</div>
@includeIf('advan.admin.samples.create')
    <!--end::Container-->
    @endsection




            {{-- <form method="get" action="{{url('admin/report')}}">
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="control-label" for="m">المندوب</label>
                        <select class="form-control" name="user_name">
                           <option value="">اختر مندوب</option>
                            @foreach($users as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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
                            @foreach(cal_info(0)['months'] as $month)
                                <option value="{{ $month }}" @if($month===old('m', Request::get('m', date('F')))) selected @endif>
                                    {{ month()[$month] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="control-label">&nbsp;</label><br>
                        <button class="btn btn-primary" type="submit">عرض التقرير</button>
                    </div>
                </div>


            </form>
         --}}

         @section('script')
         @parent
         <script>
         function load_data_table(page = '') {
        $.ajax({
            url: '{{url("admin/samples/")}}?page=' + page,
            data: {
                search: $('#search_input').val()
            },
            type: "get",
            success: function(response) {
                $('.samples-table-body').html(response.samples)

            },
            error: function(response) {}

        })
    }
         $(document).on('click','.delete-sample',function(){
             var id = $(this).data('sample-id');
             Swal.fire({
                 title: 'هل أنت متأكد من حذف  العينة',
                 showDenyButton: true,
                 confirmButtonText: 'نعم',
                 denyButtonText: `لا`,
             }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                     });
                     $.ajax({
                         url: '{{route("admin.samples.delete")}}' ,
                         type: "POST",
                         data: {id:id},
                         success: function( response ) {
                             if(response.status==true){
                                 Swal.fire({
                                     showCloseButton: true,
                                     icon: 'success',
                                     title: 'نجاح الحذف.',
                                     text:response.success,
                                     confirmButtonText: 'موافق'
                                 })
                                 load_data_table()
                             }else{
                                 Swal.fire({
                                     showCloseButton: true,
                                     icon: 'error',
                                     title: 'خطأ في الحذف',
                                     text: response.error,
                                     confirmButtonText: 'موافق'
                                  })
                             }
                         },
                         error:function(response){
                         }
                     })
                 }
             })

         })

     </script>
     @endsection


