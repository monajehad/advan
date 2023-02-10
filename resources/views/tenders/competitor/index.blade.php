@extends('layouts.cpanel.app')

@section('style')
@endsection
@section('title')
المنافسون
@endsection
@section('breadcrumb')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الرئيسية</h5>
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">المنافسون</span>

@endsection
@section('content')
<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">
                المنافسون
                </span>
            </h3>
            <div class="card-toolbar">
                {{-- @can('competitors-add') --}}
                    <button class="btn btn-danger font-size-sm" id="add_button"> <i class="fa fa-plus font-weight-bolder"></i> إضافة منافس</button>
                {{-- @endcan --}}
                {{-- @can('competitors-export') --}}
                <a  href="{{route('competitor.export.excel')}}" class="btn btn-info mx-1 font-size-sm" id="export-button"> <i class="fa fa-file-excel-o font-weight-bold"></i> تصدير إكسل</a>
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
            <div class="competitor-table">
                   @includeIf('tenders.competitor.table-data')
            </div>

           <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>
    @includeIf('tenders.competitor.sub.add')
</div>
<!--end::Container-->
@endsection
@section('script')

<script>
    function load_data_table(page='') {
        $.ajax({
            url: '{{url("competitor/")}}?page='+page ,
            data:{search:$('#search_input').val()},
            type: "get",
            success: function( response ) {
                $('.competitor-table').html(response.competitors)

            },
            error:function(response){
             }

        })
    }
    $(function () {
        $('#add_button').on('click',function(e) {
            $('.modal-title').text('إضافة منافس')
            $('#hidden').val(0)
            $('#competitor-form').trigger("reset");
            $('#color').val('#ffffff')
            $('#add-competitor').modal('show')
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
        $(document).on('click','.edit-competitor',function(){
            var id = $(this).data('competitor-id');
            $('#hidden').val(id)
            $('.modal-title').text('تعديل المنافس')
            $.ajax({
                url: '{{url("competitor/data/")}}/'+id,
                type: "get",
                success: function( response ) {
                    if(response.status==true){
                        console.log(response.competitor)
                        $('#name').val(response.competitor.name)
                        $('#email').val(response.competitor.email)
                        $('#mobile').val(response.competitor.mobile)
                        $('#phone').val(response.competitor.phone)
                        $('#address').val(response.competitor.address)
                        if (response.competitor.color!=null) {
                            $('#color').val(response.competitor.color)
                        }else{
                            $('#color').val('#ffffff')
                        }
                            if(response.competitor.status==1){
                                $('#status').prop('checked', true);
                            }
                            else if(response.competitor.status==0){
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
                    $('#add-competitor').modal('show');
                }
            });
        })
        $(document).on('click','.change-status',function(){
        var id = $(this).data('competitor-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url("competitor/change/status/")}}/'+id,
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
        $(document).on('click','.delete-competitor',function(){
            var id = $(this).data('competitor-id');
            Swal.fire({
                title: 'هل أنت متأكد من حذف المنافس؟',
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
                        url: '{{route("competitor.delete")}}' ,
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
        // $('#competitor-form').validate({
        //     rules:{
        //         name:{
        //             required: true,
        //         },

        //         email:{
        //             email:true
        //         },

        //     },
        //     messages: {
        //         name:{
        //             required: "يجب إدخال الاسم",
        //         },
        //         email:{
        //             email:"يجب إدخال بريد الكتروني صحيح"
        //         },

        //     },
        //     submitHandler:function(event){
        //         postForm();
        //     }
        // })

    })
    $(document).on('click','#save',function(){

    // function postForm() {
        let hidden=$('#hidden').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (hidden==0) {
            $.ajax({
                url: '{{route("competitor.store")}}' ,
                type: "POST",
                data: $('#competitor-form').serialize(),
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
                        $('#competitor-form').trigger("reset");
                        $('#add-competitor').modal('hide');
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
                url: '{{route("competitor.update")}}' ,
                type: "POST",
                data: $('#competitor-form').serialize(),
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

                        $('#competitor-form').trigger("reset");
                        $('#add-competitor').modal('hide');

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
