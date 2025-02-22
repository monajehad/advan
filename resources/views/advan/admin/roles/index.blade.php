
@extends('layouts.cpanel.app')

@section('title')
المجموعات
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
            <div class="card-header bg-white">

        <div class="title title-color green">
            <h3 class="pr-6">
                مجموعات المستخدمين
            </h3>
        </div>
    </div>
            <div class="card-toolbar">
                {{-- @can('hits-add') --}}
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
                    إضافة مجموعة
                </a>
                {{-- @endcan --}}

            </div>

        </div>

        <!--end::Header-->
        <!--begin::Body-->

        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="roles-table-body">

                 @includeIf('advan.admin.roles.table-data')

            </div>

            <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>

</div>
@includeIf('advan.admin.roles.create')

    <!--end::Container-->
    @endsection


    @section('script')
    @parent
    <script>
 function load_data_table(page = '') {
        $.ajax({
            url: '{{url("admin/roles/")}}?page=' + page,
            data: {
                search: $('#search_input').val()
            },
            type: "get",
            success: function(response) {
                $('.roles-table-body').html(response.roles)

            },
            error: function(response) {}

        })
    }
    $(function () {

    $('#search_input').keyup(function(){
    load_data_table()
})
})
    $(document).on('click','.delete-role',function(){
        var id = $(this).data('role-id');
        Swal.fire({
            title: 'هل أنت متأكد من حذف  الدور',
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
                    url: '{{route("admin.roles.delete")}}' ,
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


