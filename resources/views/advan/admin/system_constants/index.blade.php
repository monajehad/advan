@extends('layouts.cpanel.app')

@section('title')
ثوابت النظام
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

                ثوابت النظام
            </h2>
            <div class="card-toolbar">
                {{-- @can('users-add') --}}
                <button id="add-button" class="btn btn-primary font-size-sm ml-3"   >
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
                    إضافة ثابت
                </button>
                {{-- @endcan --}}

            </div>

        </div>
        {{-- <div class="mx-5 mb-4 py-4">
            <div class="col-md-4 col-lg-4 ml-8">
                <form class="form">
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">البحث</label>
                      <div class="col-lg-9 pr-0 col-md-9 col-sm-12">
                        <input type="text" class="form-control form-control-sm" id="search_input" name="search_input"  placeholder="الاسم"/>
                      </div>
                    </div>
                </form>
            </div>
        </div> --}}
        <!--end::Header-->
        <!--begin::Body-->

        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="constants-table-body">

               @includeIf('advan.admin.system_constants.table-data')

            </div>

            <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>

    @includeIf('advan.admin.system_constants.sub.add')

</div>
<div class="user-permission-body">

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
        // $('#constant-form').validate({
        //     rules:{
        //         name:{
        //             required: true,
        //         },

        //         type:{
        //             required:true
        //         },

        //     },
        //     messages: {
        //         name:{
        //             required: "يجب إدخال الاسم",
        //         },
        //         type:{
        //             required:"يجب اختيار نوع الثابت"
        //         },

        //     },

        // })
        $(document).on('click','.edit-constant',function(){
            var id = $(this).data('constant-id');
            $('#hidden').val(id)
            $('#add-constant .modal-title').text('تعديل الثابت')
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
