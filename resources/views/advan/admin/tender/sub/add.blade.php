<style>
.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 90vw !important;
    height: 90vh !important;
    top: 3%;
    /* right: 3%; */
    left: 5%;
    pointer-events: auto;
    background-color: #ffffff !important;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 12px !important;
    outline: 0;
}
.select2-dropdown {
    background-color: white;
    border: 1px solid #aaa;
    border-radius: 4px;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    display: block;
    position: absolute;
    left: -100000px;
    width: 100%;
    z-index: 999999999;
}
.select2-results {
    display: block;
    position: relative;
    z-index: 5000;
}
.buttons{
    text-align:center;
}
#stepone{
        margin-left: 16px;
    margin-right: 16px;
}
fieldset {
    text-align: right;
    border: 1px solid #f4f4f4 !important;
    border-radius: 8px;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    max-width: 90vw;
}

#progressbar li::before {
    content: counter(step, arabic-indic);
    counter-increment: step;
    width: 20px;
    line-height: 20px;
    display: block;
    font-size: 10px;
    color: #333;
    background: white;
    border-radius: 3em;
    margin: 0 auto 5px auto;
    text-align: center;
    display: none;
}

legend {
    display: block;
    width: auto;
    max-width: 100%;
    padding: 0;
    margin-bottom: 0.5rem;
    font-size: 1.8rem;
    line-height: inherit;
    color: inherit;
    white-space: normal;
    float: none;
}

.input-group>.input-group-append>.btn,
.input-group>.input-group-append>.input-group-text,
.input-group>.input-group-prepend:not(:first-child)>.btn,
.input-group>.input-group-prepend:not(:first-child)>.input-group-text,
.input-group>.input-group-prepend:first-child>.btn:not(:first-child),
.input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child) {
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    height: 44px !important;
    top: -2px !important;
}
</style>

