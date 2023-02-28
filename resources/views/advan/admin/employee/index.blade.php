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
        <div class="row mt-4">
            <div class="col-md-4 col-lg-4 ml-8">
                <form class="form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="search_input" name="search_input" placeholder="الاسم بالكامل"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="user-table-body">
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
