<div class="modal fade" id="add-tender" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة مناقصة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
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
                                    <li class="add_active active" data-step="step1">بيانات المناقصة</li>
                                    <li class="add_active" data-step="step2">أصناف المناقصة</li>
                                    {{-- @can('item-price-offers') --}}
                                    <li class="add_active" data-step="step3">عروض أسعار الأصناف</li>
                                    {{-- @endcan --}}
                                    <li class="add_active" data-step="step4">تسعير المناقصة</li>
                                    <li class="add_active" data-step="step5">بيانات إضافية</li>

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
                                                <select class="form-control select2" name="client" id="client" multiple="multiple">

                                                </select>
                                                <div class="input-group-append">
                                                <span class="input-group-text"> <a id="add_client_btn" class="" style="cursor:pointer;line-height: 10px;"> <i class="fa fa-plus"></i></a></span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">رقم المناقصة</label>
                                            <input type="text" name="tender_no" id="tender_no" class="form-control"/>
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
                                                <option value="{{$guarantee_type->value}}">{{$guarantee_type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">نسبة الكفالة</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="guarantee_rate" id="guarantee_rate"/>
                                                <div class="input-group-append">
                                                <span class="input-group-text"> %</span>
                                                </div>
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
                                                <input type="text" class="form-control datepicker" name="representation_date" id="representation_date" readonly="readonly">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">سعر التحويل</label>
                                            <input type="text" name="transfer_price" id="transfer_price" class="form-control"/>
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

                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">ملف المناقصة معبأة بالأسعار</label>
                                            <div class="input-group">
                                            <input type="file" name="tender_file" id="tender_file" accept=".doc,.docx,.pdf,.odt,.dot" class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text tender_file_div">
                                                        <i class="fa fa-upload"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">ملف الاحالة / الترسية </label>
                                            <div class="input-group">
                                            <input type="file" name="referral_file" id="referral_file" accept=".doc,.docx,.pdf,.odt,.dot" class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text referral_file_div">
                                                        <i class="fa fa-upload"></i>
                                                    </span>
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
                                    </div>
                                    <div class="form-group row mx-6">
                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder"> مستخدمين المناقصة</label>
                                            <select class="form-control select2" name="users[]" id="users" multiple="multiple">
                                                <option value="" disabled>اختر المستخدمين</option>
                                                @foreach($data['users'] as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row mx-6">
                                        <div class="col-md-12 col-lg-12 buttons">
                                            <button type="button" id="save_data" name="save_data" class="btn btn-sm btn-success" data-type="1">حفظ البيانات</button>
                                            <button type="button" id="stepone" name="next" class="btn btn-sm btn-primary">التالي</button>
                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset id="step2" class="step2">
                                <legend class="">بيانات أصناف المناقصة</legend>
                                    <div class="row my-3">
                                        <div class="col-md-2 col-lg-2 col-sm-2 text-right p-0">
                                            <!-- <button type="button" id="add_item" name="add_item" class="btn btn-success btn-sm">إضافة  <i class="fa fa-plus"></i></button> -->
                                            <button type="button" id="add_item" name="add_item" class="btn btn-success">
											    <i class="fa fa-plus font13"></i>إضافة
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
                                        <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table" >
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
                                            <button type="button" id="save_data" name="save_data" class="btn btn-sm btn-success" data-type="2">حفظ البيانات</button>
                                            <button type="button" id="previous1" name="previous" class="btn btn-sm btn-primary">السابق</button>
                                            <button type="button" id="stepone" name="next" class="btn btn-sm btn-primary">التالي</button>
                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button>

                                        </div>
                                    </div>

                                </fieldset>

                                {{-- @can('item-price-offers') --}}
                                <fieldset id="step3" class="step3">
                                    <legend class="">مرحلة عروض الاسعار</legend>

                                    <div class="row my-3">
                                        <div class="col-md-2 col-lg-2 col-sm-2 text-right p-0">
                                            <!-- <button type="button" id="add_item" name="add_item" class="btn btn-success btn-sm">إضافة  <i class="fa fa-plus"></i></button> -->
                                            <button type="button" id="add_tender_item" name="add_tender_item" class="btn btn-success">
											    <i class="fa fa-plus font13"></i>إضافة
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
                                                <input type="file" name="prices_file" id="prices_file" accept=".pdf" class="form-control" placeholder="رفع ملف عروض الاسعار">
                                                <div class="input-group-append">
                                                    <span class="input-group-text tender_suppliers_prices">
                                                        <i class="fa fa-upload"></i>
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
                                                        <th >اسم الصنف</th>
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
                                            <button type="button" id="save_data" name="save_data" class="btn btn-sm btn-success" data-type="3">حفظ البيانات</button>
                                            <button type="button" id="previous1" name="previous" class="btn btn-sm btn-primary">السابق</button>
                                            <button type="button" id="stepone" name="next" class="btn btn-sm btn-primary">التالي</button>
                                            <button type="button"class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </fieldset>
                                {{-- @endcan --}}
                                <fieldset id="step4" class="step4">
                                    <legend class="">مرحلة  تسعير المناقصة</legend>
                                    <div class="row my-3">
                                        <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table">
                                            <table class="table table-bordered tender-pricing-table text-center">
                                                <thead>
                                                    <tr>
                                                        <th>رقم الصنف</th>
                                                        <th >اسم الصنف</th>
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
                                            <button type="button" id="save_data" name="save_data" class="btn btn-sm btn-success" data-type="3">حفظ البيانات</button>
                                            <button type="button" id="previous1" name="previous" class="btn btn-sm btn-primary">السابق</button>
                                            <button type="button" id="stepone" name="next" class="btn btn-sm btn-primary">التالي</button>
                                            <button type="button"class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset id="step5" class="step5">
                                    <legend class="">بيانات إضافية</legend>
                                    <div class="form-group row mx-6">

                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">رقم كفالة دخول العطاء</label>
                                            <input type="text" name="guarantee_no" id="guarantee_no" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">صورة الكفالة</label>
                                            <input type="file" name="guarantee_file" class="form-control" id="guarantee_file">
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">الشخص المسؤول</label>
                                            <input type="text" name="manager" id="manager" class="form-control"/>
                                        </div>

                                    </div>
                                    <div class="form-group row mx-6">
                                    <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">قيمة الكفالة</label>
                                            <input type="text" name="guarantee_value" id="guarantee_value" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">تاريخ استلام أمر التوريد</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control datepicker" name="receipt_date" id="receipt_date" readonly="readonly">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <label class="font-weight-bolder">ملف امر التوريد </label>
                                            <input type="file" name="receipt_file" id="receipt_file" accept=".doc,.docx,.pdf,.odt,.dot" class="form-control">

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
                                            <button type="button" id="save_data" name="save_data" class="btn btn-sm btn-success" data-type="4">حفظ البيانات</button>
                                            {{-- <button type="button" id="previous1" name="previous" class="btn btn-sm btn-primary">السابق</button>
                                            <button type="button"  class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button> --}}
                                            <button type="button" id="previous1" name="previous" class="btn btn-sm btn-primary">السابق</button>
                                            <button type="button" id="stepone" name="next" class="btn btn-sm btn-primary">التالي</button>
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
                                                       <h3 class="text-center"> المناقصة لفرع <span id="tender_branch_name"></span></h3>
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
                                                                <select class="form-control" name="to_company_branch" id="to_company_branch" required>
                                                                    <option value="" selected disabled>اختر فرع الشركة</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mx-6 my-3">
                                                        <div class="col-md-12 col-lg-12 buttons">
                                                            <button type="submit" id="import" name="import" class="btn btn-sm btn-success" >حفظ </button>
                                                            <button type="button" id="previous1" name="previous" class="btn btn-sm btn-primary">السابق</button>
                                                            <button type="button" id="stepone" name="next" class="btn btn-sm btn-primary">التالي</button>
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
                                        <div  id="accepting_edit">
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
                                                    <button type="button" id="save_data" name="save_data" class="btn btn-sm btn-success" data-type="3">حفظ البيانات</button>
                                                    <button type="button" id="previous1" name="previous" class="btn btn-sm btn-primary">السابق</button>
                                                    <button type="button" id="stepone" name="next" class="btn btn-sm btn-primary">التالي</button>
                                                    <button type="button"class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button>

                                                </div>
                                            </div>
                                    </fieldset>
                                {{-- @endcan --}}

                                {{-- @can('tenders-print-pdf')  --}}
                                <fieldset id="step10" class="step10">
                                    <legend class="">إنشاء PDF</legend>
                                    <div class="row mx-6  my-3">

                                        <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                                            <button type="button" class="btn btn-sm btn-danger generate-tender-pdf" >إنشاء PDF</button>
                                        </div>
                                    </div>
                                        <div class="form-group row mx-6 my-3">
                                            <div class="col-md-12 col-lg-12 buttons">
                                                <button type="button" id="save_data" name="save_data" class="btn btn-sm btn-success" data-type="3">حفظ البيانات</button>
                                                <button type="button" id="previous1" name="previous" class="btn btn-sm btn-primary">السابق</button>
                                                <button type="button"  class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button type="button"class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button>

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
                    <i aria-hidden="true" class="fa fa-close"></i>
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

<div class="modal fade" id="add-new-trade-name-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة اسم تجاري</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
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

<div class="modal fade" id="generate-tender-pdf-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إنشاء ملف PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
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
