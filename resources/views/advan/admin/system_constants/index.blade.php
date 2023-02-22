@extends('layouts.cpanel.app')

@section('style')
@endsection
@section('title')
ثوابت النظام
@endsection
@section('breadcrumb')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الرئيسية</h5>
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">ثوابت النظام</span>

@endsection
@section('content')
<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">
                ثوابت النظام
                </span>
            </h3>
            <div class="card-toolbar">
                {{-- @can('constants-add') --}}
                    <button  class="btn btn-danger font-size-sm" id="add-button"> <i class="fa fa-plus font-weight-bolder"></i> إضافة ثابت</button>
                {{-- @endcan --}}
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="row mt-4">
            <div class="col-md-4 col-lg-4 ml-8">
                <form class="form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="search_input" name="search_input" placeholder="الاسم"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="constants-table-body"> @include('advan.admin.system_constants.table-data')</div>

           <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>
    @includeIf('advan.admin.system_constants.sub.add')
</div>
<!--end::Container-->
@endsection
@section('script')

<script>
    function load_table_data(page=''){

       $.ajax({
               url: '{{url("admin/system/constants/")}}?page='+page ,
               data:{search:$('#search_input').val()},
               type: "get",
               success: function( response ) {
                   $('.constants-table-body').html(response.table_data)

               },
               error:function(response){

               }
           });
   }

	$(function(){

        $(document).on('click', '.pagination a',function(event){
            event.preventDefault();
            let url=$(this).attr('href');
            var page=url.split('page=')[1];
            load_table_data(page)

        });
        $('#search_input').keyup(function(){
            load_table_data()
        })
        $('#add-button').on('click',function(){
            $('.modal-title').text('إضافة ثابت نظام')
            $('#constant-form').trigger("reset");
            $('#add-constant').modal('show');
            $('#hidden').val(0)
        })
        $('#constant-form').validate({
            rules:{
                name:{
                    required: true,
                },

                type:{
                    required:true
                },

            },
            messages: {
                name:{
                    required: "يجب إدخال الاسم",
                },
                type:{
                    required:"يجب اختيار نوع الثابت"
                },

            },

        })
        $(document).on('click','.edit-constant',function(){
            var id = $(this).data('constant-id');
            $('#hidden').val(id)
            $('.modal-title').text('تعديل الثابت')
            $.ajax({
                url: '{{url("admin/system/constants/data/")}}/'+id,
                type: "get",
                success: function( response ) {
                    if(response.status==true){
                        $('#name').val(response.constant.name)
                        $('#type').val(response.constant.type)
                            if(response.constant.status==1){
                                $('#status').prop('checked', true);
                            }
                            else if(response.constant.status==0){
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
                    $('#add-constant').modal('show');
                }
            });

        })
        $(document).on('click','.delete-constant',function(){
            var id = $(this).data('constant-id');
            Swal.fire({
                title: 'هل أنت متأكد من حذف الثابت ؟',
                showDenyButton: true,
                confirmButtonText: 'نعم',
                denyButtonText: `لا`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{route("admin.system.constants.delete")}}' ,
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
                                load_table_data()
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
        $(document).on('click','.change-status',function(){
            var id = $(this).data('constant-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{url("admin/system/constants/change/status")}}/'+id,
                type: "post",
                success: function( response ) {
                    if(response.status==true){
                        load_table_data()
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
        })

    });
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
                url: '{{route("admin.system.constants.store")}}' ,
                type: "POST",
                data: $('#constant-form').serialize(),
                success: function( response ) {
                    if(response.status==true){
                        load_table_data()
                        Swal.fire({
                            showCloseButton: true,
                            icon: 'success',
                            title: 'نجاح الإضافة.',
                            text:response.success,
                            confirmButtonText: 'موافق'
                        })
                        $('#constant-form').trigger("reset");
                        $('#add-constant').modal('hide');
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
        }
        else if(hidden>0){
            $.ajax({
                url: '{{route("admin.system.constants.update")}}' ,
                type: "POST",
                data: $('#constant-form').serialize(),
                success: function( response ) {
                    if(response.status==true){
                        load_table_data()
                        Swal.fire({
                            showCloseButton: true,
                            icon: 'success',
                            title: 'نجاح التعديل.',
                            text:response.success,
                            confirmButtonText: 'موافق'
                        })

                        $('#constant-form').trigger("reset");
                        $('#add-constant').modal('hide');

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
</script>
@endsection
