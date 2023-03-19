@extends('layouts.cpanel.app')

@section('title')
الرئيسية
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
<style>
	::before {

    right: 0 !important;

}
.stock-icon.ic2.p-3.rounded-circle.d-inline-block.mb-4 {
	background-color:  rgba(255, 165, 0, 0.15) !important;
}

.title.title-color.red.title-custom::before {
	width: 10px !important;
    height: 10px !important;
    border-radius: 50% !important;
	background-color:rgba(42, 133, 255, 0.85) !important;
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

                الرئيسية

            </h2>
            <div class="card-toolbar">

            </div>

        </div>
        <!--end::Header-->
        <!--begin::Body-->

        <div class="card-body py-0">
            <div class="row g-0" dir="rtl">
                <div class="col-12">
                  <div class="card mb-2 p-4 p-sm-5">
                    <div class="card-head d-flex align-items-center justify-content-between mb-5 mb-sm-6" >
                      <div class="title title-color purple"  >
                        <h3 class="section-title" style="margin-right: 20px">احصائيات عامة</h3>
                    </div>


                    </div>
                    <div class="card-body p-0" dir="rtl" >
                      <div class="stock-list row gx-4 flex-nowrap">
                        <div class="stock-item stock-green col p-6 mx-2 flex-shrink-0 flex-grow-1 sheet-table-item d-flex align-items-start " style="    justify-content: space-around;">
                          <div class="stock-icon p-3 rounded-circle d-inline-block mb-4">
                            <svg class="icon icon-activity">
                              <use xlink:href="#icon-activity"></use>
                            </svg>

                          </div>
                          <div class="d-flex ">
                            <div class="stock-details">
                              <div class="stock-caption caption d-flex align-items-center mb-1">
                                <div class="info-tooltip ps-1 text-gray-600" data-bs-toggle="tooltip" title="Small description">اجمالي العملاء
                                  <svg class="icon icon-info">
                                    <use xlink:href="#icon-info"></use>
                                  </svg>
                                </div>
                              </div>
                              <div class="counter h1">{{ \App\Models\Client::all()->count() }}</div>

                            </div>
                            <div class="stock-chart ms-auto">
                              <div id="stock-customer"></div>
                            </div>
                          </div>
                        </div>
                        <div class="stock-item stock-purple  col p-6 mx-2 flex-shrink-0 flex-grow-1 sheet-table-item d-flex align-items-start " style="    justify-content: space-around;">
                            <div class="stock-icon p-3 rounded-circle d-inline-block mb-4">
                              <svg class="icon icon-activity">
                                <use xlink:href="#icon-activity"></use>
                              </svg>

                            </div>
                            <div class="d-flex ">
                              <div class="stock-details">
                                <div class="stock-caption caption d-flex align-items-center mb-1">
                                  <div class="info-tooltip ps-1 text-gray-600" data-bs-toggle="tooltip" title="Small description">اجمالي الزيارات
                                    <svg class="icon icon-info">
                                      <use xlink:href="#icon-info"></use>
                                    </svg>
                                  </div>
                                </div>
                                <div class="counter h1">{{ \App\Models\Hit::all()->count() }}</div>

                              </div>
                              <div class="stock-chart ms-auto">
                                <svg class="icon icon-info">
                                    <use xlink:href="#icon-info"></use>
                                  </svg>
                                <div id="stock-customer"></div>
                              </div>
                            </div>
                          </div>
                          <div class="stock-item stock-blue col p-6 mx-2 flex-shrink-0 flex-grow-1 sheet-table-item d-flex align-items-start " style="    justify-content: space-around;">
                            <div class="stock-icon p-3 rounded-circle d-inline-block mb-4">
                              <svg class="icon icon-activity">
                                <use xlink:href="#icon-activity"></use>
                              </svg>

                            </div>
                            <div class="d-flex ">
                              <div class="stock-details">
                                <div class="stock-caption caption d-flex align-items-center mb-1">
                                  <div class="info-tooltip ps-1 text-gray-600" data-bs-toggle="tooltip" title="Small description">اجمالي العينات المصروفة
                                    <svg class="icon icon-info">
                                      <use xlink:href="#icon-info"></use>
                                    </svg>
                                  </div>
                                </div>
                                <div class="counter h1">{{ \App\Models\SampleStock::all()->where('received_quantity' ,'>', 0)->count() }}</div>

                              </div>
                              <div class="stock-chart ms-auto">
                                <div id="stock-customer"></div>
                              </div>
                            </div>
                          </div>
                          <div class="stock-item stock-purple  col p-6 mx-2 flex-shrink-0 flex-grow-1 sheet-table-item d-flex align-items-start " style="    justify-content: space-around;">
                            <div class="stock-icon p-3 rounded-circle d-inline-block mb-4">
                              <svg class="icon icon-activity">
                                <use xlink:href="#icon-activity"></use>
                              </svg>

                            </div>
                            <div class="d-flex ">
                              <div class="stock-details">
                                <div class="stock-caption caption d-flex align-items-center mb-1">
                                  <div class="info-tooltip ps-1 text-gray-600" data-bs-toggle="tooltip" title="Small description">اجمالي المندوبين
                                    <svg class="icon icon-info">
                                      <use xlink:href="#icon-info"></use>
                                    </svg>
                                  </div>
                                </div>
                                <div class="counter h1">{{ \App\Models\User::all()->where('user_type' , 2)->count() }}</div>

                              </div>
                              <div class="stock-chart ms-auto">
                                <svg class="icon icon-info">
                                    <use xlink:href="#icon-info"></use>
                                  </svg>
                                <div id="stock-customer"></div>
                              </div>
                            </div>
                          </div>
                          <div class="stock-item stock-purple  col p-6 mx-2 flex-shrink-0 flex-grow-1 sheet-table-item d-flex align-items-start " style="    justify-content: space-around;">
                            <div class="stock-icon p-3 rounded-circle d-inline-block mb-4">
                              <svg class="icon icon-activity">
                                <use xlink:href="#icon-activity"></use>
                              </svg>

                            </div>
                            <div class="d-flex ">
                              <div class="stock-details">
                                <div class="stock-caption caption d-flex align-items-center mb-1">
                                  <div class="info-tooltip ps-1 text-gray-600" data-bs-toggle="tooltip" title="Small description"> اجمالي التصنيفات
                                    <svg class="icon icon-info">
                                      <use xlink:href="#icon-info"></use>
                                    </svg>
                                  </div>
                                </div>
                                <div class="counter h1">{{ (\App\Models\Category::all()->count()) }}</div>

                              </div>
                              <div class="stock-chart ms-auto">
                                <svg class="icon icon-info">
                                    <use xlink:href="#icon-info"></use>
                                  </svg>
                                <div id="stock-customer"></div>
                              </div>
                            </div>
                          </div>
                    </div>

                  </div>
                </div>
                </div>
              </div>
              <div class="row g-0" dir="rtl" >
                <div class="col-lg-8 col-12 ">
                    <div class="card mb-2 p-4 p-sm-5">
                      <div class="card-head d-flex align-items-center justify-content-between mb-5 mb-sm-6">
                        <div class="title title-color yellow">
                            <h3 class="section-title" style="margin-right: 20px;font-size: 18px;">اجمالي العينات</h3>
                        </div>

                        <div class="d-flex">
                            <div class="title title-color red title-custom area">
                                <div class="me-2" style="margin-right: 20px !important"> جميع المندوبين </div>
                            </div>
                        <select class="select select-small d-sm-inline-flex area">

                          <option>
                            <div class="title title-color red title-custom"  >
                                <div class="me-2" style="margin-right: 20px !important">خالد وليد يونس</div>
                            </div></option>
                          <option>عبدالشكور  </option>
                          <option>عبدالكريم</option>
                        </select>
                        <select class="select select-small area">
                            <option>2023 </option>
                            <option>2022</option>
                            <option>2021</option>
                          </select>
                        </div>
                      </div>
                      <div class="chart chart-active-customers">
                        <div id="active-customers"></div>
                      </div>
                    </div>
                  </div>
                <div class="col-lg-4 col-12 pe-lg-2">
                  <div class="card mb-2 p-4 p-sm-5">
                    <div class="card-title">
                    <div class="card-head d-flex align-items-center justify-content-between mb-5 mb-sm-6">
                      <div class="title title-color green">
                        <h3 class="section-title" style="margin-right: 20px">اخر الزيارات المنجزة </h3>
                      </div>
                    </div>
                    </div>

                    <div class="popular">
                        <div class="border-bottom d-flex justify-content-between pb-4 mb-4">
                          <div class="me-2"><b>خالد وليد يونس</b>
                          </div>
                        </div>
                        <div class="popular-list">
                          <div class="popular-item mb-3 py-3 d-flex justify-content-around stock-list" data-bs-toggle="modal" data-bs-target="#modal-product">
                            <div class="d-flex align-items-center pb-5  mb-3 stock-item ">
                                <div class="stock-icon ic2 p-3 rounded-circle d-inline-block mb-4">
                                    <svg class="icon icon-activity">
                                      <use xlink:href="#icon-activity"></use>
                                    </svg>

                                  </div>
                                <div class="flex-shrink-1 w-100">
                                  <div class="d-flex align-items-center justify-content-between">
                                    <div class="me-2"><b>عبدالشكور الشوبكي</b>
                                    </div>

                                  </div>
                                 <p class="text-gray-600">
                                    مستشفى الشفاء-غزة

                                    </p>
                                </div>
                              </div>

                            <div class="popular-details flex-shrink-0  text-end">
                              <div class="popular text-gray-600">العينة المصروفة:</div>
                              <div class="badge min btn-tab active text-primary">Fucidin H Cream</div>
                            </div>
                          </div>
                          <div class="popular-item mb-3 py-3 d-flex justify-content-around stock-list" data-bs-toggle="modal" data-bs-target="#modal-product">
                            <div class="d-flex align-items-center pb-5  mb-3 stock-item ">
                                <div class="stock-icon ic2 p-3 rounded-circle d-inline-block mb-4">
                                    <svg class="icon icon-activity">
                                      <use xlink:href="#icon-activity"></use>
                                    </svg>

                                  </div>
                                <div class="flex-shrink-1 w-100">
                                  <div class="d-flex align-items-center justify-content-between">
                                    <div class="me-2"><b>عبدالشكور الشوبكي</b>
                                    </div>

                                  </div>
                                  <p class="text-gray-600">
                                    مستشفى الشفاء-غزة

                                    </p>
                                </div>
                              </div>

                            <div class="popular-details flex-shrink-0  text-end">
                              <div class="popular text-gray-600">العينة المصروفة:</div>
                              <div class="badge min btn-tab active text-primary">Fucidin H Cream</div>
                            </div>
                          </div>
                          <div class="popular-item mb-3 py-3 d-flex justify-content-around stock-list" data-bs-toggle="modal" data-bs-target="#modal-product">
                            <div class="d-flex align-items-center pb-5 mb-3 stock-item ">
                                <div class="stock-icon ic2 p-3 rounded-circle d-inline-block mb-4">
                                    <svg class="icon icon-activity">
                                      <use xlink:href="#icon-activity"></use>
                                    </svg>

                                  </div>
                                <div class="flex-shrink-1 w-100">
                                  <div class="d-flex align-items-center justify-content-between">
                                    <div class="me-2"><b>عبدالشكور الشوبكي</b>
                                    </div>

                                  </div >
                                  <p class="text-gray-600">
                                    مستشفى الشفاء-غزة

                                    </p>
                                </div>
                              </div>

                            <div class="popular-details flex-shrink-0  text-end">
                              <div class="popular text-gray-600">العينة المصروفة:</div>
                              <div class="badge min btn-tab active text-primary">Fucidin H Cream</div>
                            </div>
                          </div>

                        </div><a class="btn-stroke w-100" href="products-dashboard.html">مشاهدة الكل </a>
                      </div>
                  </div>

                </div>

              </div>

        </div>
        <!--end::Body-->
        <div class="card mb-2" dir="rtl">
            <div
                class="card-head d-flex align-items-start align-items-sm-center justify-content-between flex-column flex-sm-row p-4 p-sm-5">
                <div class="title title-color purple me-5 mb-4 mb-sm-0 d-flex">
                    <h3 class="section-title ml-7" style="margin-right: 20px; margin-left:20px"> طلبات </h3>
                    <div class="nav row gx-4 ms-sm-auto flex-nowrap d-flex mb-4 mb-sm-0 align-self-stretch">
                        <div class="btn-tab btn-small col  active" data-bs-target="#tab-products" data-bs-toggle="tab">
                            <h4>العملاء</h4>
                        </div>

                    </div>
                    <select class="select select-small tabs select-wide select-fill ms-auto d-md-none">
                        <option value="#tab-products">العميل</option>

                    </select>
                </div>
                <div class=" d-flex ">
                    <div class="card-toolbar">
                        <a href="{{route("admin.clients.index")}}" class="btn btn-sm btn-light"> مشاهدة
                            الكل</a>
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
                            <div class="d-table-cell py-4 caption">الزيارات</div>
                            {{-- <div class="d-table-cell py-4 px-5 caption">تاريخ الطلب</div>pp --}}
                        </div>
                       @foreach($data['clients'] as $client)

                        <div class="d-table-row grid-markup">
                            <div class="sheet-cell d-table-cell py-3 px-5">{{$client->name}} </div>

                            <div class="sheet-cell d-table-cell py-3">{{$client->specialty->name}}</div>
                            <div class="sheet-cell d-table-cell py-3">{{$client->area_1_name}}</div>
                            <div class="sheet-cell d-table-cell py-3">{{$client->clientHits()->count()}}</div>
                        </div>


                        @endforeach

                </div>

                    </div>
              </div>

        </div>
        <div class="card mb-2" dir="rtl">
            <div
                class="card-head d-flex align-items-start align-items-sm-center justify-content-between flex-column flex-sm-row p-4 p-sm-5">
                <div class="title title-color purple me-5 mb-4 mb-sm-0 d-flex">
                    <h3 class="section-title ml-7" style="margin-right: 20px; margin-left:20px"> طلبات </h3>
                    <div class="nav row gx-4 ms-sm-auto flex-nowrap d-flex mb-4 mb-sm-0 align-self-stretch">

                        <div class="btn-tab btn-small col active" data-bs-target="#tab-traffic" data-bs-toggle="tab">
                            <h4>العينات</h4>
                        </div>
                    </div>
                    <select class="select select-small tabs select-wide select-fill ms-auto d-md-none">
                        <option value="#tab-traffic">الزيارات </option>
                    </select>
                </div>
                <div class=" d-flex ">
                    <div class="card-toolbar">
                        <a href="{{route("admin.hits.index")}}" class="btn btn-sm btn-light"> مشاهدة
                            الكل</a>
                    </div>

                </div>
            </div>
            <div class="card-body products tab-content">
                <div class="row g-0 pb-5">
                    <div class="sheet-table d-table d-table ">
                        <div class="d-table-row">
                            <div class="d-table-cell py-4 px-5 caption">العميل</div>
                            <div class="d-none d-md-table-cell py-4 ps-5 caption">التخصص</div>
                            <div class="d-none d-md-table-cell py-4 ps-5 caption">المنطقة</div>
                            <div class="d-table-cell py-4 caption">المندوب</div>
                            <div class="d-table-cell py-4 px-5 caption">تاريخ الطلب</div>
                        </div>
                        @foreach($hits as $hit)

                        <div class="d-table-row grid-markup">
                            <div class="sheet-cell d-table-cell py-3 px-5">{{$hit->client->name}} </div>

                            <div class="sheet-cell d-table-cell py-3">{{$hit->category_name}}</div>
                            <div class="sheet-cell d-table-cell py-3"> {{$hit->area_1_name ??''}}</div>
                            <div class="sheet-cell d-table-cell py-3">{{$hit->user->name ??''}}</div>
                            <div class="sheet-cell d-table-cell py-3">{{$hit->date}}</div>

                        </div>


                        @endforeach

                </div>

                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>



</div>

    <!--end::Container-->
    @endsection




@section('script')
@parent
<script>
function load_data_table(page = '') {
        $.ajax({
            url: '{{url("admin/clients/")}}?page=' + page,
            data: {
                search: $('#search_input').val()
            },
            type: "get",
            success: function(response) {
                $('.client-table-body').html(response.clients)

            },
            error: function(response) {}

        })
    }
$(document).on('click','.delete-client',function(){
            var id = $(this).data('client-id');
            Swal.fire({
                title: 'هل أنت متأكد من حذف العميل',
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
                        url: '{{route("admin.clients.delete")}}' ,
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
