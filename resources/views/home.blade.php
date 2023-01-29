@extends('layouts.cpanel.app')

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
                      <div class="title title-color purple"  >
                        <h3 class="section-title" style="margin-right: 20px">احصائيات عامة</h3>
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
    </div>

  </div>
@endsection
