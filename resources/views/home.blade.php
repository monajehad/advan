@extends('layouts.cpanel.app')
@section('style')
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

<div class="page  pb-4  px-sm-5 pt-xl-7 px-xl-7 w-100">
    <div class="page-head">
      <h2 class=" mb-4 mb-xl-5">لوحة تحكم مندوبي الدعاية</h2>
    </div>
    <div class="page-body pb-4 pb-xl-6 ">
        <div class="card-body p-0">
            <div class="row g-0" dir="rtl">
                <div class="col-12">
                  <div class="card mb-2 p-4 p-sm-5">
                    <div class="card-head d-flex align-items-center justify-content-between mb-5 mb-sm-6" >
                      <div class="title title-color purple">
                        <h3 class="section-title" style="margin-right: 20px"> إحصائيات عامة</h3>
                    </div>


                    </div>
                    <div class="card-body p-0" dir="rtl" >
                      <div class="stock-list row gx-4 flex-nowrap">
                        <div class="stock-item stock-green col p-6 mx-2 flex-shrink-0 flex-grow-1 sheet-table-item d-flex align-items-start " >
                          <div class="stock-icon p-3 rounded-circle d-inline-block mb-4">
                            <svg class="icon icon-activity">
                              <use xlink:href="#icon-activity"></use>
                            </svg>

                          </div>
                          <div class="d-flex ">
                            <div class="stock-details">
                              <div class="stock-caption caption d-flex align-items-center mb-1">
                                <div class="info-tooltip ps-1 pe-2 text-gray-600" data-bs-toggle="tooltip" title="Small description">اجمالي العملاء
                                  <svg class="icon icon-info">
                                    <use xlink:href="#icon-info"></use>
                                  </svg>
                                </div>
                              </div>
                              <div class="counter h1">12855</div>

                            </div>
                            <div class="stock-chart ms-auto">
                              <div id="stock-customer"></div>
                            </div>
                          </div>
                        </div>
                        <div class="stock-item stock-purple  col p-6 mx-2 flex-shrink-0 flex-grow-1 sheet-table-item d-flex align-items-start " >
                            <div class="stock-icon p-3 rounded-circle d-inline-block mb-4">
                              <svg class="icon icon-activity">
                                <use xlink:href="#icon-activity"></use>
                              </svg>

                            </div>
                            <div class="d-flex ">
                              <div class="stock-details">
                                <div class="stock-caption caption d-flex align-items-center mb-1">
                                  <div class="info-tooltip ps-1 pe-2 text-gray-600" data-bs-toggle="tooltip" title="Small description">اجمالي العملاء
                                    <svg class="icon icon-info">
                                      <use xlink:href="#icon-info"></use>
                                    </svg>
                                  </div>
                                </div>
                                <div class="counter h1">12855</div>

                              </div>
                              <div class="stock-chart ms-auto">
                                <svg class="icon icon-info">
                                    <use xlink:href="#icon-info"></use>
                                  </svg>
                                <div id="stock-customer"></div>
                              </div>
                            </div>
                          </div>
                          <div class="stock-item stock-blue col p-6 mx-2 flex-shrink-0 flex-grow-1 sheet-table-item d-flex align-items-start " >
                            <div class="stock-icon p-3 rounded-circle d-inline-block mb-4">
                              <svg class="icon icon-activity">
                                <use xlink:href="#icon-activity"></use>
                              </svg>

                            </div>
                            <div class="d-flex ">
                              <div class="stock-details">
                                <div class="stock-caption caption d-flex align-items-center mb-1">
                                  <div class="info-tooltip ps-1 pe-2 text-gray-600" data-bs-toggle="tooltip" title="Small description">اجمالي العملاء
                                    <svg class="icon icon-info">
                                      <use xlink:href="#icon-info"></use>
                                    </svg>
                                  </div>
                                </div>
                                <div class="counter h1">12855</div>

                              </div>
                              <div class="stock-chart ms-auto">
                                <div id="stock-customer"></div>
                              </div>
                            </div>
                          </div>
                          <div class="stock-item stock-purple  col p-6 mx-2 flex-shrink-0 flex-grow-1 sheet-table-item d-flex align-items-start " >
                            <div class="stock-icon p-3 rounded-circle d-inline-block mb-4">
                              <svg class="icon icon-activity">
                                <use xlink:href="#icon-activity"></use>
                              </svg>

                            </div>
                            <div class="d-flex ">
                              <div class="stock-details">
                                <div class="stock-caption caption d-flex align-items-center mb-1">
                                  <div class="info-tooltip ps-1 pe-2 text-gray-600" data-bs-toggle="tooltip" title="Small description">اجمالي العملاء
                                    <svg class="icon icon-info">
                                      <use xlink:href="#icon-info"></use>
                                    </svg>
                                  </div>
                                </div>
                                <div class="counter h1">12855</div>

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
                    <div class="stock-list mt-10 row gx-4 flex-nowrap">
                        <div class="stock-item stock-green  p-6 mx-2 flex-shrink-0  sheet-table-item d-flex align-items-start " >
                          <div class="stock-icon p-3 rounded-circle d-inline-block mb-4">
                            <svg class="icon icon-activity">
                              <use xlink:href="#icon-activity"></use>
                            </svg>

                          </div>
                          <div class="d-flex ">
                            <div class="stock-details">
                              <div class="stock-caption caption d-flex align-items-center mb-1">
                                <div class="info-tooltip ps-1 pe-2 text-gray-600" data-bs-toggle="tooltip" title="Small description">اجمالي العملاء
                                  <svg class="icon icon-info">
                                    <use xlink:href="#icon-info"></use>
                                  </svg>
                                </div>
                              </div>
                              <div class="counter h1">12855</div>

                            </div>
                            <div class="stock-chart ms-auto">
                              <div id="stock-customer"></div>
                            </div>
                          </div>
                        </div>



                    </div>
                  </div>
                </div>
                </div>
              </div>
        </div>
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
@endsection
<!-- 
@section('script')
	<script>
var data = {

    datasets: [
      {
        data: [300, 50],
        backgroundColor: [
          "#FFA500",
          "#EFEFEF",

        ],

      }]
  };

  Chart.pluginService.register({
    beforeDraw: function(chart) {
      var width = chart.chart.width,
          height = chart.chart.height,
          ctx = chart.chart.ctx;

      ctx.restore();
      var fontSize = (height / 114).toFixed(2);
      ctx.font = fontSize + "em sans-serif";
      ctx.textBaseline = "middle";

      var text = "75%",
          textX = Math.round((width - ctx.measureText(text).width) / 2),
          textY = height / 2;

      ctx.fillText(text, textX, textY);
      ctx.save();
    }
  });

  var chart = new Chart(document.getElementsByClassName('myChart'), {
    type: 'doughnut',
    data: data,
    options: {
        responsive: true,
      legend: {
        display: false
      }
    }
  });

      </script>
      <script>
          var myOffcanvas = document.getElementById('myOffcanvas')
  var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
@endsection -->
