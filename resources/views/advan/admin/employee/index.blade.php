@extends('layouts.cpanel.app')

@section('title')
المستخدمون
@endsection
@section('style')
<style>
    #show-password,#show-new-password,#show-confirm-new-password{
        cursor: pointer;
    }

    .checkbox-cutom-label{
        font-size: 15px !important;
        font-weight: bold !important;
    }
</style>
@endsection
@section('breadcrumb')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الرئيسية</h5>
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">المستخدمون</span>

@endsection
@section('content')
<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">
                    المستخدمون
                </span>
            </h3>
            <div class="card-toolbar">
                {{-- @can('users-add') --}}
                    <button id="add_button" class="btn btn-danger font-size-sm">
                        <i class="fa fa-plus font-weight-bolder"></i>
                        إضافة مستخدم
                    </button>
                {{-- @endcan --}}
                {{-- @can('users-export') --}}
                <a  href="{{route('admin.employee.export.excel')}}" class="btn btn-info mx-1 font-size-sm" id="export-button"> <i class="fa fa-file-excel-o font-weight-bold"></i> تصدير إكسل</a>
                {{-- @endcan --}}
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
       
        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="user-table-body">
                <!--begin::Search Form-->
										<div class="mb-7">
											<div class="row align-items-center">
												<div class="col-lg-9 col-xl-8">
													<div class="row align-items-center">
														<div class="col-md-4 my-2 my-md-0">
															<div class="input-icon">
																<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query">
																<span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
															</div>
														</div>
														<div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Status:</label>
																<div class="dropdown bootstrap-select form-control"><select class="form-control" id="kt_datatable_search_status">
																	<option value="">All</option>
																	<option value="1">Pending</option>
																	<option value="2">Delivered</option>
																	<option value="3">Canceled</option>
																	<option value="4">Success</option>
																	<option value="5">Info</option>
																	<option value="6">Danger</option>
																</select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" data-id="kt_datatable_search_status" title="All"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">All</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
															</div>
														</div>
														<div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Type:</label>
																<div class="dropdown bootstrap-select form-control"><select class="form-control" id="kt_datatable_search_type">
																	<option value="">All</option>
																	<option value="1">Online</option>
																	<option value="2">Retail</option>
																	<option value="3">Direct</option>
																</select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="false" data-id="kt_datatable_search_type" title="All"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">All</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-2" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
													<a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
												</div>
											</div>
										</div>
										<!--end::Search Form-->
										<!--end: Search Form-->
										<!--begin: Selected Rows Group Action Form-->
										<div class="mt-10 mb-5 collapse" id="kt_datatable_group_action_form" style="">
											<div class="d-flex align-items-center">
												<div class="font-weight-bold text-danger mr-3">Selected
												<span id="kt_datatable_selected_records">0</span>records:</div>
												<div class="dropdown mr-2">
													<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Update status</button>
													<div class="dropdown-menu dropdown-menu-sm">
														<ul class="nav nav-hover flex-column">
															<li class="nav-item">
																<a href="#" class="nav-link">
																	<span class="nav-text">Pending</span>
																</a>
															</li>
															<li class="nav-item">
																<a href="#" class="nav-link">
																	<span class="nav-text">Delivered</span>
																</a>
															</li>
															<li class="nav-item">
																<a href="#" class="nav-link">
																	<span class="nav-text">Canceled</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
												
											</div>
										</div>
										<!--end: Selected Rows Group Action Form-->
                 @includeIf('advan.admin.employee.table-data')
            </div>

           <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>

    @includeIf('advan.admin.employee.sub.add')

</div>
<div class="user-permission-body">

<!--end::Container-->
@endsection
@section('script')
<script>

