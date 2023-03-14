
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
            <h2 class="card-title align-items-start flex-column">

                  المجموعات
            </h2>
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

    <div class="card mb-2" dir="rtl">
        <div class="card-head d-flex align-items-start align-items-sm-center justify-content-between flex-column flex-sm-row p-4 p-sm-5">
            <div class="title title-color purple me-5 mb-4 mb-sm-0 d-flex">
            <h3 class="section-title ml-7" style="margin-right: 20px; margin-left:20px">   طلبات </h3>
            <div class="nav row gx-4 ms-sm-auto flex-nowrap d-flex mb-4 mb-sm-0 align-self-stretch">
                <div class="btn-tab btn-small col  active" data-bs-target="#tab-products" data-bs-toggle="tab"><h4>العملاء</h4></div>
                <div class="btn-tab btn-small col " data-bs-target="#tab-traffic" data-bs-toggle="tab"><h4>العينات</h4></div>
              </div>
              <select class="select select-small tabs select-wide select-fill ms-auto d-md-none">
                <option value="#tab-products">العميل</option>
                <option value="#tab-traffic">العينات </option>
              </select>
                </div>
            <div class=" d-flex ">
                <div class="card-toolbar">
                    <a href="/metronic8/demo1/../demo1/pages/social/activity.html" class="btn btn-sm btn-light"> مشاهدة الكل</a>
                </div>

            </div>
          </div>
        <div class="card-body products tab-content">
          <div class="row g-0 pb-5 tab-pane fade active show" id="tab-products" role="tabpanel">
            <div class="sheet-table d-table ">

              <div class="d-table-row">
                <div class="d-table-cell py-4 px-5 caption">العميل</div>
                <div class="d-none d-md-table-cell py-4 ps-5 caption">التخصص</div>
                <div class="d-none d-md-table-cell py-4 ps-5 caption">المنطقة</div>
                <div class="d-table-cell py-4 caption">المندوب</div>
                <div class="d-table-cell py-4 px-5 caption">تاريخ الطلب</div>
              </div>

              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>

              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                <div class="sheet-cell d-table-cell py-3">اسنان</div>
                <div class="sheet-cell d-table-cell py-3">الوسطى</div>
              <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
              <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>

            </div>
          </div>
          <div class="row g-0 pb-5 tab-pane fade " id="tab-traffic" role="tabpanel ">
            <div class="sheet-table d-table ">
              <div class="d-table-row">
                <div class="d-table-cell py-4 px-5 caption">العميل</div>
                <div class="d-none d-md-table-cell py-4 ps-5 caption">التخصص</div>
                <div class="d-none d-md-table-cell py-4 ps-5 caption">المنطقة</div>
                <div class="d-table-cell py-4 caption">المندوب</div>
                <div class="d-table-cell py-4 px-5 caption">تاريخ الطلب</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>

              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                  <div class="sheet-cell d-table-cell py-3">اسنان</div>
                  <div class="sheet-cell d-table-cell py-3">الوسطى</div>
                <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
                <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>
              <div class="d-table-row grid-markup">
                <div class="sheet-cell d-table-cell py-3 px-5">سليم محمود العرجة</div>

                <div class="sheet-cell d-table-cell py-3">اسنان</div>
                <div class="sheet-cell d-table-cell py-3">الوسطى</div>
              <div class="sheet-cell d-table-cell py-3">محمود عبد الحكيم البطة</div>
              <div class="sheet-cell d-table-cell py-3 px-5 text-shades-2 text-base-2 text-nowrap">Oct 2021</div>
              </div>

            </div>
          </div>
        </div>
      </div>
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


