@extends('layouts.cpanel.app')

@section('style')
@endsection
@section('title')
الموردون
@endsection
@section('breadcrumb')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الرئيسية</h5>
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">الموردون</span>

@endsection
@section('content')
<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">
                الموردون
                </span>
            </h3>
            <div class="card-toolbar">
                {{-- @can('suppliers-add') --}}
                    <button class="btn btn-danger font-size-sm" id="add_supplier"> <i class="fa fa-plus font-weight-bolder"></i> إضافة مورد</button>
                {{-- @endcan --}}
                {{-- @can('suppliers-export') --}}
                <a  href="{{route('supplier.export.excel')}}" class="btn btn-info mx-1 font-size-sm" id="export-button"> <i class="fa fa-file-excel-o font-weight-bold"></i> تصدير إكسل</a>
                {{-- @endcan --}}
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="row mt-4">
            <div class="col-md-4 col-lg-4 ml-8">
                <form class="form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="search_input" name="search_input"  placeholder="الاسم"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="suppliers-table-body">  @includeIf('tenders.supplier.table-data')</div>

           <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>
    @includeIf('tenders.supplier.sub.add')
</div>
<!--end::Container-->
@endsection
@section('script')
    <script>

        function load_data_table(page='') {
            $.ajax({
                url: '{{url("supplier/")}}?page='+page ,
                data:{search:$('#search_input').val()},
                type: "get",
                success: function( response ) {
                    $('.suppliers-table-body').html(response.suppliers)

                },
                error:function(response){
                }

            })
        }
         $(function(){
             $('#add_supplier').on('click',function(e) {
                $('.modal-title').text('إضافة مورد')
                $('#hidden').val(0)
                $('#supplier-form').trigger("reset");
                $('#add-supplier').modal('show')
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
            $(document).on('click','.edit-supplier',function(){
                var id = $(this).data('supplier-id');
                $('#hidden').val(id)
                $('.modal-title').text('تعديل المورد')
                $.ajax({
                    url: '{{url("supplier/data/")}}/'+id,
                    type: "get",
                    success: function( response ) {
                        if(response.status==true){
                            $('#ar_name').val(response.supplier.ar_name)
                            $('#en_name').val(response.supplier.en_name)
                            $('#email').val(response.supplier.email)
                            $('#mobile').val(response.supplier.mobile)
                            $('#phone').val(response.supplier.phone)
                            $('#address').val(response.supplier.address)
                                if(response.supplier.status==1){
                                    $('#status').prop('checked', true);
                                }
                                else if(response.supplier.status==0){
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
                        $('#add-supplier').modal('show');
                    }
                });
            })
            $(document).on('click','.delete-supplier',function(){
                var id = $(this).data('supplier-id');
                Swal.fire({
                    title: 'هل أنت متأكد من حذف المورد؟',
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
                            url: '{{route("supplier.delete")}}' ,
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
            $(document).on('click','.change-status',function(){
                var id = $(this).data('supplier-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{url("supplier/change/status/")}}/'+id,
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

                });  })
            $(document).on('click', '.pagination a',function(event){
                event.preventDefault();
                let url=$(this).attr('href');
                var page=url.split('page=')[1];
                load_data_table(page)
            });
            $(document).on('click','.edit-supplier',function(){
                var id = $(this).data('supplier-id');
                $('#hidden').val(id)
                $('.modal-title').text('تعديل المورد')
                $.ajax({
                    url: '{{url("supplier/data/")}}/'+id,
                    type: "get",
                    success: function( response ) {
                        if(response.status==true){
                            $('#ar_name').val(response.supplier.ar_name)
                            $('#en_name').val(response.supplier.en_name)
                            $('#email').val(response.supplier.email)
                            $('#mobile').val(response.supplier.mobile)
                            $('#phone').val(response.supplier.phone)
                            $('#address').val(response.supplier.address)
                                if(response.supplier.status==1){
                                    $('#status').prop('checked', true);
                                }
                                else if(response.supplier.status==0){
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
                        $('#add-supplier').modal('show');
                    }
                });
            })
            $(document).on('click','.delete-supplier',function(){
                var id = $(this).data('supplier-id');
                Swal.fire({
                    title: 'هل أنت متأكد من حذف المورد؟',
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
                            url: '{{route("supplier.delete")}}' ,
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
            $(document).on('click','.change-status',function(){
                var id = $(this).data('supplier-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{url("supplier/change/status/")}}/'+id,
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
            })

            //  $('#supplier-form').validate({
            //         rules:{
            //             ar_name:{
            //                 required: true,
            //             },
            //             en_name:{
            //                 required: true,
            //             },
            //             email:{
            //                 required: true,
            //                 email:true
            //             },
            //             mobile:{
            //                 required: true,
            //             },
            //             phone:{
            //                 required: true,
            //             },
            //             address:{
            //                 required: true,
            //             },

            //         },
            //         messages: {
            //             ar_name:{
            //                 required: "يجب إدخال الاسم بالعربي",
            //             },
            //             en_name:{
            //                 required: "يجب إدخال الاسم بالانجليزي",
            //             },
            //             email:{
            //                 required: "يجب إدخال البريد الالكتروني ",
            //                 email:"يجب إدخال بريد الكتروني صحيح"

            //             },
            //             mobile:{
            //                 required: "يجب إدخال رقم الجوال",
            //             },
            //             phone:{
            //                 required: "يجب إدخال رقم الهاتف",

            //             },
            //             address:{
            //                 required: "يجب إدخال العنوان",
            //             },
            //         },
            //         submitHandler:function(event){
            //             postForm();
            //         }
            // })

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
                    url: '{{route("supplier.store")}}' ,
                    type: "POST",
                    data: $('#supplier-form').serialize(),
                    success: function( response ) {
                        console.log('llll');
                        if(response.status==true){
                            load_data_table()
                            Swal.fire({
                                showCloseButton: true,
                                icon: 'success',
                                title: 'نجاح الإضافة.',
                                text:response.success,
                                confirmButtonText: 'موافق'
                            })
                            $('#supplier-form').trigger("reset");
                            $('#add-supplier').modal('hide');

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
                        console.log('llll');

                    }
                });
            }else if(hidden>0){
                $.ajax({
                    url: '{{route("supplier.update")}}' ,
                    type: "POST",
                    data: $('#supplier-form').serialize(),
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

                            $('#supplier-form').trigger("reset");
                            $('#add-supplier').modal('hide');

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
