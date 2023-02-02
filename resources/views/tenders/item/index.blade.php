@extends('admin.layout.master')
@section('page-css')
<style>

    .scroll_div::-webkit-scrollbar {
    width: 5px;
    height: 10px
}

.scroll_div::-webkit-scrollbar-track {
    background-color: #f2f2f2;
}

.scroll_div::-webkit-scrollbar-thumb {
    background: #adaeb6;
    border-radius: 10px
}
.scroll_div{
    height: 430px ; overflow-y:auto;
}
</style>
@endsection
@section('page-title')
الأصناف
@endsection
@section('breadcrumb')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الرئيسية</h5>
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">الأصناف</span>

@endsection
@section('page-content')
<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">
                    الأصناف
                </span>
            </h3>
            <div class="card-toolbar">
                @can('items-add')
                    <button  class="btn btn-danger mx-1 font-size-sm" id="add-button"> <i class="fa fa-plus font-weight-bold"></i> إضافة صنف</button>
                    <button  class="btn btn-success mx-1 font-size-sm" id="import-button"> <i class="fa fa-file-excel-o font-weight-bold"></i> إضافة من إكسل</button>
                @endcan
                @can('items-export')
                    <a  href="{{route('item.export.excel')}}" class="btn btn-info mx-1 font-size-sm" id="export-button"> <i class="fa fa-file-excel-o font-weight-bold"></i> تصدير إكسل</a>
                @endcan
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        
        <div class="card-body py-0">
            @if(isset($errors) && $errors->any())
                <div class="row col-md-12 my-2 alert alert-custom alert-outline-2x alert-outline-danger fade show mb-5" role="alert">
					<div class="alert-icon">
						<i class="fa fa-exclamation-triangle"></i>
					</div>
					<div class="alert-text">
                        @foreach($errors->all() as $err)
                            {{$err}}
                        @endforeach
                    </div>
					<div class="alert-close">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">
							    <i class="fa fa-close"></i>
							</span>
						</button>
					</div>
				</div>
            @endif
            <div class="row mt-4">
                <div class="col-md-4 col-lg-4">
                    <form class="form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search_input" name="search_input" placeholder="الاسم"/>
                        </div>
                    </form>
                </div>
            </div>
            <!--begin::Table-->
            <div class="items-table-body"> @includeIf('admin.item.table-data')</div>
           
           <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>
    @includeIf('admin.item.sub.add')
</div>
<!--end::Container-->
@endsection
@section('page-js')