function load_data_table(page='') {
    $.ajax({
        url: '{{url("admin/employee/")}}?page='+page ,
        data:{search:$('#search_input').val()},
        type: "get",
        success: function( response ) {
            $('.user-table-body').html(response.users)

        },
        error:function(response){
        }

    })
}
 $(function(){


     $(document).on('click','#show-password',function () {
        $('#show-password i').toggleClass("fa-eye-slash");
        let input = $("#password");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
     })
     $(document).on('click','#show-new-password',function () {
        $('#show-new-password i').toggleClass("fa-eye-slash");
        let input = $("#new_password");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
     })
     $(document).on('click','#show-confirm-new-password',function () {
        $('#show-confirm-new-password i').toggleClass("fa-eye-slash");
        let input = $("#confirm_new_password");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
     })
     $(document).on('click','.change-password',function () {
        var id = $(this).data('employee-id');
        $('#employee_id').val(id)
        $('#change-password-form').trigger("reset");
        $('#change-password-modal').modal('show')
     })
     $('#add_button').on('click',function(e) {
        $('.modal-title').text('إضافة مستخدم')
        $('#hidden').val(0)
        $('#user-form').trigger("reset");
        $('.password-div').show()
        $('#add-user').modal('show')
        $('#tender_alert').prop('checked', false);

     })
    $('#search_input').keyup(function(){
        load_data_table()
    })
    $(document).on('click', '.pagination a',function(event){
        event.preventDefault();
        let url=$(this).attr('href');
        var page=url.split('page=')[1];
        load_data_table(page)
    });
    $(document).on('click','.edit-employee',function(){
        var id = $(this).data('employee-id');
        $('#hidden').val(id)
        $('#add-user .modal-title').text('تعديل المستخدم')
        $('.password-div').hide()
        $.ajax({
            url: '{{url("admin/employee/data/")}}/'+id,
            type: "get",
            success: function( response ) {
                if(response.status==true){
                    $('#name').val(response.employee.name)
                    $('#username').val(response.employee.username)
                    $('#email').val(response.employee.email)
                    $('#mobile').val(response.employee.mobile)
                        if(response.employee.status==1){
                            $('#status').prop('checked', true);
                        }
                        else if(response.employee.status==0){
                            $('#status').prop('checked', false);
                         }


                }else{
                    Swal.fire({
                        showCloseButton: true,
                        icon: 'error',
                        title: response.error,
                        confirmButtonText: 'موافق'
                    })
                }

            },
            error:function(response){

            },
            complete:function(response){
                $('#add-user').modal('show');
            }
        });
    })

    $(document).on('click','.delete-user',function(){
        var id = $(this).data('employee-id');
        Swal.fire({
            title: 'هل أنت متأكد من حذف المستخدم؟',
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
                    url: '{{route("admin.employee.delete")}}' ,
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
    // $(document).on('click','.change-status',function(){
function postChangePasswordForm() {

        var id = $(this).data('employee-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url("admin/employee/change/status/")}}/'+id,
            type: "post",
            success: function( response ) {
                if(response.status==true){
                    load_data_table()
                }else{
                    Swal.fire({
                        showCloseButton: true,
                        icon: 'error',
                        title: response.error,
                        confirmButtonText: 'موافق'
                    })
                }

            },
            error:function(response){

            },

        });
    }

    //  $('#user-form').validate({
    //         rules:{
    //             name:{
    //                 required: true,
    //             },
    //             username:{
    //                 required: true,
    //             },
    //             email:{
    //                 required: true,
    //                 email:true
    //             },
    //             mobile:{
    //                 required: true,
    //             },
    //             password:{
    //                 required: true,
    //             },

    //         },
    //         messages: {
    //             name:{
    //                 required: "يجب إدخال الاسم بالكامل",
    //             },
    //             username:{
    //                 required: "يجب إدخال اسم المستخدم",
    //             },
    //             email:{
    //                 required: "يجب إدخال البريد الالكتروني ",
    //                 email:"يجب إدخال بريد الكتروني صحيح"

    //             },
    //             mobile:{
    //                 required: "يجب إدخال رقم الجوال",
    //             },
    //             password:{
    //                 required: "يجب إدخال كلمة السر",
    //             },
    //         },
    //         submitHandler:function(event){
    //             postForm();
    //         }
    // })
    $('#change-password-form').validate({
            rules:{
                new_password:{
                    required: true,
                },
                confirm_new_password:{
                    required: true,
                    equalTo:"#new_password"
                },

            },
            messages: {
                new_password:{
                    required: "يجب إدخال كلمة السر الجديدة",
                },
                confirm_new_password:{
                    required: "يجب إدخال تأكيد كلمة السر الجديدة",
                    equalTo:"كلمة السر و تأكيدها غير متطابقتان"

                },
            },
            submitHandler:function(event){
                postChangePasswordForm();
            }
    })


})
// function postForm() {
    $(document).on('click','#save',function(){

    let hidden=$('#hidden').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if (hidden==0) {
        $.ajax({
            url: '{{route("admin.employee.store")}}' ,
            type: "POST",
            data: $('#user-form').serialize(),
            success: function( response ) {
                if(response.status==true){
                    load_data_table()
                    Swal.fire({
                        showCloseButton: true,
                        icon: 'success',
                        title: 'نجاح الإضافة.',
                        text:response.success,
                        confirmButtonText: 'موافق'
                    })
                    $('#user-form').trigger("reset");
                    $('#add-user').modal('hide');

                }else{
                    Swal.fire({
                        showCloseButton: true,
                        icon: 'error',
                        title: 'خطأ في الإضافة',
                        text: response.error,
                        confirmButtonText: 'موافق'
                    })
                }
            },
            error:function(response){

            }
        });
    }else if(hidden>0){
        $.ajax({
            url: '{{route("admin.employee.update")}}' ,
            type: "POST",
            data: $('#user-form').serialize(),
            success: function( response ) {
                if(response.status==true){
                    load_data_table()
                    Swal.fire({
                        showCloseButton: true,
                        icon: 'success',
                        title: 'نجاح التعديل.',
                        text:response.success,
                        confirmButtonText: 'موافق'
                    })

                    $('#user-form').trigger("reset");
                    $('#add-user').modal('hide');

                }else{
                    Swal.fire({
                        showCloseButton: true,
                        icon: 'error',
                        title: 'خطأ في التعديل',
                        text: response.error,
                        confirmButtonText: 'موافق'
                        })
                }
            },
            error:function(response){

            }
        });

    }

})
// function postChangePasswordForm() {
    $(document).on('click','#change',function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            url: '{{route("admin.employee.change.password")}}' ,
            type: "POST",
            data: $('#change-password-form').serialize(),
            success: function( response ) {
                if(response.status==true){
                    load_data_table()
                    Swal.fire({
                        showCloseButton: true,
                        icon: 'success',
                        title: 'نجاح العملية.',
                        text:response.success,
                        confirmButtonText: 'موافق'
                    })
                    $('#change-password-form').trigger("reset");
                    $('#change-password-modal').modal('hide');

                }else{
                    Swal.fire({
                        showCloseButton: true,
                        icon: 'error',
                        title: 'خطأ ',
                        text: response.error,
                        confirmButtonText: 'موافق'
                    })
                }
            },
            error:function(response){

            }
        });
})
</script>
@endsection
