@extends('layouts.cpanel.app')

@section('title')
التقارير
@endsection
@section('style')
<style>
    .get-tender{
        color: #3699FF;
        cursor:pointer;
    }
</style>
@endsection

@section('breadcrumb')
<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الرئيسية</h5>
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">التقارير</span>
@endsection
@section('content')
<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">
             التقارير
                </span>
            </h3>
        </div>
        <div class="card-body py-0">
            <form action="{{route('reports.excel')}}" method="post">
                @csrf
                <div class="row my-4">
                @if(session()->has('error'))
                <div class="col-md-12">
                     <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                            <div class="alert-icon">
                                <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-text">{{session('error')}}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">
                                        <i class="fa fa-close"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                </div>

                        @endif
                    <div class="col-md-4 col-lg-4 pr-0">
                        <div class="form-group">
                            <label for=""> نوع التقرير</label>
                            <select class="form-control" name="report_type" id="report_type">
                                <option value="" selected>اختر نوع التقرير</option>
                                <option value="1" {{(old('report_type')=='1')? 'selected':''}}>الأصناف المنتهية</option>
                                <option value="2" {{(old('report_type')=='2')? 'selected':''}}>تقرير تفاصيل الصنف</option>
                                <option value="3" {{(old('report_type')=='3')? 'selected':''}}>تقرير أرصدة الصنف</option>
                                <option value="4" {{(old('report_type')=='4')? 'selected':''}}>تقرير تفاصيل المؤسسة </option>
                                <option value="5" {{(old('report_type')=='5')? 'selected':''}}>تقرير الأسعار المنافسة </option>
                                <option value="6" {{(old('report_type')=='6')? 'selected':''}}>تقرير تفاصيل المناقصة</option>
                                <option value="7" {{(old('report_type')=='7')? 'selected':''}}>تقرير حركات الصنف</option>
                                <option value="8" {{(old('report_type')=='8')? 'selected':''}}>تقرير حالة المناقصة</option>
                           {{-- <option value="9" {{(old('report_type')=='9')? 'selected':''}}>تقرير نوع الكفالة</option>    --}}
                                <option value="10" {{(old('report_type')=='10')? 'selected':''}}>تقرير مدة توريد الأصناف</option>
                                <option value="11" {{(old('report_type')=='11')? 'selected':''}}>تقرير أسعار الموردين للصنف</option>
                                <option value="12" {{(old('report_type')=='12')? 'selected':''}}>تقرير الاصناف غير الموردة </option>
                                <option value="13" {{(old('report_type')=='13')? 'selected':''}}> الاسعار التي لم يتم ترسيتها </option>
                                <option value="14" {{(old('report_type')=='14')? 'selected':''}}>تقرير الاصناف التي تمت ترسيتها </option>
                                <option value="15" {{(old('report_type')=='15')? 'selected':''}}> تقرير الاصناف التي تمت ترسيتها على المنافسين  </option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 pr-0">
                        <label for="">  من تاريخ  الى تاريخ </label>

                    <div class="input-group">
						<div class="input-group-prepend">

							<span class="input-group-text">من</span>
						</div>
                        <input type="text" class="form-control datepicker" name="created_date_from" id="created_date_from" readonly="readonly" placeholder="اختر التاريخ">
						<div class="input-group-append">
							<span class="input-group-text">إلى</span>
						</div>
                        <input type="text" class="form-control datepicker" name="created_date_to" id="created_date_to" readonly="readonly" placeholder="اختر التاريخ">
					    </div>
                    </div>
                    <div class="col-md-4 col-lg-4 pr-0 item_div {{(old('report_type')=='2'|| old('report_type')=='3'|| old('report_type')=='11'|| old('report_type')=='5' ||old('report_type')=='7')? 'show_div':'hide_div'}}" >
                        <label for="">  الصنف</label>

                        <div class="form-group">
                            <select class="form-control select2" name="item[]" id="item" multiple="multiple">

                            </select>
                            <!-- <select class="form-control" name="item" id="item">
                                <option value="" selected>اختر الصنف</option>
                                @foreach($data['items'] as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select> -->
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 pr-0 client_div {{(old('report_type')=='4')? 'show_div':'hide_div'}}" >
                        <label for=""> اسم المؤسسة </label>

                        <div class="form-group">
                            <select class="form-control select2" name="client" id="client" multiple="multiple"></select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 pr-0 tender_div {{(old('report_type')=='6' || old('report_type')=='1'||old('report_type')=='10'||old('report_type')=='12'||old('report_type')=='13')? 'show_div':'hide_div'}}" >
                        <label for=""> اسم او رقم المناقصه </label>

                        <div class="form-group">
                            <select class="form-control " name="tender" id="tender" multiple="multiple"></select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 pr-0 guarantee_div {{(old('report_type')=='9')? 'show_div':'hide_div'}}" >
                        <label for=""> حالة الكفالة </label>

                        <div class="form-group">
                            <select class="form-control" name="guarantee" id="guarantee">
                                <option value="" selected>اختر حالة الكفالة</option>
                                <option value="1">مستردة</option>
                                <option value="2">غير مستردة</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 pr-0 tender_status_div {{(old('report_type')=='8')? 'show_div':'hide_div'}}" >
                        <label for=""> حالة المناقصة </label>

                        <div class="form-group">
                            <select class="form-control" name="tender_status" id="tender_status">
                                <option value="" selected>اختر حالة المناقصة</option>
                                <option value="1">منجزة</option>
                                <option value="2">غير منجزة</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 pr-0 tender_branch_div hide_div" >
                        <label for=""> فرع الشركة </label>
                        <div class="form-group">
                            <select class="form-control" name="branch_id" id="branch_id">
                                <option value="" selected>اختر فرع الشركة </option>
                                @if($data['branch'])
                                    @foreach($data['branch'] as $branch)
                                        <option value="{{$branch->value}}">{{$branch->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                     <div class="col-md-4 col-lg-4 pr-0 tender_currency_div hide_div" >
                        <label for=""> العملة </label>
                        <div class="form-group">
                            <select class="form-control" name="currency_id" id="currency_id">
                                <option value="" selected>اختر العملة  </option>
                                @if($data['currency'])
                                    @foreach($data['currency'] as $currency)
                                        <option value="{{$currency->value}}">{{$currency->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>



                    <div class="col-md-12 col-lg-12">
                        <button  type="button" class="btn btn-success font-size-sm button_submit" name="submit" data-value="export" > <i class="fa fa-file-excel-o font-weight-bold"></i>تصدير اكسل</button>
                        <button  type="button" class="btn btn-danger font-size-sm button_submit" name="submit" data-value="pdf" > <i class="fa fa-file-excel-o font-weight-bold"></i>تصدير PDF </button>
                        <button  type="button" class="btn btn-info font-size-sm button_submit"  name="submit" data-value="view"> <i class="fa fa-eye font-weight-bold"></i>عرض البيانات</button>
                    </div>

                </div>
            </form>
            <div class="col-md-12 col-lg-12 table-responsive">
                @if(session()->has('table'))
                    {!! session('table') !!}
                @endif
            </div>
        </div>
    </div>
</div>
<!--end::Container-->

<div id="show-body">
    @includeIf('admin.tender.sub.show')
</div>

@endsection
@section('script')
<script>
    $(function() {
        $('#report_type').on('change',function () {
            let type=$(this).val()
            // if(type==5){
            //     $('.tender_div').show()

            // }else{
            //     $('.tender_div').hide()

            // }
            $('.tender_branch_div').hide();
            $('.tender_currency_div').hide();

            $('.tender_branch_div .branch_id').val('');
            $('.tender_currency_div .currency_id').val('');


            if(type==2|| type==3||type==5 || type==7 || type==11){
                $('.item_div').show()
                $('.client_div').hide()
                if(type==5){
                    $('.tender_div').show()
                }else{
                    $('.tender_div').hide()
                }
                $('.guarantee_div').hide()
                $('.tender_status_div').hide()

            }else if(type==4){
                $('.item_div').hide()
                $('.client_div').show()
                $('.tender_div').hide()
                $('.guarantee_div').hide()
                $('.tender_status_div').hide()

            }else if(type==6||type==1|| type==12 || type==10 || type==13 || type==14 || type==15){
                $('.tender_div').show()
                $('.item_div').hide()
                $('.client_div').hide()
                $('.tender_status_div').hide()
                $('.guarantee_div').hide()


            }else if(type==8){
                $('.tender_status_div').show()
                $('.guarantee_div').hide()
                $('.item_div').hide()
                $('.client_div').hide()
                $('.tender_div').hide()
            }
            else if(type==9){

                $('.guarantee_div').show()
                $('.item_div').hide()
                $('.client_div').hide()
                $('.tender_div').hide()
                $('.tender_status_div').hide()

            }
            else{
                $('.guarantee_div').hide()
                $('.client_div').hide()
                $('.item_div').hide()
                $('.tender_div').hide()
                $('.tender_status_div').hide()


            }

            if(type==5){
                $('.tender_branch_div').show();
                $('.tender_currency_div').show();
                $('.client_div').show();
            }

        })
        $('#client').select2({
            placeholder: 'اختر المؤسسة',
            maximumSelectionLength: 1,
            language:{
            local:'ar',
                searching: function (params) {
                    return 'جاري البحث';
                },
                noResults: function(){
                    return 'لا يوجد نتائج';
                },
                maximumSelected:function (e){
                    return 'فقط يمكن اختيار عميل واحد';

                }
            },
            dir: "rtl",
            ajax: {
            url:"{{route('reports.clients')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.ar_name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
            }
        })
        $('#tender').select2({
            placeholder: 'اختر المناقصة',
            maximumSelectionLength: 1,
            // language:{
            // local:'ar',
            //     searching: function (params) {
            //         return 'جاري البحث';
            //     },
            //     noResults: function(){
            //         return 'لا يوجد نتائج';
            //     },
            //     maximumSelected:function (e){
            //         return 'فقط يمكن اختيار مناقصة واحدة';

            //     }
            // },
            dir: "rtl",
            ajax: {
            url:"{{route('reports.tenders')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (tender) {
                        return {
                            text: tender.tender_no + ' - ' + tender.client + " - "+tender.branch_name,
                            id: tender.id
                        }
                    })
                };
            },
            cache: true
            }
        })
        $('#item').select2({
            placeholder: 'اختر الصنف',
            maximumSelectionLength: -1,
            language:{
            local:'ar',
                searching: function (params) {
                    return 'جاري البحث';
                },
                noResults: function(){
                    return 'لا يوجد نتائج';
                },
                maximumSelected:function (e){
                    return 'فقط يمكن اختيار صنف واحد';

                }
            },
            dir: "rtl",
            ajax: {
            url:"{{route('reports.items')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
            }
        })

        $(document).on('click','.button_submit',function(e){

            $('.table-responsive').html('');
            e.preventDefault();
            var val = $(this).data('value');
            var type_report = $('#report_type').val();
            var created_date_from = $('#created_date_from').val();
            var created_date_to = $('#created_date_to').val();


            var item = ($('#item').select2('val'));
            var client = $('#client').select2('val');
            var tender = $('#tender').select2('val');
            var guarantee = $('#guarantee').val();
            var tender_status = $('#tender_status').val();
            var branch = $('#branch_id').val();
            var currency = $('#currency_id').val()
            if(type_report == ''){
                $('#report_type').css('border-color','red');
                return false

            }else{

                $('#report_type').css('border-color','#e4e6ef');
            }
            if(val == 'export'){

                var query = {
                    val:val,
                    report_type:type_report,
                    created_date_from:created_date_from,
                    created_date_to:created_date_to,
                    item:item,
                    client:client,
                    tender:tender,
                    guarantee:guarantee,
                    tender_status:tender_status,
                    branch:branch,
                    currency:currency,
                }
                var url = "/reports/export/excel?" + $.param(query)
                window.location = url;
            }else if(val == 'pdf'){
                var query = {
                    val:val,
                    report_type:type_report,
                    created_date_from:created_date_from,
                    created_date_to:created_date_to,
                    item:item,
                    client:client,
                    tender:tender,
                    guarantee:guarantee,
                    tender_status:tender_status,
                    branch:branch,
                    currency:currency,
                }
                var url = "/reports/export/excel?" + $.param(query)
                // window.location = url;
                window.open(url);
            }else{

                    // if(report_type == 5){

                        // $.ajax({
                        //     url: "/reports/export/excel",
                        //     type: "get",
                        //     dataType: "html",

                        //     data: {
                        //         val:val,
                        //         report_type:type_report,
                        //         created_date_from:created_date_from,
                        //         created_date_to:created_date_to,
                        //         item:item,
                        //         client:client,
                        //         tender:tender,
                        //         guarantee:guarantee,
                        //         tender_status:tender_status,

                        //     },success: function( data ) {
                        //         // if(data['status'] == true){
                        //             // alert(123321);
                        //             $('.table-responsive').html(data);
                        //         // }else{

                        //         //     Swal.fire({
                        //         //         showCloseButton: true,
                        //         //     icon: 'error',
                        //         //     title: '',
                        //         //     text: data.data,
                        //         //     confirmButtonText: 'موافق'
                        //         //     });

                        //         // }

                        //     }
                        // });

                    // }else{

                        $.ajax({
                            url: "/reports/export/excel",
                            type: "get",
                            dataType: "json",

                            data: {
                                val:val,
                                report_type:type_report,
                                created_date_from:created_date_from,
                                created_date_to:created_date_to,
                                item:item,
                                client:client,
                                tender:tender,
                                guarantee:guarantee,
                                tender_status:tender_status,
                                branch:branch,
                                currency:currency,

                            },success: function( data ) {
                                if(data['status'] == true){
                                    $('.table-responsive').html(data.table);
                                }else{

                                    Swal.fire({
                                        showCloseButton: true,
                                    icon: 'error',
                                    title: '',
                                    text: data.data,
                                    confirmButtonText: 'موافق'
                                    });

                                }

                            }
                        });

                    // }

            }

        });



    })
</script>
<script>
    $(document).on('click','.get-tender',function(e){
        e.preventDefault();
        var id = $(this).data('id');
         $.ajax({
            url: '{{url("tenders/show/")}}/'+id ,
            type: "get",
            success: function( response ) {
                if(response.status==true)
                    $('#show-body').html(response.show_data)
            },
            error:function(response){

            },
            complete:function (response) {
                $('#show-tender').modal('show')
            }

        })
    });
</script>
@endsection