<script>
 
    function load_table_data(page=''){
       
        $.ajax({
                url: '{{url("item/")}}?page='+page ,
                data:{search:$('#search_input').val()},
                type: "get",
                success: function( response ) {
                    $('.items-table-body').html(response.items)

                },
                error:function(response){

                }
            });
    }
    // load_table_data()
	$(function(){
        $(document).on('click', '.pagination a',function(event){
            event.preventDefault();
            let url=$(this).attr('href');
            var page=url.split('page=')[1];
            load_table_data(page)
            // alert(page)
            // load_table_data()
            
        });
        
        $('#import-button').on('click',function(){
            $('#item-import-form').trigger("reset");
            $('#import-item-modal').modal('show');
        })
        $('#add-button').on('click',function(){
            $('#add-item .modal-title').text('إضافة صنف')
            $('#item-form').trigger("reset");
            $('#add-item').modal('show');
            $('.names-div').empty();
            $('.item_img').html('<i class="fa fa-upload"></i>')

            $('#hidden').val(0)
        })
        $('#search_input').keyup(function(){
            load_table_data()
        })
        $(document).on('click','.remove_name',function(e){
            e.preventDefault();
            $(this).closest('.name_input').remove()
        })
        $(document).on('click','.add-name',function(e){
            e.preventDefault();
            $('.names-div').append(`
                <div class="col-md-12 col-lg-12 col-sm-12 name_input my-2">
                    <div class="input-group">
                        <input type="text" name="names[]" id="names" class="form-control" placeholder="الاسم التجاري">
                        <div class="input-group-append">
                            <button class="btn btn-danger btn-icon remove_name" type="button" title="حذف الاسم"><i class="fa fa-close text-white"></i></button>
                        </div>
                    </div>
                </div>
            `)
        })
        $(document).on('click','.change-status',function(){
            var id = $(this).data('item-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{url("item/change/status/")}}/'+id,
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
        $(document).on('click','.delete-item',function(){
            var id = $(this).data('item-id');
            Swal.fire({
                title: 'هل أنت متأكد من حذف الصنف؟',
                showDenyButton: true,
                confirmButtonText: 'نعم',
                denyButtonText: `لا`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route("item.delete")}}' ,
                        type: "POST",
                        data: {id:id,_token:"{{csrf_token()}}"},
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
        $(document).on('click','.edit-item',function(){
            var id = $(this).data('item-id');

            $('#hidden').val(id)
            $('#add-item .modal-title').text('تعديل الصنف')
            $.ajax({
                url: '{{url("item/data/")}}/'+id,
                type: "get",
                success: function( response ) {
                    $('#item-form').trigger('reset')
                    $('.names-div').empty()
                    if(response.status==true){
                        
                        $('#name').val(response.item.name)
                        $('#item_no').val(response.item.item_no)
                        $('#unit').val(response.item.unit)
                        $('#shape').val(response.item.pharmaceutical_form)
                       
                        if(response.item.status==1){
                            $('#status').prop('checked', true);
                        }
                        else if(response.item.status==0){
                            $('#status').prop('checked', false);
                        }
                        if (response.item.names) {
                            for (let i = 0; i < response.item.names.length; i++) {
                                const element = response.item.names[i];
                                $('.add-name').click()
                                let added_div=$('.name_input:last-child')
                                added_div.find('#names').val(element)
                            }
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
                    $('#add-item').modal('show');
                }
            });
        
        })

         $('#item-form').validate({
            rules:{
                item_no:{
                    required: true,
                },
                name:{
                    required: true,
                },
                unit:{
                    required: true,
                },
                shape:{
                    required: true,
                },
            },
            messages: {
                item_no:{
                    required: "يجب إدخال رقم الصنف",
                },
                name:{
                    required: "يجب إدخال اسم الصنف",
                },
                unit:{
                    required: "يجب اختيار وحدة الصنف",
                },
                shape:{
                    required: "يجب اختيار الشكل الصيدلاني",
                },
            },
            submitHandler:function(event){
                postForm();
            }
        })
        $('#item-import-form').validate({
            rules:{
                file:{
                    required: true,
                }
            
            },
            messages: {
                file:{
                    required: "يجب رفع ملف الاكسل",
                }
            },
            submitHandler:function(event){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route("item.import.excel")}}' ,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: new FormData($('#item-import-form')[0]),
                    success: function( response ) {
                        if(response.status==true){
                            load_table_data()
                            Swal.fire({
                                showCloseButton: true,
                                icon: 'success',
                                title: 'نجاح اضافة البيانات من اكسل.',
                                text:response.success,
                                confirmButtonText: 'موافق'
                            })
                            
                            $('#item-import-form').trigger("reset");
                            $('#import-item-modal').modal('hide');

                        }else{
                            Swal.fire({
                                showCloseButton: true,
                                icon: 'error',
                                title: '',
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
    });
     function postForm(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let hidden=$('#hidden').val()
        if(hidden==0){
                $.ajax({
                url: '{{route("item.store")}}' ,
                type: "POST",
                processData: false,
                contentType: false,
                data: new FormData($('#item-form')[0]),
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
                        $('#item-form').trigger("reset");
                        $('#add-item').modal('hide');

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
                url: '{{route("item.update")}}' ,
                type: "POST",
                processData: false,
                contentType: false,
                data: new FormData($('#item-form')[0]),
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
                        
                        $('#item-form').trigger("reset");
                        $('#add-item').modal('hide');

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
      
    }
</script>
@endsection