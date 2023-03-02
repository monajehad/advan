@extends('layouts.cpanel.app')

@section('title')
المنافسون
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

                جدول المنافسون

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
                    إضافة منافس
                </button>
                {{-- @endcan --}}

                   {{-- @can('users-export') --}}
                   <a href="{{route('competitor.export.excel')}}" class="btn btn-info mx-1 font-size-sm"
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
        <!--end::Header-->
        <!--begin::Body-->

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
        $('#add-button').on('click',function(e) {
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
