@extends('layouts.cpanel.app')

@section('title')
الأصناف
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
        <div class="card-header border-1 mx-5 mb-4 py-4">
            <h2 class="card-title align-items-start flex-column">

                جدول الأصناف

            </h2>
            <div class="card-toolbar">
                {{-- @can('users-add') --}}
                <button id="add-button" class="btn btn-primary font-size-sm ml-3">
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
                    إضافة صنف
                </button>
                {{-- @endcan --}}
                {{-- @can('users-export') --}}
                <button class="btn btn-info mx-1 font-size-sm"
                id="import-button">
                    <span class="svg-icon svg-icon-md svg-icon-2x">
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Files\Export.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path
                                    d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <rect fill="#000000" opacity="0.3"
                                    transform="translate(12.000000, 8.000000) scale(1, -1) rotate(-180.000000) translate(-12.000000, -8.000000) "
                                    x="11" y="2" width="2" height="12" rx="1" />
                                <path
                                    d="M12,2.58578644 L14.2928932,0.292893219 C14.6834175,-0.0976310729 15.3165825,-0.0976310729 15.7071068,0.292893219 C16.0976311,0.683417511 16.0976311,1.31658249 15.7071068,1.70710678 L12.7071068,4.70710678 C12.3165825,5.09763107 11.6834175,5.09763107 11.2928932,4.70710678 L8.29289322,1.70710678 C7.90236893,1.31658249 7.90236893,0.683417511 8.29289322,0.292893219 C8.68341751,-0.0976310729 9.31658249,-0.0976310729 9.70710678,0.292893219 L12,2.58578644 Z"
                                    fill="#000000" fill-rule="nonzero"
                                    transform="translate(12.000000, 2.500000) scale(1, -1) translate(-12.000000, -2.500000) " />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    اضافة من إكسل</button>
                {{-- @endcan --}}
                   {{-- @can('users-export') --}}
                   <a href="{{route('item.export.excel')}}" class="btn btn-info mx-1 font-size-sm"
                   id="export-button">
                   <span class="svg-icon svg-icon-md svg-icon-2x">
                       <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Files\Export.svg--><svg
                           xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                           height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                               <rect x="0" y="0" width="24" height="24" />
                               <path
                                   d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z"
                                   fill="#000000" fill-rule="nonzero" opacity="0.3" />
                               <rect fill="#000000" opacity="0.3"
                                   transform="translate(12.000000, 8.000000) scale(1, -1) rotate(-180.000000) translate(-12.000000, -8.000000) "
                                   x="11" y="2" width="2" height="12" rx="1" />
                               <path
                                   d="M12,2.58578644 L14.2928932,0.292893219 C14.6834175,-0.0976310729 15.3165825,-0.0976310729 15.7071068,0.292893219 C16.0976311,0.683417511 16.0976311,1.31658249 15.7071068,1.70710678 L12.7071068,4.70710678 C12.3165825,5.09763107 11.6834175,5.09763107 11.2928932,4.70710678 L8.29289322,1.70710678 C7.90236893,1.31658249 7.90236893,0.683417511 8.29289322,0.292893219 C8.68341751,-0.0976310729 9.31658249,-0.0976310729 9.70710678,0.292893219 L12,2.58578644 Z"
                                   fill="#000000" fill-rule="nonzero"
                                   transform="translate(12.000000, 2.500000) scale(1, -1) translate(-12.000000, -2.500000) " />
                           </g>
                       </svg>
                       <!--end::Svg Icon-->
                   </span>
                   تصدير إكسل</a>
               {{-- @endcan --}}
            </div>

        </div>
        <div class="mx-5 mb-4 py-4">
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
        </div>
        <!--end::Header-->
        <!--begin::Body-->

        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="items-table-body">

                @includeIf('tenders.item.table-data')
            </div>

            <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>

    @include('tenders.item.sub.add')

</div>


<!--end::Container-->
@endsection
@section('script')

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
            load_table_data()

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

        //  $('#item-form').validate({
        //     rules:{
        //         item_no:{
        //             required: true,
        //         },
        //         name:{
        //             required: true,
        //         },
        //         unit:{
        //             required: true,
        //         },
        //         shape:{
        //             required: true,
        //         },
        //     },
        //     messages: {
        //         item_no:{
        //             required: "يجب إدخال رقم الصنف",
        //         },
        //         name:{
        //             required: "يجب إدخال اسم الصنف",
        //         },
        //         unit:{
        //             required: "يجب اختيار وحدة الصنف",
        //         },
        //         shape:{
        //             required: "يجب اختيار الشكل الصيدلاني",
        //         },
        //     },
        //     submitHandler:function(event){
        //         postForm();
        //     }
        // })
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
    $(document).on('click','#save-item',function(){
        let hidden=$('#hidden').val();

    //  function postForm(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(hidden==0){
                $.ajax({
                url: '{{route("item.store")}}' ,
                type: "POST",
                processData: false,
                contentType: false,
                data: new FormData($('#item-form')[0]),
                success: function( response ) {
                    console.log('hhhhs');

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
                    console.log('hhh');

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

    })
</script>
@endsection