<div class="modal fade" id="add-tender" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xxl" role="document">
        <div class="modal-content" style="width:80vw;">
            <div class="modal-header">
                <h5 class="modal-title">إضافة مناقصة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-light svg-icon-md"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                </button>
            </div>
            <!-- <form class="form" action="" id="tender-form"> -->


            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="" id="tender_form" enctype="multipart/form-data">
                            <input type="hidden" name="hidden" id="hidden">
                            {{-- <input type="hidden" name="type" id="type"> --}}
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="add_active active" data-step="step1">
                                    <span class="svg-icon svg-icon-secondary svg-icon-2x">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Clipboard.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                    fill="#000000" />
                                                <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2"
                                                    rx="1" />
                                                <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2"
                                                    rx="1" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    بيانات المناقصة

                                </li>
                                <li class="add_active" data-step="step2">
                                    <span class="svg-icon svg-icon-secondary svg-icon-2x">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Cart2.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path
                                                    d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    أصناف المناقصة

                                </li>
                                {{-- @can('item-price-offers') --}}
                                <li class="add_active" data-step="step3">
                                    <span class="svg-icon svg-icon-secondary svg-icon-2x">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Clipboard.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                    fill="#000000" />
                                                <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2"
                                                    rx="1" />
                                                <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2"
                                                    rx="1" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    عروض أسعار الأصناف
                                </li>
                                {{-- @endcan --}}
                                <li class="add_active" data-step="step4">
                                    <span class="svg-icon svg-icon-secondary svg-icon-2x">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Dollar.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="11.5" y="2" width="2" height="4"
                                                    rx="1" />
                                                <rect fill="#000000" opacity="0.3" x="11.5" y="16" width="2" height="5"
                                                    rx="1" />
                                                <path
                                                    d="M15.493,8.044 C15.2143319,7.68933156 14.8501689,7.40750104 14.4005,7.1985 C13.9508311,6.98949895 13.5170021,6.885 13.099,6.885 C12.8836656,6.885 12.6651678,6.90399981 12.4435,6.942 C12.2218322,6.98000019 12.0223342,7.05283279 11.845,7.1605 C11.6676658,7.2681672 11.5188339,7.40749914 11.3985,7.5785 C11.2781661,7.74950085 11.218,7.96799867 11.218,8.234 C11.218,8.46200114 11.2654995,8.65199924 11.3605,8.804 C11.4555005,8.95600076 11.5948324,9.08899943 11.7785,9.203 C11.9621676,9.31700057 12.1806654,9.42149952 12.434,9.5165 C12.6873346,9.61150047 12.9723317,9.70966616 13.289,9.811 C13.7450023,9.96300076 14.2199975,10.1308324 14.714,10.3145 C15.2080025,10.4981676 15.6576646,10.7419985 16.063,11.046 C16.4683354,11.3500015 16.8039987,11.7268311 17.07,12.1765 C17.3360013,12.6261689 17.469,13.1866633 17.469,13.858 C17.469,14.6306705 17.3265014,15.2988305 17.0415,15.8625 C16.7564986,16.4261695 16.3733357,16.8916648 15.892,17.259 C15.4106643,17.6263352 14.8596698,17.8986658 14.239,18.076 C13.6183302,18.2533342 12.97867,18.342 12.32,18.342 C11.3573285,18.342 10.4263378,18.1741683 9.527,17.8385 C8.62766217,17.5028317 7.88033631,17.0246698 7.285,16.404 L9.413,14.238 C9.74233498,14.6433354 10.176164,14.9821653 10.7145,15.2545 C11.252836,15.5268347 11.7879973,15.663 12.32,15.663 C12.5606679,15.663 12.7949989,15.6376669 13.023,15.587 C13.2510011,15.5363331 13.4504991,15.4540006 13.6215,15.34 C13.7925009,15.2259994 13.9286662,15.0740009 14.03,14.884 C14.1313338,14.693999 14.182,14.4660013 14.182,14.2 C14.182,13.9466654 14.1186673,13.7313342 13.992,13.554 C13.8653327,13.3766658 13.6848345,13.2151674 13.4505,13.0695 C13.2161655,12.9238326 12.9248351,12.7908339 12.5765,12.6705 C12.2281649,12.5501661 11.8323355,12.420334 11.389,12.281 C10.9583312,12.141666 10.5371687,11.9770009 10.1255,11.787 C9.71383127,11.596999 9.34650161,11.3531682 9.0235,11.0555 C8.70049838,10.7578318 8.44083431,10.3968355 8.2445,9.9725 C8.04816568,9.54816454 7.95,9.03200304 7.95,8.424 C7.95,7.67666293 8.10199848,7.03700266 8.406,6.505 C8.71000152,5.97299734 9.10899753,5.53600171 9.603,5.194 C10.0970025,4.85199829 10.6543302,4.60183412 11.275,4.4435 C11.8956698,4.28516587 12.5226635,4.206 13.156,4.206 C13.9160038,4.206 14.6918294,4.34533194 15.4835,4.624 C16.2751706,4.90266806 16.9686637,5.31433061 17.564,5.859 L15.493,8.044 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    تسعير المناقصة
                                </li>
                                <li class="add_active" data-step="step5">
                                    <span class="svg-icon svg-icon-secondary svg-icon-2x">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Text\Dots.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1">
                                                <rect x="14" y="9" width="6" height="6" rx="3" fill="black" />
                                                <rect x="3" y="9" width="6" height="6" rx="3" fill="black"
                                                    fill-opacity="0.7" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    بيانات إضافية
                                </li>

                                {{-- @can('tenders-another-branch') --}}
                                <li class="view_edit add_active d-none" data-step="step6"> تكرار المناقصة </li>
                                {{-- @endcan --}}
                                {{-- @can('tenders-competitor') --}}
                                <li class="view_edit add_active d-none" data-step="step7">تقييم الاسعار</li>
                                {{-- @endcan --}}
                                {{-- @can('tenders-accept-items') --}}
                                <li class="view_edit add_active d-none" data-step="step8">الترسية</li>
                                {{-- @endcan --}}
                                {{-- @can('tenders-supply') --}}
                                <li class="view_edit add_active d-none" data-step="step9">التوريد</li>
                                {{-- @endcan --}}
                                {{-- @can('tenders-print-pdf')  --}}
                                <li class="view_edit add_active d-none" data-step="step10">إنشاء PDF</li>
                                {{-- @endcan --}}




                            </ul>
                            <fieldset id="step1" class="step1">
                                <legend class="">بيانات المناقصة</legend>
                                <div class="form-group row mx-6">
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">فرع الشركة</label>
                                        <select class="form-control" name="company_branch" id="company_branch">
                                            <option value="" selected disabled>اختر فرع الشركة</option>
                                            @foreach($data['company_select'] as $company)
                                            <option value="{{$company->value}}">{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mx-6">

                                    <div class="col-md-4 col-lg-4 client-select">
                                        <label class="font-weight-bolder">العميل </label>
                                        <div class="input-group">
                                            <select class="form-control select2 " name="client" id="client"
                                                multiple="multiple">

                                            </select>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a data-toggle="modal" data-target="#add_button" class=""
                                                        style="cursor:pointer;line-height: 10px;">

                                                        <span class="svg-icon svg-icon-info svg-icon-2x">
                                                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Add-user.svg--><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                                    <path
                                                                        d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        opacity="0.3" />
                                                                    <path
                                                                        d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                                        fill="#000000" fill-rule="nonzero" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">رقم المناقصة</label>
                                        <input type="text" name="tender_no" id="tender_no" class="form-control" />
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">نوع القطاع</label>
                                        <select class="form-control" name="sector" id="sector">
                                            <option value="" selected disabled>اختر نوع القطاع</option>
                                            @foreach($data['sectors_select'] as $sector)
                                            <option value="{{$sector->value}}">{{$sector->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row mx-6">
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">نوع الكفالة</label>
                                        <select class="form-control" name="guarantee_type" id="guarantee_type">
                                            <option value="" selected disabled>اختر نوع الكفالة</option>
                                            @foreach($data['guarantee_type_select'] as $guarantee_type)
                                            <option value="{{$guarantee_type->value}}">{{$guarantee_type->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">نسبة الكفالة</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="guarantee_rate"
                                                id="guarantee_rate" />

                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">العملة</label>
                                        <input type="hidden" id="new_input_currency">
                                        <select class="form-control" name="currency" id="currency">
                                            <option value="" selected disabled>اختر العملة</option>
                                            @foreach($data['currency_select'] as $currency)
                                            <option value="{{$currency->value}}">{{$currency->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row mx-6">
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">تاريخ تقديم المناقصة</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control datepicker"
                                                name="representation_date" id="representation_date" readonly="readonly">

                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">سعر التحويل</label>
                                        <input type="text" name="transfer_price" id="transfer_price"
                                            class="form-control" />
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">الضريبة</label>
                                        <select class="form-control" name="tax" id="tax">
                                            <option value="" selected disabled>اختر الضريبة</option>
                                            @foreach($data['tax_select'] as $tax)
                                            <option value="{{$tax->value}}">{{$tax->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mx-6">

                                    <div class="col-md-6 col-lg-6">
                                        <label class="font-weight-bolder">ملف المناقصة معبأة بالأسعار</label>
                                        <div class="input-group">
                                            <input type="file" name="tender_file" id="tender_file"
                                                accept=".doc,.docx,.pdf,.odt,.dot" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label class="font-weight-bolder">ملف الاحالة / الترسية </label>
                                        <div class="input-group">
                                            <input type="file" name="referral_file" id="referral_file"
                                                accept=".doc,.docx,.pdf,.odt,.dot" class="form-control">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4" id="div_bid_status" style="display: none;">
                                        <label class="font-weight-bolder"> حالة العطاء </label>
                                        <select class="form-control bid_status" name="bid_status" id="bid_status">
                                            <option value="0">لم يتم الترسية </option>
                                            <option value="1"> جاري الترسية </option>
                                            <option value="2">تم الترسية </option>
                                        </select>
                                    </div>

                                    <div class="form-group row mx-6">
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder"> مستخدمين المناقصة</label>
                                        <select class="form-control select2" name="users[]" id="users" multiple="multiple" style="width:240px">
                                            <option value="" enabled>اختر المستخدمين</option>
                                            @foreach($data['users'] as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                </div>
                                
                                <div class="form-group row mx-6">
                                    <div class="col-md-12 col-lg-12 buttons">
                                        <button type="button" id="save_data" name="save_data"
                                            class="btn btn-sm btn-info" data-type="1">حفظ البيانات</button>
                                        <button type="button" id="stepone" name="next"
                                            class="btn btn-sm btn-primary">التالي</button>
                                        <button type="button" class="btn btn-sm btn-light"
                                            data-dismiss="modal">إغلاق</button>
                                    </div>
                                </div>

                            </fieldset>
                            <fieldset id="step2" class="step2">
                                <legend class="">بيانات أصناف المناقصة</legend>
                                <div class="row my-3">
                                    <div class="col-md-2 col-lg-2 col-sm-2 text-right p-0">
                                        <!-- <button type="button" id="add_item" name="add_item" class="btn btn-success btn-sm">إضافة  <i class="fa fa-plus"></i></button> -->
                                        <button type="button" id="add_item" name="add_item" class="btn btn-light">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                        </button>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-10">
                                        <select class="form-control" name="item_name" id="item_name">
                                            <option value="" selected disabled>اختر الصنف</option>
                                            @foreach($data['items'] as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="row mx-6">
                                    <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table">
                                        <table class="table table-bordered items-table text-center">
                                            <thead>
                                                <tr>
                                                    <!-- <th style="visibility: hidden;"></th> -->
                                                    <th>رقم الصنف</th>
                                                    <th>اسم الصنف</th>
                                                    <th>الشكل</th>
                                                    <th>الوحدة</th>
                                                    <th width="15%">الكمية</th>
                                                    <!-- <th width="15%">السعر</th> -->
                                                    <th>الحذف</th>
                                                </tr>
                                            </thead>
                                            <tbody id="items-table-body">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row mx-6 my-3">
                                    <div class="col-md-12 col-lg-12 buttons">
                                        <button type="button" id="save_data" name="save_data"
                                            class="btn btn-sm btn-success" data-type="2">حفظ البيانات</button>
                                        <button type="button" id="previous1" name="previous"
                                            class="btn btn-sm btn-primary">السابق</button>
                                        <button type="button" id="stepone" name="next"
                                            class="btn btn-sm btn-primary">التالي</button>
                                        <button type="button" class="btn btn-sm btn-secondary"
                                            data-dismiss="modal">إغلاق</button>

                                    </div>
                                </div>

                            </fieldset>

                            {{-- @can('item-price-offers') --}}
                            <fieldset id="step3" class="step3">
                                <legend class="">مرحلة عروض الاسعار</legend>

                                <div class="row my-3">
                                    <div class="col-md-2 col-lg-2 col-sm-2 text-right p-0">
                                        <!-- <button type="button" id="add_item" name="add_item" class="btn btn-success btn-sm">إضافة  <i class="fa fa-plus"></i></button> -->
                                        <button type="button" id="add_tender_item" name="add_tender_item"
                                            class="btn btn-success">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                        </button>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-5">
                                        <select class="form-control" name="tender-items" id="tender-items">

                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-5">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    ملف الأسعار
                                                </span>
                                            </div>
                                            <input type="file" name="prices_file" id="prices_file" accept=".pdf"
                                                class="form-control" placeholder="رفع ملف عروض الاسعار">
                                            <div class="input-group-append">
                                                <span class="input-group-text tender_suppliers_prices">
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Files\Uploaded-file.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M8.95128003,13.8153448 L10.9077535,13.8153448 L10.9077535,15.8230161 C10.9077535,16.0991584 11.1316112,16.3230161 11.4077535,16.3230161 L12.4310522,16.3230161 C12.7071946,16.3230161 12.9310522,16.0991584 12.9310522,15.8230161 L12.9310522,13.8153448 L14.8875257,13.8153448 C15.1636681,13.8153448 15.3875257,13.5914871 15.3875257,13.3153448 C15.3875257,13.1970331 15.345572,13.0825545 15.2691225,12.9922598 L12.3009997,9.48659872 C12.1225648,9.27584861 11.8070681,9.24965194 11.596318,9.42808682 C11.5752308,9.44594059 11.5556598,9.46551156 11.5378061,9.48659872 L8.56968321,12.9922598 C8.39124833,13.2030099 8.417445,13.5185067 8.62819511,13.6969416 C8.71848979,13.773391 8.8329684,13.8153448 8.95128003,13.8153448 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row my-3">

                                    <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table">
                                        <table class="table table-bordered items-pricing-table text-center">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>رقم الصنف</th>
                                                    <th>اسم الصنف</th>
                                                    <th width="20%">الاسم التجاري</th>
                                                    <th>الشكل</th>
                                                    <th>الوحدة</th>
                                                    <th>الكمية</th>
                                                    <th>اسم المورد</th>
                                                    <th>سعر الشراء</th>
                                                    <th>مدة التوريد بالأيام</th>
                                                    <th>تاريخ الانتهاء</th>
                                                    <th>ملاحظات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="items-pricing-table-body">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" name="tender_id" id="tender_id">
                                <div class="form-group row mx-6 my-3">
                                    <div class="col-md-12 col-lg-12 buttons">
                                        <button type="button" id="save_data" name="save_data"
                                            class="btn btn-sm btn-success" data-type="3">حفظ البيانات</button>
                                        <button type="button" id="previous1" name="previous"
                                            class="btn btn-sm btn-primary">السابق</button>
                                        <button type="button" id="stepone" name="next"
                                            class="btn btn-sm btn-primary">التالي</button>
                                        <button type="button" class="btn btn-sm btn-secondary"
                                            data-dismiss="modal">إغلاق</button>
                                    </div>
                                </div>
                            </fieldset>
                            {{-- @endcan --}}
                            <fieldset id="step4" class="step4">
                                <legend class="">مرحلة تسعير المناقصة</legend>
                                <div class="row my-3">
                                    <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table">
                                        <table class="table table-bordered tender-pricing-table text-center">
                                            <thead>
                                                <tr>
                                                    <th>رقم الصنف</th>
                                                    <th>اسم الصنف</th>
                                                    <th>الاسم التجاري</th>
                                                    <th>الشكل</th>
                                                    <th>الوحدة</th>
                                                    <th>الكمية</th>
                                                    <th>اسم المورد</th>
                                                    <th>سعر الشراء</th>
                                                    <th>نسبة الربح %</th>
                                                    <th>سعر المناقصة</th>
                                                    <th>الإجمالي</th>
                                                    <th>مدة التوريد بالأيام</th>
                                                    <th>تاريخ الانتهاء</th>
                                                    <th>ملاحظات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tender-pricing-table-body">
                                            </tbody>
                                            <tfoot id="tender-pricing-table-footer">
                                                <tr>
                                                    <th colspan="7"></th>
                                                    <th class="bg-secondary" colspan="3">الإجمالي</th>
                                                    <th colspan="2" id="total">0</th>
                                                    <th colspan="2" id="tender_curn"></th>
                                                </tr>

                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row mx-6 my-3">
                                    <div class="col-md-12 col-lg-12 buttons">
                                        <button type="button" id="save_data" name="save_data"
                                            class="btn btn-sm btn-success" data-type="3">حفظ البيانات</button>
                                        <button type="button" id="previous1" name="previous"
                                            class="btn btn-sm btn-primary">السابق</button>
                                        <button type="button" id="stepone" name="next"
                                            class="btn btn-sm btn-primary">التالي</button>
                                        <button type="button" class="btn btn-sm btn-secondary"
                                            data-dismiss="modal">إغلاق</button>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset id="step5" class="step5">
                                <legend class="">بيانات إضافية</legend>
                                <div class="form-group row mx-6">

                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">رقم كفالة دخول العطاء</label>
                                        <input type="text" name="guarantee_no" id="guarantee_no" class="form-control" />
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">صورة الكفالة</label>
                                        <input type="file" name="guarantee_file" class="form-control"
                                            id="guarantee_file">
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">الشخص المسؤول</label>
                                        <input type="text" name="manager" id="manager" class="form-control" />
                                    </div>

                                </div>
                                <div class="form-group row mx-6">
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">قيمة الكفالة</label>
                                        <input type="text" name="guarantee_value" id="guarantee_value"
                                            class="form-control" />
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">تاريخ استلام أمر التوريد</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control datepicker" name="receipt_date"
                                                id="receipt_date" readonly="readonly">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Layout\Layout-arrange.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M5.5,4 L9.5,4 C10.3284271,4 11,4.67157288 11,5.5 L11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M14.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,17.5 C13,16.6715729 13.6715729,16 14.5,16 Z" fill="#000000"/>
        <path d="M5.5,10 L9.5,10 C10.3284271,10 11,10.6715729 11,11.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,12.5 C20,13.3284271 19.3284271,14 18.5,14 L14.5,14 C13.6715729,14 13,13.3284271 13,12.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">ملف امر التوريد </label>
                                        <input type="file" name="receipt_file" id="receipt_file"
                                            accept=".doc,.docx,.pdf,.odt,.dot" class="form-control">

                                    </div>
                                </div>
                                <div class="form-group row mx-6">
                                    <div class="col-md-4 col-lg-4">
                                        <label class="font-weight-bolder">تم استرداد الكفالة ؟</label>
                                        <span class="switch">
                                            <label>
                                                <input type="checkbox" name="get_guarantee" id="get_guarantee">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    {{-- <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">حالة العطاء؟</label>
                                            <span class="switch">
                                                <label>
                                                    <input type="checkbox" name="bid_status" id="bid_status">
                                                <span></span>
                                                </label>
                                            </span>
                                        </div>	 --}}
                                </div>
                                <div class="form-group row mx-6 my-3">
                                    <div class="col-md-12 col-lg-12 buttons">
                                        <button type="button" id="save_data" name="save_data"
                                            class="btn btn-sm btn-success" data-type="4">حفظ البيانات</button>
                                        {{-- <button type="button" id="previous1" name="previous" class="btn btn-sm btn-primary">السابق</button>
                                            <button type="button"  class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button> --}}
                                        <button type="button" id="previous1" name="previous"
                                            class="btn btn-sm btn-primary">السابق</button>
                                        <button type="button" id="stepone" name="next"
                                            class="btn btn-sm btn-primary">التالي</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        {{-- @can('tenders-another-branch') --}}
                        <fieldset id="step6" class="step6">
                            <legend class="">إضافة المناقصة في فرع آخر</legend>
                            <div class="" id="branch_edit">
                                <div class="row my-2">
                                    <div class="col-md-12">
                                        <h3 class="text-center"> المناقصة لفرع <span id="tender_branch_name"></span>
                                        </h3>
                                        <input type="hidden" id="branch_from_id" name="branch_from_id">

                                    </div>
                                </div>
                                <form class="form" action="" id="to-other-branch-form" method="post">
                                    <input type="hidden" id="tender_duplicate_id" name="tender_duplicate_id">
                                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                                    <div class="modal-body">

                                        <div class="form-group row">
                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                <label>الفرع</label>
                                                <select class="form-control" name="to_company_branch"
                                                    id="to_company_branch" required>
                                                    <option value="" selected disabled>اختر فرع الشركة</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mx-6 my-3">
                                        <div class="col-md-12 col-lg-12 buttons">
                                            <button type="submit" id="import" name="import"
                                                class="btn btn-sm btn-success">حفظ </button>
                                            <button type="button" id="previous1" name="previous"
                                                class="btn btn-sm btn-primary">السابق</button>
                                            <button type="button" id="stepone" name="next"
                                                class="btn btn-sm btn-primary">التالي</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </fieldset>
                        {{-- @endcan --}}
                        {{-- @can('tenders-competitor') --}}
                        <fieldset id="step7" class="step7">
                            <legend class="">تقييم الاسعار</legend>
                            <div class="" id="assesment_edit">
                            </div>
                        </fieldset>
                        {{-- @endcan --}}
                        {{-- @can('tenders-accept-items') --}}
                        <fieldset id="step8" class="step8">
                            <legend class="">الترسية</legend>
                            <div id="accepting_edit">
                            </div>
                        </fieldset>
                        {{-- @endcan --}}
                        {{-- @can('tenders-supply') --}}

                        <fieldset id="step9" class="step9">
                            <legend class="">التوريد</legend>
                            <div id="supplied_edit">
                            </div>
                            <div class="form-group row mx-6 my-3">
                                <div class="col-md-12 col-lg-12 buttons">
                                    <button type="button" id="save_data" name="save_data" class="btn btn-sm btn-success"
                                        data-type="3">حفظ البيانات</button>
                                    <button type="button" id="previous1" name="previous"
                                        class="btn btn-sm btn-primary">السابق</button>
                                    <button type="button" id="stepone" name="next"
                                        class="btn btn-sm btn-primary">التالي</button>
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        data-dismiss="modal">إغلاق</button>

                                </div>
                            </div>
                        </fieldset>
                        {{-- @endcan --}}

                        {{-- @can('tenders-print-pdf')  --}}
                        <fieldset id="step10" class="step10">
                            <legend class="">إنشاء PDF</legend>
                            <div class="row mx-6  my-3">

                                <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                                    <button type="button" class="btn btn-sm btn-danger generate-tender-pdf">إنشاء
                                        PDF</button>
                                </div>
                            </div>
                            <div class="form-group row mx-6 my-3">
                                <div class="col-md-12 col-lg-12 buttons">
                                    <button type="button" id="save_data" name="save_data" class="btn btn-sm btn-success"
                                        data-type="3">حفظ البيانات</button>
                                    <button type="button" id="previous1" name="previous"
                                        class="btn btn-sm btn-primary">السابق</button>
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        data-dismiss="modal">إغلاق</button>
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        data-dismiss="modal">إغلاق</button>

                                </div>
                            </div>
                        </fieldset>
                        {{-- @endcan --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <div class="modal fade" id="to-other-branch-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> --}}
{{-- <div class="modal-header">
                <h5 class="modal-title">إضافة المناقصة لفرع آخر</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Close.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
            <rect x="0" y="7" width="16" height="2" rx="1"/>
            <rect opacity="0.3" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/>
        </g>
    </g>
</svg><!--end::Svg Icon--></span>
                </button>
            </div> --}}
{{-- <div class="row my-2">
                <div class="col-md-12">
                   <h3 class="text-center"> المناقصة لفرع <span id="tender_branch_name"></span></h3>
                    <input type="hidden" id="branch_from_id" name="branch_from_id">

                </div>
            </div> --}}
{{-- <form class="form" action="" id="to-other-branch-form" method="post"> --}}
{{-- <input type="hidden" id="tender_duplicate_id" name="tender_duplicate_id"> --}}
{{-- <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}"> --}}
{{-- <div class="modal-body">

                <div class="form-group row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <label>الفرع</label>
                        <select class="form-control" name="to_company_branch" id="to_company_branch" required>
                            <option value="" selected disabled>اختر فرع الشركة</option>

                        </select>
                    </div>
                </div>
            </div> --}}
{{-- <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="import" name="import">حفظ</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div> --}}
{{-- </form> --}}
{{-- </div>
    </div>
</div> --}}

<div class="modal fade" id="add-new-trade-name-modal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة اسم تجاري</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Close.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
            <rect x="0" y="7" width="16" height="2" rx="1"/>
            <rect opacity="0.3" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/>
        </g>
    </g>
</svg><!--end::Svg Icon--></span>
                </button>
            </div>

            <form class="form" action="" id="add-new-trade-form" method="post">
                <input type="hidden" id="to_item_id" name="to_item_id">
                <input type="hidden" id="to_tr_idx" name="to_tr_idx">
                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                <div class="modal-body">

                    <div class="form-group row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label>الاسم التجاري</label>
                            <input type="text" name="new_trade_name" id="new_trade_name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="import" name="import">حفظ</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="generate-tender-pdf-modal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إنشاء ملف PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Close.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
            <rect x="0" y="7" width="16" height="2" rx="1"/>
            <rect opacity="0.3" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/>
        </g>
    </g>
</svg><!--end::Svg Icon--></span>
                </button>
            </div>
            <form class="form" action="" id="generate-tender-pdf-form" method="post">
                <input type="hidden" id="t_id" name="t_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label>إدراج ملاحظات</label>
                            <span class="switch notes_switch">
                                <label>
                                    <input type="checkbox" name="notes_status" id="notes_status">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row note_div">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label>ملاحظات</label>
                            <textarea name="pdf_notes" id="pdf_notes" rows="4" class="form-control">

                        </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="import" name="import">إنشاء</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>
