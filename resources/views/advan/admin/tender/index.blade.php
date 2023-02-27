@extends('layouts.cpanel.app')

@section('title')
المناقصات
@endsection
@section('style')
<style>


    /* Form styles */
#tender_form {
	width: 100%;
	position: relative;
}
#msform fieldset {
	box-sizing: border-box;
	width: 100%;
	position: relative;
}
 /* Hide all except first fieldset */
#step6,
#step7,
#step8,
#step9,
#step10,
#tender_form fieldset:not(:first-of-type) {
	display: none;
}
/* Progressbar */
#progressbar {
	margin-bottom: 10px;
	overflow: hidden;
	/*CSS counters to number the steps*/
	counter-reset: step;
}
#progressbar li {
	list-style-type: none;
    color: #000000;
	font-size: 12px;
	width: 20%;
	float: right;
	position: relative;
	text-align: center;
    cursor: pointer;

}


#progressbar li.active {
	color: #045b0b;
}
#progressbar li.active {
    color: #1bd993;
}
#progressbar li::before {
	content: counter(step,arabic-indic);
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
}

/* Progressbar connectors */
#progressbar li::after {
	content: '';
	width: 100%;
	height: 2px;
	background: white;
	position: absolute;
	left: -50%;
	top: 9px;
	z-index: -1;
}
#progressbar li:first-child:after {
	/* connector not needed before the first step */
	content: none;
}
#progressbar li.active:before,  #progressbar li.active:after{
	background: #1bd993;
	color: white;
}

.buttons{
    text-align:left;
}
fieldset {
    text-align: right;
    border: 1px solid #cfd0dc !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
}
legend {
    display: block;
    width: auto;
    max-width: 100%;
    padding: 0;
    margin-bottom: .5rem;
    font-size: 1.5rem;
    line-height: inherit;
    color: inherit;
    white-space: normal;
}

.scrollable-table::-webkit-scrollbar-track {
    background-color: #f2f2f2 !important;
}

.scrollable-table::-webkit-scrollbar-thumb {
    background: #adaeb6 !important;
    border-radius: 10px !important;
}
.scrollable-table{
    position: relative;
    height: 300px;
    overflow-y: auto;
    display: block;
}
.client-select .select2-container {
    width: calc(100% - 42px) !important;
    /* border-top-left-radius: 0 !important; */
}
.select2-container--default.select2-container--focus .select2-selection--multiple , .select2-container--default .select2-selection--multiple {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
}
</style>
@endsection
@section('breadcrumb')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الرئيسية</h5>
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">المناقصات</span>

@endsection
@section('content')
<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">
                المناقصات
                </span>
            </h3>
            <div class="card-toolbar">
                {{-- @can('tenders-add') --}}
                    <button  class="btn btn-danger font-size-sm" id="add-button"> <i class="fa fa-plus font-weight-bolder"></i> إضافة مناقصة</button>
                {{-- @endcan --}}
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->

        <div class="card-body py-0">
            <div class="row my-4 border p-4">
                <div class="col-md-12 col-lg-12 mb-3 mt-1">
                    <h4 class="font-weight-bolder">البحث</h4>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm search_input" id="tender_no_search" name="tender_no_search" placeholder="رقم المناقصة"/>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <select class="form-control select2 search_select" name="client_search" id="client_search" multiple="multiple">
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <select class="form-control search_select" name="branch_search" id="branch_search">
                            <option value="" selected>اختر فرع الشركة</option>
                            @foreach($data['company_select'] as $company)
                                <option value="{{$company->value}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <select class="form-control search_select" name="guarantee_type_search" id="guarantee_type_search">
                            <option value="" selected>اختر نوع الكفالة</option>
                                @foreach($data['guarantee_type_select'] as $guarantee_type)
                                <option value="{{$guarantee_type->value}}">{{$guarantee_type->name}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <select class="form-control search_select" name="tax_search" id="tax_search">
                            <option value="" selected>اختر الضريبة</option>
                            @foreach($data['tax_select'] as $tax)
                               <option value="{{$tax->value}}">{{$tax->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">من</span>
						</div>
                        <input type="text" class="form-control datepicker search_date" name="representation_date_from_search" id="representation_date_from_search" readonly="readonly" placeholder="اختر تاريخ تقديم المناقصة">
						<div class="input-group-append">
							<span class="input-group-text">إلى</span>
						</div>
                        <input type="text" class="form-control datepicker search_date" name="representation_date_to_search" id="representation_date_to_search" readonly="readonly" placeholder="اختر تاريخ تقديم المناقصة">
					</div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">من</span>
						</div>
                        <input type="text" class="form-control datepicker search_date" name="created_date_from_search" id="created_date_from_search" readonly="readonly" placeholder="اختر تاريخ إنشاء المناقصة">
						<div class="input-group-append">
							<span class="input-group-text">إلى</span>
						</div>
                        <input type="text" class="form-control datepicker search_date" name="created_date_to_search" id="created_date_to_search" readonly="readonly" placeholder="اختر تاريخ إنشاء المناقصة">
					</div>
                </div>


            </div>
                    <div class="row pb-4">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                            <select class="form-control" name="order_type" id="order_type">
                                <option value="" selected>اختر طريقة ترتيب المناقصات</option>
                                @foreach($data['order_tenders_select'] as $order)
                                <option value="{{$order->value}}">{{$order->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <div class="form-group">
                            <select class="form-control" name="order" id="order">
                                <option value="" selected>اختر نوع الترتيب</option>
                                @foreach($data['order_type_select'] as $ordert)
                                <option value="{{$ordert->value}}">{{$ordert->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <button id="order_tender_btn" class="btn btn-primary">
                                <span class="font-weight-bolder">ترتيب</span>
                            </button>
                        </div>
                    </div>
                    {{-- @can('tenders-delete') --}}
                        <div class="row pb-4">
                            <div class="col-md-2 col-lg-2">
                                <button id="order_delet_btn" class="btn btn-danger">
                                    <span class="font-weight-bolder"> حذف المحدد </span>
                                </button>
                            </div>
                        </div>
                    {{-- @endcan --}}



            <!--begin::Table-->
            <div class="tenders-table-body"> @include('advan.admin.tender.table-data')</div>

           <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>




</div>


<div id="assesment_body">
    @includeIf('advan.admin.tender.sub.assesment')
</div>
<div class="supplied-body">
    @includeIf('advan.admin.tender.sub.supply-items')
</div>
<div id="show-body">
    @includeIf('advan.admin.tender.sub.show')
</div>

<div class="accepting-body">
    @includeIf('advan.admin.tender.sub.accepting-items')
</div>
@include('advan.admin.tender.sub.add')
    {{-- @includeIf('advan.admin.clients.create') --}}
</div>

@include('advan.admin.tender.sub.accepting-items')

<!--end::Container-->
@endsection
@section('script')
<script>

    function load_data_table(page='') {
        $.ajax({
            url: '{{url("admin/tenders/")}}?page='+page ,
            data:{order:$('#order_type').val(),order_way:$('#order').val(),tender_no:$('#tender_no_search').val(),client:$('#client_search').select2('val'),
                guarantee_type:$('#guarantee_type_search').val(),branch:$('#branch_search').val(),tax:$('#tax_search').val(),created_date_from_search:$('#created_date_from_search').val(),created_date_to_search:$('#created_date_to_search').val()
                ,representation_date_from_search:$('#representation_date_from_search').val(),representation_date_to_search:$('#representation_date_to_search').val()},
            type: "get",
            success: function( response ) {
                $('.tenders-table-body').html(response.tenders)

            },
            error:function(response){
            }

        })
    }
    function load_supplied_items_table(tende_id) {
        $.ajax({
            url: '{{url("admin/tenders/supplied/items/")}}/'+tende_id ,
            type: "get",
            success: function( response ) {
                $('.supplied-body #supply-items-modal .modal-body').html(response.supplied_data)
                $('#supplied_edit').html(response.supplied_data)

                $('.datepicker').datepicker({
                            rtl: true,
                            todayBtn: "linked",
                            clearBtn: true,
                            todayHighlight: true,
                            // orientation: "top left",

                        });

            },
            error:function(response){
            }

        })
    }
    function clear_modal() {
        $('.tender_file_div').html(`<i class="fa fa-upload"></i>`)
        $('.referral_file_div').html(`<i class="fa fa-upload"></i>`)


            $('#progressbar li').css('width','20%');

            $('.view_edit').addClass('d-none');

            $('#tender_form').trigger('reset');
            $('#client').val(null).trigger('change');
            $('#items-table-body').html('');
            $('#items-pricing-table-body').html('');
            $('#tender-pricing-table-body').html('');
            $('#tender-pricing-table-footer #total').text(0);
            $('#tender-pricing-table-footer #tender_curn').text('')
            $("#progressbar li").removeClass("active");
            $("#progressbar li").eq(0).addClass("active");
            $('#tender_form fieldset').hide();
            $('#tender_form #div_bid_status').hide();
            $('#tender_form fieldset').eq(0).show();
            $("#tender_form #users").val(null).trigger('change');

            $('#tender-items').html(`<option value="" selected disabled>اختر صنف من أصناف المناقصة</option>`)
    }
    $(function () {
        $('#order_type').val(2)

        $('#client').select2({
            placeholder: 'اختر العميل',
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
            url:"{{route('admin.tenders.clients')}}",
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
        $('#client_search').select2({
            placeholder: 'اختر العميل',
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
            url:"{{route('admin.tenders.clients')}}",
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
        $('#users').select2({
            placeholder: 'اختر مستخدمين المناقصة'

        });

        $('#item_name').select2({
            placeholder: 'اختر الصنف'
        });
        $('#item_name1').select2({
            placeholder: 'اختر الصنف'
        });
        $('.search_input').keyup(function(){
            let val=$(this).val();
            if (val=='' || val.length>3) {
                load_data_table()
            }
        })
        $('#order_tender_btn').on('click',function(e) {
            e.preventDefault()
            load_data_table()
        })
        $('.search_select , .search_date').on('change',function() {
            load_data_table()
        })

        $('#add-button').on('click',function () {
            $('#add-tender #hidden').val(0)
            clear_modal()
            $('#add-tender').modal('show');
        })
        $(document).on('click', '.pagination a',function(event){
            event.preventDefault();
            let url=$(this).attr('href');
            var page=url.split('page=')[1];
            load_data_table(page)
        });


        $(document).on('click','#save_data',function(e) {
            e.preventDefault()
            let hidden=$('#add-tender #hidden').val();
            let type=$(this).data('type')
            $('#type').val(type)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let form=new FormData($('#tender_form')[0])

            if (hidden==0) {
                $.ajax({
                    url: '{{route("admin.tenders.store")}}' ,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    data:form ,
                    success: function( response ) {
                        if(response.status==true){
                            $('#hidden').val(response.tender_id)
                            Swal.fire({
                                showCloseButton: true,
                                icon: 'success',
                                title:response.success,
                                confirmButtonText: 'موافق'
                            });

                            $('#tender_form #div_bid_status').show();
                            $('#tender_form #bid_status').val(response.bid_status);

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
                    }
                });

            }
            else if (hidden>0) {
                $.ajax({
                    url: '{{route("admin.tenders.update")}}' ,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    data: form,
                    success: function( response ) {
                        if(response.status==true){
                            $('#hidden').val(response.tender_id)
                            Swal.fire({
                                showCloseButton: true,
                                icon: 'success',
                                title:response.success,
                                confirmButtonText: 'موافق'
                            })
                            load_data_table()
                            getAllData(response.tender_id);
                            // $('#add-tender').modal('hide');
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
                    },complete:function(response){

                    }
                });

            }
        })
        $(document).on('click','#add_tender_item',function(e) {
            e.preventDefault()
            let item=$('#tender-items').val()
            // alert('**3**');

            $(`#items-table-body tr.tr_${item}`).find('td').eq(3)
            $.ajax({
                url: '{{url("admin/tenders/items/")}}/'+item,
                type: "get",
                success: function( response ) {
                    if(response.status==true){

                        let names_select="";
                        if (response.item.names!='') {
                            for (let i = 0; i < response.item.names.length; i++) {
                                const element = response.item.names[i];
                                names_select+=`<option value="${element.id}">${element.trade_name}</option>`
                            }
                        }

                        $('#items-pricing-table-body').append(`
                            <tr class="tr_${response.item.id}"><input type="hidden" name="sitems[]" id="" value="${response.item.id}">
                            <td><button class="btn btn-icon btn-danger btn-circle btn-sm remove-duplicate-item mx-1" title="حذف" id="${response.item.id}"><i class="fa fa-close remove-duplicate-item" id="${response.item.id}"></i></button></td>
                                <td id="item_no">${response.item.item_no}</td>
                                <td id="item_name">${response.item.name}</td>
                                <td width="20%">
                                <select name="trade_names[]" id="trade_names">
                                    <option value="" selected>اختر الاسم التجاري</option>
                                    ${names_select}
                                </select>
                                <a id="add_new_trade_name"><i class="fa fa-plus btn btn-info btn-icon btn-circle"></i></a>
                                </td>
                                <td id="shape">${response.item.shape_name}</td>
                                <td id="unit">${$(`#items-table-body tr.tr_${item}`).find('td').eq(3).find("select :selected").text()}</td>
                                <td id="quantity">${$(`#items-table-body tr.tr_${item}`).find('td').eq(4).find("input[type='text']").val()}</td>
                                <td>
                                    <select class="form-control" name="suppliers[]" id="suppliers">
                                        <option value="" selected>اختر المورد</option>
                                            @foreach($data['suppliers'] as $supplier)
                                                    <option value="{{$supplier->id}}">{{$supplier->ar_name}}</option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="sprice[]" id="sprice" value="">
                                </td>
                                <td>
                                <input type="text" class="form-control form-control-sm" name="durations[]" id="durations" value="">

                                <td><input style="width: 95px;" type="text" class="form-control datepicker" name="expired_at[]" id="expired_at[]" readonly="readonly"></td>
                                <td><input type="text" class="form-control form-control-sm" name="notes[]" id="notes" value=""></td>

                            </tr>
                        `);

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

                },complete:function () {

                    $('#tender-items').val('');
                    $('.datepicker').datepicker({
                            rtl: true,
                            todayBtn: "linked",
                            clearBtn: true,
                            todayHighlight: true,
                            // orientation: "top left",

                        });

                }
            });
        })
        $(document).on('click','#add_item',function(e) {
            e.preventDefault()
            let item=$('#item_name').select2('val');

            if (item!=null) {
                 $.ajax({
                    url: '{{url("admin/tenders/items/")}}/'+item,
                    type: "get",
                    success: function( response ) {
                        if(response.status==true){

                            if($(`#items-table-body tr.tr_${response.item.id}`).length==0){

                            $('#items-table-body').append(`
                                <tr class="tr_${response.item.id}"><input type="hidden" name="items[]" id="" value="${response.item.id}">
                                <td>${response.item.item_no}</td>

                                    <td>${response.item.name}</td>
                                    <td>
                                ${response.item.shape_name}
                                </td>
                                    <td>
                                        <select class="form-control" name="unit[]" id="unit">
                                            <option value="" selected>اختر الوحدة</option>
                                                    @foreach($data['unit_select'] as $unit)
                                                    <option value="{{$unit->value}}">{{$unit->name}}</option>
                                                    @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control form-control-sm" name="quantity[]" id="quantity_${response.item.id}" value="1"></td>
                                    <td><button class="btn btn-icon btn-danger btn-circle btn-sm remove-item" data-item-id="${response.item.id}" title="حذف"><i class="fa fa-close"></i></button></td>
                                </tr>
                            `);
                            if ($(`#tender-items option[value='${response.item.id}']`).length == 0) {
                                $('#tender-items').append(`<option value="${response.item.id}">${response.item.name}</option>`)
                            }

                            }else{
                                Swal.fire({
                                title: ' هذا الصنف موجود مسبقا ',
                                icon: 'warning',

                                showDenyButton: true,
                                confirmButtonText: 'زيادة عدد الكمية',
                                denyButtonText: `عدم التكرار`,
                                }).then((result) => {
                                    if (result.isConfirmed) {

                                        $(`#quantity_${response.item.id}`).val(parseInt($(`#quantity_${response.item.id}`).val())+1)

                                    }else{

                                    }

                                 })
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

                    },complete:function () {
                        $('#item_name').val(null).trigger('change');
                    }
                });
            }else{
                Swal.fire({
                    showCloseButton: true,
                    icon: 'error',
                    title: '',
                    text: 'اختر الصنف',
                    confirmButtonText: 'موافق'
                });
            }


        })
        $(document).on('click','.remove-item',function(e) {
            e.preventDefault()
            let item_id=$(this).data('item-id')
            let row_name=$(this).closest('tr').attr('class')
            $(`.${row_name}`).remove()
            $(`#items-pricing-table-body .${row_name}`).remove()
            $(`#tender-items option[value='${item_id}']`).each(function() {
                $(this).remove();
            });
        })

        $(document).on('click','.remove-duplicate-item ,.remove-citem',function(e) {
            e.preventDefault()
            let tr=$(this).closest('tr')


            tr.remove()
            if ($(e.target).hasClass("remove-duplicate-item")) {
                let it_id=$(this).attr('id');
               $("#sprice").keyup()

               if($(`#items-pricing-table-body tr.tr_${it_id}`).length==0){
                   $('#tender-pricing-table-body').find(`tr.tr_${it_id}`).remove()
               }

            }
        })
        $(document).on('click','button[name=next]',function(e){
            let current_fs = $(this).closest('fieldset');
            let next_fs=current_fs.next()
            let next_id=next_fs.attr('id');
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            current_fs.hide();
            if (next_id=='step4') {
                append_to_tender_pricing()
            }
            next_fs.show();
            window.scrollTo(0, 0);

        })
        $(document).on('click','button[name=previous]',function(e){
            let current_fs = $(this).closest('fieldset');
            let prev_fs=current_fs.prev()
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
			current_fs.hide();
			prev_fs.show();
			window.scrollTo(0, 0);
        })
        $(document).on('change','.tender_check',function(e) {
            // if ($(this).checked) {
            //     $(this).attr('checked',true)
            // }else{
            //     $(this).attr('checked',false)

            // }

            let tr=$(this).closest('tr')
            $tds = tr.find('td')
            $tds.eq(5).find("input[type='text']").keyup()
        })
        $(document).on('keyup','#sprice',function(e) {
            let tr=$(this).closest('tr')
            $tds = tr.find('td')
            let supplier=tr.find('#suppliers').val()
            let price = $(this).val()
            if (!check_numeric(price)) {
                Swal.fire({
                    showCloseButton: true,
                    icon: 'error',
                    title: 'يجب أن يكون السعر قيمة عددية',
                    confirmButtonText: 'موافق'
                })
            }
            if(price!=''&&check_numeric(price)&&supplier!=''){
                let item_id = tr.find("input[name='sitems[]']").val();
                let min_price=parseInt(price);
                let offset='';
                $(`#items-pricing-table-body tr.tr_${item_id}`).each(function () {
                    price_row=parseInt($(this).find('#sprice').val())
                    if (min_price=='') {
                        min_price=price_row;
                        offset=$(this).index()
                    }
                    else if (price_row<=min_price) {
                        min_price=price_row;
                        offset=$(this).index()
                    }
                })
                $(`#items-pricing-table-body tr.tr_${item_id}`).removeClass('bg-primary-o-30')
                if (offset!=='') {
                    let sr=$(`#items-pricing-table-body tr:eq(${offset})`)
                    sr.addClass('bg-primary-o-30')
                    // append_to_tender_pricing()
                }

            }

        })



        function getAllData(id){

            $.ajax({
                    url: '{{url("admin/tenders/tender/")}}/'+id,
                    type: "get",
                    success: function( response ) {
                        if(response.status==true){

                            clear_modal()

                            $('.view_edit').removeClass('d-none');
                            $('#progressbar li').css('width','10%');

                            // hidden

                            $("#client").html('').trigger('change');
                            let client = new Option(`${response.tender.client}`, `${response.tender.client_id}`, true, true);
                            $("#client").append(client).trigger('change');
                            $('#tender_no').val(response.tender.tender_no)
                            $('#guarantee_type').val(response.tender.guarantee_type)
                            $('#guarantee_rate').val(response.tender.guarantee_rate)
                            $('#guarantee_value').val(response.tender.guarantee_value)
                            $('#currency').val(response.tender.currency)
                            $('#new_input_currency').val(response.tender.currency)
                            $('#currency').change()
                            $('#guarantee_no').val(response.tender.guarantee_no)
                            $('#transfer_price').val(response.tender.transfer_price)
                            $('#tax').val(response.tender.tax)
                            $('#company_branch').val(response.tender.comany_branch)
                            $('#sector').val(response.tender.sector)
                            $('#representation_date').val(response.tender.representation_date)
                            $('#manager').val(response.tender.manager)
                            $('#tender_form #div_bid_status').show();
                            $('#tender_form #bid_status').val(response.tender.bid_status);
                            if(response.tender.guarantee_status==1){
                            $('#get_guarantee').prop('checked', true);
                            }
                            else if(response.tender.guarantee_status==0){
                                $('#get_guarantee').prop('checked', false);
                            }
                            // if(response.tender.bid_status==1){
                            // $('#bid_status').prop('checked', true);
                            // }
                            // else if(response.tender.bid_status==0){
                            //     $('#bid_status').prop('checked', false);
                            // }
                            $('.tender_file_div').html(`
                                <a data-fancybox="gallery" href="${response.tender.tender_file}">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            `)
                            $('.referral_file_div').html(`
                                <a data-fancybox="gallery" href="${response.tender.referral_file}">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            `)

                            if(response.tender.suppliers_prices_file!=null){
                            @can('tenders-view-suppliers-prices')
                            $('.tender_suppliers_prices').html(`
                                <a data-fancybox="gallery" href="${response.tender.suppliers_prices_file}">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            `)
                            @endcan
                            }
                            $('#receipt_date').val(response.tender.notification_receipt_date)
                            let item_name=[];
                            for (let i = 0; i < response.tender.items.length; i++) {
                                const item = response.tender.items[i];
                                item_name[0]=item.item_id;
                                item_name[1]="";
                                if(item.type==1){

                                    $('#items-table-body').append(`
                                        <tr class="tr_${item.item_id}"><input type="hidden" name="items[]" id="" value="${item.item_id}">
                                            <td>${item.item_no}</td>
                                            <td>${item.item}</td>
                                            <td>${item.shape_name}</td>
                                            <td>
                                                <select class="form-control" name="unit[]" id="unit">
                                                    <option value="" selected>اختر الوحدة</option>
                                                            @foreach($data['unit_select'] as $unit)
                                                            <option value="{{$unit->value}}" ${(item.unit == {{$unit->value}}) ? 'selected':''}>{{$unit->name}}</option>
                                                            @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm" name="quantity[]" id="quantity_${item.item_id}" value="${item.item_quantity}"></td>
                                            <td><button class="btn btn-icon btn-danger btn-circle btn-sm remove-item" data-item-id="${item.item_id}" title="حذف"><i class="fa fa-close"></i></button></td>
                                        </tr>
                                    `);
                                    if ($(`#tender-items option[value='${item.item_id}']`).length == 0) {
                                        $('#tender-items').append(`<option value="${item.item_id}">${item.item}</option>`)
                                    }
                                    if (item.item_price!=null||item.item_price!=0) {
                                        append_to_tender_pricing(item)
                                        $(`#tender-pricing-table-body .tr_${item.item_id}`).find(`#ten_prices`).trigger('keyup')
                                    }
                                }else if(item.type==2){
                                    let select='';
                                   $.each(response.tender.items_names, function(key, value) {
                                        if (key==item.item_id) {
                                            for (let i = 0; i < value.length; i++) {
                                                const element = value[i];
                                                let selected='';
                                                if (element.id==item.trade_name) {
                                                    selected="selected";
                                                }
                                                select+=`<option value="${element.id}" ${selected}>${element.trade_name}</option>`
                                            }
                                        }
                                    })




                                    $('#items-pricing-table-body').append(`
                                        <tr class="tr_${item.item_id}">
                                        <input type="hidden" name="sitems[]" id="" value="${item.item_id}">
                                        <td><button class="btn btn-icon btn-danger btn-circle btn-sm remove-duplicate-item mx-1" title="حذف" id="${item.item_id}"><i class="fa fa-close remove-duplicate-item" id="${item.item_id}"></i></button></td>
                                            <td id="item_no">${item.item_no}</td>
                                            <td id="item_name">${item.item}</td>
                                            <td width="20%">
                                                <select name="trade_names[]" id="trade_names">
                                                    <option value="" selected>اختر الاسم التجاري</option>
                                                      ${select}
                                                </select>
                                                <a id="add_new_trade_name"><i class="fa fa-plus btn btn-info btn-icon btn-circle"></i></a>
                                            </td>
                                            <td id="shape">${item.shape_name}</td>
                                            <td id="unit">${$(`#items-table-body tr.tr_${item.item_id}`).find('td').eq(3).find("select :selected").text()}</td>
                                            <td id="quantity">${$(`#items-table-body tr.tr_${item.item_id}`).find('td').eq(4).find("input[type='text']").val()}</td>

                                            <td>
                                                <select class="form-control" name="suppliers[]" id="suppliers">
                                                    <option value="" selected>اختر المورد</option>
                                                        @foreach($data['suppliers'] as $supplier)
                                                                <option value="{{$supplier->id}}" ${(item.supplier_id == {{$supplier->id}}) ? 'selected':''}>{{$supplier->ar_name}}</option>
                                                        @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm" name="sprice[]" id="sprice" value="${item.item_price}"></td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="durations[]" id="durations" value="${item.duration}">
                                            </td>
                                            <td><input style="width: 95px;" type="text" class="form-control datepicker" name="expired_at[]" id="expired_at[]" readonly="readonly" value="${item.expired_date}"></td>
                                            <td><input type="text" class="form-control form-control-sm" name="notes[]" id="notes" value="${(item.notes!=null)? item.notes:''}"></td>

                                        </tr>
                                    `);
                                   $(`#items-pricing-table-body .tr_${item.item_id}`).find(`#sprice`).keyup()

                                }

                            }

                            // let id=$(this).data('tender-id')
                            // let branch_id=$(this).data('branch-id')
                            // let branch_name=$(this).data('branch-name')

                            $('#branch_edit #tender_branch_name').text(response.tender.branch_name)
                            $('#branch_edit #to_company_branch').html(`
                            <option value="" selected disabled>اختر فرع الشركة</option>
                            @foreach($data['company_select'] as $company)
                                                <option value="{{$company->value}}">{{$company->name}}</option>
                                            @endforeach
                            `)
                            $('#branch_edit #to_company_branch').find(`option[value='${response.tender.comany_branch}']`).remove()
                            $('#branch_edit #tender_duplicate_id').val(response.tender.id)
                            $('#branch_edit #to-other-branch-form').trigger('reset')



                            $("#tender_form #users").val(null).trigger('change');

                            $("#tender_form #users").html(response.option);

                            //get_competitors_prices
                            $('#assesment_edit').html(response.assesment)

                            $('#citem_name').select2({
                                placeholder: 'اختر الصنف'
                            });
                            //get_accepted_items
                            $('#accepting_edit').html(response.accepting)
                            $('#item_name1').select2({
                                placeholder: 'اختر الصنف'
                            });
                            $('.accept-checkbox input[type=checkbox]').change()


                            //get_supplied_items
                            $('#supplied_edit').html(response.supplied_data)

                            $('.datepicker').datepicker({
                                rtl: true,
                                todayBtn: "linked",
                                clearBtn: true,
                                todayHighlight: true,

                            });


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
                        // fun();

                        $('.datepicker').datepicker({
                            rtl: true,
                            todayBtn: "linked",
                            clearBtn: true,
                            todayHighlight: true,

                        });
                    }
                });


        }

        $(document).on('click','.edit-tender',function (e) {
            e.preventDefault()
            var id = $(this).data('tender-id');
            $('#add-tender #hidden').val(id)
            $('#add-tender #tender_id').val(id)

            // generate-tender-pdf
            $('#add-tender .modal-title').text('تعديل المناقصة')
                $.ajax({
                    url: '{{url("admin/tenders/tender/")}}/'+id,
                    type: "get",
                    success: function( response ) {
                        if(response.status==true){

                            clear_modal()

                            $('.view_edit').removeClass('d-none');
                            $('#progressbar li').css('width','10%');

                            // hidden

                            $("#client").html('').trigger('change');
                            let client = new Option(`${response.tender.client}`, `${response.tender.client_id}`, true, true);
                            $("#client").append(client).trigger('change');
                            $('#tender_no').val(response.tender.tender_no)
                            $('#guarantee_type').val(response.tender.guarantee_type)
                            $('#guarantee_rate').val(response.tender.guarantee_rate)
                            $('#guarantee_value').val(response.tender.guarantee_value)
                            $('#currency').val(response.tender.currency)
                            $('#new_input_currency').val(response.tender.currency)
                            $('#currency').change()
                            $('#guarantee_no').val(response.tender.guarantee_no)
                            $('#transfer_price').val(response.tender.transfer_price)
                            $('#tax').val(response.tender.tax)
                            $('#company_branch').val(response.tender.comany_branch)
                            $('#sector').val(response.tender.sector)
                            $('#representation_date').val(response.tender.representation_date)
                            $('#manager').val(response.tender.manager)
                            $('#tender_form #div_bid_status').show();
                            $('#tender_form #bid_status').val(response.tender.bid_status);
                            if(response.tender.guarantee_status==1){
                            $('#get_guarantee').prop('checked', true);
                            }
                            else if(response.tender.guarantee_status==0){
                                $('#get_guarantee').prop('checked', false);
                            }
                            // if(response.tender.bid_status==1){
                            // $('#bid_status').prop('checked', true);
                            // }
                            // else if(response.tender.bid_status==0){
                            //     $('#bid_status').prop('checked', false);
                            // }
                            $('.tender_file_div').html(`
                                <a data-fancybox="gallery" href="${response.tender.tender_file}">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            `)
                            $('.referral_file_div').html(`
                                <a data-fancybox="gallery" href="${response.tender.referral_file}">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            `)

                            if(response.tender.suppliers_prices_file!=null){
                            @can('tenders-view-suppliers-prices')
                            $('.tender_suppliers_prices').html(`
                                <a data-fancybox="gallery" href="${response.tender.suppliers_prices_file}">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            `)
                            @endcan
                            }
                            $('#receipt_date').val(response.tender.notification_receipt_date)
                            let item_name=[];
                            for (let i = 0; i < response.tender.items.length; i++) {
                                const item = response.tender.items[i];
                                item_name[0]=item.item_id;
                                item_name[1]="";
                                if(item.type==1){

                                    $('#items-table-body').append(`
                                        <tr class="tr_${item.item_id}"><input type="hidden" name="items[]" id="" value="${item.item_id}">
                                            <td>${item.item_no}</td>
                                            <td>${item.item}</td>
                                            <td>${item.shape_name}</td>
                                            <td>
                                                <select class="form-control" name="unit[]" id="unit">
                                                    <option value="" selected>اختر الوحدة</option>
                                                            @foreach($data['unit_select'] as $unit)
                                                            <option value="{{$unit->value}}" ${(item.unit == {{$unit->value}}) ? 'selected':''}>{{$unit->name}}</option>
                                                            @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm" name="quantity[]" id="quantity_${item.item_id}" value="${item.item_quantity}"></td>
                                            <td><button class="btn btn-icon btn-danger btn-circle btn-sm remove-item" data-item-id="${item.item_id}" title="حذف"><i class="fa fa-close"></i></button></td>
                                        </tr>
                                    `);
                                    if ($(`#tender-items option[value='${item.item_id}']`).length == 0) {
                                        $('#tender-items').append(`<option value="${item.item_id}">${item.item}</option>`)
                                    }
                                    if (item.item_price!=null||item.item_price!=0) {
                                        append_to_tender_pricing(item)
                                        $(`#tender-pricing-table-body .tr_${item.item_id}`).find(`#ten_prices`).trigger('keyup')
                                    }
                                }else if(item.type==2){
                                    let select='';
                                   $.each(response.tender.items_names, function(key, value) {
                                        if (key==item.item_id) {
                                            for (let i = 0; i < value.length; i++) {
                                                const element = value[i];
                                                let selected='';
                                                if (element.id==item.trade_name) {
                                                    selected="selected";
                                                }
                                                select+=`<option value="${element.id}" ${selected}>${element.trade_name}</option>`
                                            }
                                        }
                                    })




                                    $('#items-pricing-table-body').append(`
                                        <tr class="tr_${item.item_id}">
                                        <input type="hidden" name="sitems[]" id="" value="${item.item_id}">
                                        <td><button class="btn btn-icon btn-danger btn-circle btn-sm remove-duplicate-item mx-1" title="حذف" id="${item.item_id}"><i class="fa fa-close remove-duplicate-item" id="${item.item_id}"></i></button></td>
                                            <td id="item_no">${item.item_no}</td>
                                            <td id="item_name">${item.item}</td>
                                            <td width="20%">
                                                <select name="trade_names[]" id="trade_names">
                                                    <option value="" selected>اختر الاسم التجاري</option>
                                                      ${select}
                                                </select>
                                                <a id="add_new_trade_name"><i class="fa fa-plus btn btn-info btn-icon btn-circle"></i></a>
                                            </td>
                                            <td id="shape">${item.shape_name}</td>
                                            <td id="unit">${$(`#items-table-body tr.tr_${item.item_id}`).find('td').eq(3).find("select :selected").text()}</td>
                                            <td id="quantity">${$(`#items-table-body tr.tr_${item.item_id}`).find('td').eq(4).find("input[type='text']").val()}</td>

                                            <td>
                                                <select class="form-control" name="suppliers[]" id="suppliers">
                                                    <option value="" selected>اختر المورد</option>
                                                        @foreach($data['suppliers'] as $supplier)
                                                                <option value="{{$supplier->id}}" ${(item.supplier_id == {{$supplier->id}}) ? 'selected':''}>{{$supplier->ar_name}}</option>
                                                        @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm" name="sprice[]" id="sprice" value="${item.item_price}"></td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="durations[]" id="durations" value="${item.duration}">
                                            </td>
                                            <td><input style="width: 95px;" type="text" class="form-control datepicker" name="expired_at[]" id="expired_at[]" readonly="readonly" value="${item.expired_date}"></td>
                                            <td><input type="text" class="form-control form-control-sm" name="notes[]" id="notes" value="${(item.notes!=null)? item.notes:''}"></td>

                                        </tr>
                                    `);
                                   $(`#items-pricing-table-body .tr_${item.item_id}`).find(`#sprice`).keyup()

                                }

                            }

                            // let id=$(this).data('tender-id')
                            // let branch_id=$(this).data('branch-id')
                            // let branch_name=$(this).data('branch-name')

                            $('#branch_edit #tender_branch_name').text(response.tender.branch_name)
                            $('#branch_edit #to_company_branch').html(`
                            <option value="" selected disabled>اختر فرع الشركة</option>
                            @foreach($data['company_select'] as $company)
                                                <option value="{{$company->value}}">{{$company->name}}</option>
                                            @endforeach
                            `)
                            $('#branch_edit #to_company_branch').find(`option[value='${response.tender.comany_branch}']`).remove()
                            $('#branch_edit #tender_duplicate_id').val(response.tender.id)
                            $('#branch_edit #to-other-branch-form').trigger('reset')



                            $("#tender_form #users").val(null).trigger('change');

                            $("#tender_form #users").html(response.option);

                            //get_competitors_prices
                            $('#assesment_edit').html(response.assesment)

                            $('#citem_name').select2({
                                placeholder: 'اختر الصنف'
                            });
                            //get_accepted_items
                            $('#accepting_edit').html(response.accepting)
                            $('#item_name1').select2({
                                placeholder: 'اختر الصنف'
                            });
                            $('.accept-checkbox input[type=checkbox]').change()


                            //get_supplied_items
                            $('#supplied_edit').html(response.supplied_data)

                            $('.datepicker').datepicker({
                                rtl: true,
                                todayBtn: "linked",
                                clearBtn: true,
                                todayHighlight: true,
                                // orientation: "top left",

                            });


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
                        // fun();

                        $('#add-tender').modal('show');
                        $('.datepicker').datepicker({
                            rtl: true,
                            todayBtn: "linked",
                            clearBtn: true,
                            todayHighlight: true,
                            // orientation: "top left",

                        });
                    }
                });
        })
        $(document).on('click','.asses-prices',function (e) {

            e.preventDefault()
            var id = $(this).data('tender-id');


            $.ajax({
                url: '{{url("admin/tenders/competitors/prices/")}}/'+id ,
                type: "get",
                success: function( response ) {
                    if(response.status==true)
                        $('#assesment_body').html(response.assesment)
                },
                error:function(response){

                },
                complete:function (response) {
                    $('#assesment-modal').modal('show')
                    $('#citem_name').select2({
                        placeholder: 'اختر الصنف'
                    });
                }

            })
        })
        $(document).on('click','.supply-tender-items',function (e) {
            e.preventDefault()
            var id = $(this).data('tender-id');

            $.ajax({
                url: '{{url("admin/tenders/supplied/items/")}}/'+id ,
                type: "get",
                success: function( response ) {
                    if(response.status==true)
                        $('.supplied-body #supply-items-modal .modal-body').html(response.supplied_data)
                },
                error:function(response){

                },
                complete:function (response) {
                    $('#supply-items-modal').modal('show')
                    $('#supply-items-modal .modal-title').text('توريد الأصناف')
                    $('.datepicker').datepicker({
                        rtl: true,
                        todayBtn: "linked",
                        clearBtn: true,
                        todayHighlight: true,
                        // orientation: "top left",

                    });

                }

            })
        })
        $(document).on('click','.accept-tender-items',function (e) {
            e.preventDefault()

            var id = $(this).data('tender-id');

            $.ajax({
                url: '{{url("admin/tenders/accepting/items/")}}/'+id ,
                type: "get",
                success: function( response ) {
                if(response.status==true)
                    $('.accepting-body').html(response.data)
                    // $("#table-container").empty().html(response.data);
                    $('#item_name1').select2({
                        placeholder: 'اختر الصنف'
                    });
                    $('.accept-checkbox input[type=checkbox]').change()
                },
                error:function(response){

                },
                complete:function (response) {
                    $('#accepting-items-modal').modal('show')

                }

            })
        })
        $(document).on('click','#add_competitor_item',function (e) {
            e.preventDefault()
            let item=$('#citem_name').select2('val');
            let currency_val=$('#new_input_currency').val();
            // alert('**2**');
            $.ajax({
                url: '{{url("admin/tenders/items/")}}/'+item,
                type: "get",
                success: function( response ) {
                    if(response.status==true){
                        $('#pricing-table-body .tr-no-data').remove()
                        $('#pricing-table-body').append(`
                            <tr class="tr_${response.item.id}"><input type="hidden" name="citems[]" id="" value="${response.item.id}">
                                <td>${response.item.name}</td>
                                <td><input type="text" class="form-control form-control-sm" name="cprices[]" value=""></td>
                                <td>
                                    <select class="form-control" name="currency_id[]" id="currency_id">
                                        <option value="" selected>اختر العملة</option>
                                            @foreach($data['currency_select'] as $currency)
                                                 <option value="{{$currency->value}}" ${(currency_val == {{$currency->value}}) ? 'selected':''}>{{$currency->name}}</option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="competitors[]" id="competitors">
                                        <option value="" selected>اختر المنافس</option>
                                            @foreach($data['competitors'] as $competitor)
                                                 <option value="{{$competitor->id}}">{{$competitor->name}}</option>
                                            @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm" name="note[]" value=""></td>
                                <td>
                                     <span class="switch awarded-checkbox">
                                        <label>
                                            <input type="checkbox" name="awarded[]" value="no" >
                                            <span></span>
                                        </label>
                                    </span>
                                </td>
                                <td>
                                <button class="btn btn-icon btn-danger btn-circle btn-sm remove-citem" data-item-id="${response.item.id}" title="حذف"><i class="fa fa-close"></i></button></td>
                            </tr>
                        `);



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

                },complete:function () {
                    $('#citem_name').val(null).trigger('change');

                }
            });
        })
        $(document).on('click','#save_pricing',function (e) {
            e.preventDefault()
            let form=new FormData($('#assesment_form_edit')[0])

            let awarded=[];

            $('.awarded-checkbox input[type=checkbox]').each(function () {
                if(this.checked==true){
                    awarded.push(1)
                }else{
                    awarded.push(0)
                }
            });
             form.append('awarded',awarded)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    url: '{{route("admin.tenders.competitors.prices.save")}}' ,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    data:form,
                    success: function( response ) {
                        if(response.status==true){
                            Swal.fire({
                                showCloseButton: true,
                                icon: 'success',
                                title:response.success,
                                confirmButtonText: 'موافق'
                            })
                            $('#assesment-modal').modal('hide')
                            console.log(response.data);
                            getAllData(response.data.id);
//
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
                    }
                });
        })
        $(document).on('click','#save_accepted_items',function (e) {
            e.preventDefault()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let form=new FormData($('#accepting-items-form')[0])
            let accepted=[];
            let priority=[];
            let items=[];

            $('.accept-checkbox input[type=checkbox]').each(function () {
                if(this.checked==true){
                    accepted.push(1)
                }else{
                    accepted.push(0)
                }
            });
            $('.priority-checkbox input[type=checkbox]').each(function () {
                if(this.checked==true){
                    priority.push(1)
                }else{
                    priority.push(0)
                }
            });
            let id=$('#accepting-items-form #tender_id').val();

            $('#accepting-items-form .items').each(function () {

                    items.push($(this).val())

            });
            form.append('items',items)

            form.append('tender_id',id)

            form.append('accepted',accepted)
            form.append('priority',priority)
            $.ajax({
                    url: '{{route("admin.tenders.accepted.items.save")}}' ,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    data:form ,
                    success: function( response ) {
                        if(response.status==true){
                            Swal.fire({
                                showCloseButton: true,
                                icon: 'success',
                                title:response.success,
                                confirmButtonText: 'موافق'
                            })
                            $('#accepting-items-modal').modal('hide')
                            getAllData(response.data.id);

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
                    }
                });
        })
        $(document).on('click','.delete-tender',function(){
                var id = $(this).data('tender-id');
                Swal.fire({
                    title: 'هل أنت متأكد من حذف المناقصة',
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
                            url: '{{route("admin.tenders.delete")}}' ,
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
        $(document).on('click','.show-tender , .row_tender_no ',function (e) {
            e.preventDefault()
            // console.log( event.target.className)
            // if (condition) {

            // }
            var id = $(this).data('tender-id');

            $.ajax({
                url: '{{url("admin/tenders/show/")}}/'+id ,
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
        })
        $(document).on('change','#suppliers',function () {
            let supplier_select=$(this)
            let supplier_val=supplier_select.val()
            let tr=$(this).closest('tr')
            let trade_name=tr.find('#trade_names').val()
            let row_name=$(this).closest('tr').attr('class')

            let row_idx=$("#items-pricing-table-body tr").index(tr)
            if (supplier_val!='') {
                tr.find('#sprice').keyup()
            }
            if (trade_name!='' && supplier_val!='') {
                $(`#items-pricing-table-body tr.${row_name}`).each(function (tr) {
                    let idx=$(this).index()
                    if (row_idx!=idx && $(this).find('#suppliers').val()== supplier_val && $(this).find('#trade_names').val() == trade_name) {
                        Swal.fire({
                            icon: 'warning',
                            title:'تنبيه ',
                            html:'تم تكرار الصنف لنفس المنافس أكثر من مرة ',

                            confirmButtonText: 'موافق'
                        })
                        // supplier_select.val('')
                    }
                })
            }
        })
        $(document).on('change','#competitors',function () {
            let competitor_select=$(this)
            let competitor_val=competitor_select.val()
            let tr=$(this).closest('tr')
            let row_name=$(this).closest('tr').attr('class')
            let row_idx=$("#pricing-table-body tr").index(tr)

            $(`#pricing-table-body tr.${row_name}`).each(function (tr) {
                let idx=$(this).index()
                if (row_idx!=idx && $(this).find('#competitors').val()== competitor_val) {
                    Swal.fire({
                        showCloseButton: true,
                        icon: 'warning',
                        title:'تنبيه ',
                        html:'تم تكرار الصنف لنفس المنافس أكثر من مرة ',

                        confirmButtonText: 'موافق'
                    })
                    // competitor_select.val('')
                }
            })
        })
        $(document).on('click','.remove-supplied-item',function (e) {
            e.preventDefault()
            let sid=$(this).data('supplied-item');
            let tender_id=$('#tender_i').val()
            Swal.fire({
                    title: 'هل أنت متأكد من الحذف؟',
                    showDenyButton: true,
                    confirmButtonText: 'نعم',
                    denyButtonText: `لا`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '{{route("admin.tenders.delete.supplied.item")}}' ,
                            type: "POST",
                            data: {id:sid},
                            success: function( response ) {
                                if(response.status==true){
                                    Swal.fire({
                                        showCloseButton: true,
                                        icon: 'success',
                                        title: 'نجاح الحذف.',
                                        text:response.success,
                                        confirmButtonText: 'موافق'
                                    })
                                    load_supplied_items_table(tender_id)
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
        });
        $(document).on('click','#add_item_supply',function (e) {
            e.preventDefault()

            let tender_id=$('#tender_i').val()
            let sitem=$('#supply_item').val()
            let item_quantity=$('#item_quantity').val()
            let sdate=$('#sdate').val()
            if(sitem=='' ||item_quantity=='' ||sdate=='' ){
                Swal.fire({
                    showCloseButton: true,
                    icon: 'error',
                    title: 'يحب إدخال جميع القيم',
                    confirmButtonText: 'موافق'
                })
            }
            if(item_quantity!=''&&!check_numeric(item_quantity)){
                Swal.fire({
                    showCloseButton: true,
                    icon: 'error',
                    title: 'يحب أن تكون الكمية رقم',
                    confirmButtonText: 'موافق'
                })
            }
            if(sitem!='' &&item_quantity!='' &&sdate!='' && check_numeric(item_quantity)){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route("admin.tenders.supplied.items.save")}}' ,
                    type: "POST",
                    data: {tender_id:tender_id,item:sitem,quantity:item_quantity,date:sdate},
                    success: function( response ) {
                        if (response.status==false) {
                            Swal.fire({
                                showCloseButton: true,
                                icon: 'error',
                                title:'',
                                text: response.error,
                                confirmButtonText: 'موافق'
                            })
                        }else if(response.status==true){

                            load_supplied_items_table(tender_id)
                          load_data_table()

                        }
                    },
                    error:function(response){

                    }
                });
            }

        })
        $(document).on('change','#trade_names',function () {
            let name_select=$(this)
            let name=name_select.val()
            let tr=$(this).closest('tr')
            let supplier=tr.find('#suppliers').val()
            let row_name=$(this).closest('tr').attr('class')
            let row_idx=$("#items-pricing-table-body tr").index(tr)
            if (name!='' && supplier!='') {
                $(`#items-pricing-table-body tr.${row_name}`).each(function (tr) {
                let idx=$(this).index()
                if (row_idx!=idx && $(this).find('#suppliers').val()== supplier && $(this).find('#trade_names').val() == name) {
                    Swal.fire({
                        showCloseButton: true,
                        icon: 'error',
                        title:'لا يمكن تكرار الصنف بنفس الاسم التجاري لنفس المورد أكثر من مرة ',
                        confirmButtonText: 'موافق'
                    })
                    name_select.val('')
                }
            })
            }

        })
        $(document).on('change','.accept-checkbox input[type=checkbox]',function () {
            // alert( $(this).is(":checked"))
            let tr=$(this).closest('tr');
            if(this.checked==true){

                $(".priority-checkbox input[type=checkbox]").prop("disabled", false);
                tr.addClass('bg-success-o-50')
            }else{
                $(".priority-checkbox input[type=checkbox]").prop("disabled", true);
                $(".priority-checkbox input[type=checkbox]").prop("checked", false);
                tr.removeClass('bg-success-o-50')

            }
        })
        $(document).on('focusout','#ten_prices',function () {
            let tender_price=parseFloat($(this).val())
            let tr=$(this).closest('tr');
            let supplier_price=parseFloat(tr.find('#supplier_price').text())
            if (tender_price!='') {
                if (tender_price<supplier_price) {
                Swal.fire({
                    showCloseButton: true,
                    icon: 'error',
                    title: '',
                    text: 'سعر المناقصة المضاف أقل من سعر الشراء من المورد',
                    confirmButtonText: 'موافق'
                })
                // $(this).val('')
                }else{
                    tr.find('#profit').text(compute_profit(tender_price,supplier_price))
                    tr.find('#total').text(calc_total(tr.find('#quantity_value').text(),tender_price))
                    compute_overall_total();
                }
            }

        });
        $(document).on('change','#currency',function () {
            if ($(this).val()!='') {
                $('#tender_curn').text($("#currency :selected").text());
            }
        })
        $(document).on('change','#items-table-body #unit',function () {
            let tr=$(this).closest('tr').attr('class');
            let val='';
            if ($(this).val()!='') {
                val=$(`#unit :selected`).text();
            }
            $(`#items-pricing-table-body .${tr} #unit`).text(val)
        });
        $(document).on('change','#items-table-body #quantity_1',function () {
            let tr=$(this).closest('tr').attr('class');
            let val='';
            if ($(this).val()!='') {
                val=$(this).val();
            }
            $(`#items-pricing-table-body .${tr} #quantity`).text(val)
        });
        $(document).on('click','.generate-tender-pdf',function (e) {
            e.preventDefault()
            var id = $(this).data('tender-id');
            $('#t_id').val(id)
            $('.note_div').hide()
            $('#generate-tender-pdf-form').trigger('reset')
            $('#generate-tender-pdf-modal').modal('show')
        })
        $(document).on('change','.notes_switch input[type=checkbox]',function () {
            if(this.checked==true){
                $('.note_div').show()
            }else{
                $('.note_div').hide()

            }
        })

        $(document).on('change','#accepting-items-form #item_name1',function () {
            let item_id=$(this).val();
            let id=$('#accepting-items-form #tender_id').val();

            if(id != 'undefined'){
                id=$('#tender_form').find('#hidden').val();
            }

            $.ajax({
                url: '{{url("admin/tenders/accepting/items/")}}/'+id ,
                type: "get",
                data:{
                    item_id:item_id
                },
                success: function( response ) {
                if(response.status==true)
                    // $('.accepting-body').html(response.data)
                    $("#accepting_edit #table-container").empty().html(response.data);

                    $('#item_name1').select2({
                        placeholder: 'اختر الصنف'
                    });
                    // console.log(response.item_id);
                    // $('#accepting-items-form #item_name1').val(response.item_id);
                    // $('#item_name1').val(response.item_id).trigger('change');

                    $('.accept-checkbox input[type=checkbox]').change();
                    // $('#accepting-items-modal').modal('show');

                },
            })

        });

        $(document).on('submit','#generate-tender-pdf-form',function (e) {
            e.preventDefault();
            let notes='';
            let input_note=$('#pdf_notes').val();
            let tender_id=$('#t_id').val();
            console.log(tender_id);

            if(tender_id == ''){
                tender_id=$('#tender_form').find('#hidden').val();
            }

            if($('.notes_switch #notes_status').prop("checked") == true){
                notes=input_note;
            }
            var query = {
                    t_id:tender_id,
                    notes:notes
                }
            var url = "/admin/tenders/generate/pdf?" + $.param(query)
            window.open(url, "_blank")
            // window.location = url;

        })
        $(document).on('keypress','#ten_prices',function(e) {
            if (e.which == 13) {
                $(this).closest('tr').next().find('input#ten_prices').focus();
                e.preventDefault();
            }
        });
        $(document).on('keypress','input[name="quantity[]"]',function(e) {
            if (e.which == 13) {
                $(this).closest('tr').next().find('input[name="quantity[]"]').focus();
                e.preventDefault();
            }
        });
        $(document).on('keypress','input[name="sprice[]"]',function(e) {
            if (e.which == 13) {
                // alert('hhhh')
                $(this).closest('tr').next().find('input[name="sprice[]"]').focus();
                e.preventDefault();
            }
        });
        $(document).on('keypress','input[name="durations[]"]',function(e) {
            if (e.which == 13) {
                // alert('hhhh')
                $(this).closest('tr').next().find('input[name="durations[]"]').focus();
                e.preventDefault();
            }
        });
        $(document).on('keypress','input[name="notes[]"]',function(e) {
            if (e.which == 13) {
                // alert('hhhh')
                $(this).closest('tr').next().find('input[name="notes[]"]').focus();
                e.preventDefault();
            }
        });
        $(document).on('keypress','input[name="ten_notes[]"]',function(e) {
            if (e.which == 13) {
                // alert('hhhh')
                $(this).closest('tr').next().find('input[name="ten_notes[]"]').focus();
                e.preventDefault();
            }
        });
        $(document).on('click','.add_to_branch',function (e) {
            e.preventDefault()
            // alert('click')
            let id=$(this).data('tender-id')
            let branch_id=$(this).data('branch-id')
            let branch_name=$(this).data('branch-name')
            $('#tender_branch_name').text(branch_name)
            $('#to_company_branch').html(`
            <option value="" selected disabled>اختر فرع الشركة</option>
            @foreach($data['company_select'] as $company)
                                <option value="{{$company->value}}">{{$company->name}}</option>
                            @endforeach
            `)
            $('#to_company_branch').find(`option[value='${branch_id}']`).remove()
            $('#tender_duplicate_id').val(id)
            $('#to-other-branch-form').trigger('reset')
            $('#to-other-branch-modal').modal('show')
        });
        $(document).on('submit','#branch_edit #to-other-branch-form',function (e) {

            // alert(123);
            e.preventDefault()
            $.ajax({
                    url: '{{route("admin.tenders.duplicate.tender")}}' ,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    data:new FormData(this) ,
                    success: function( response ) {
                        if(response.status==true){
                            Swal.fire({
                                showCloseButton: true,
                                icon: 'success',
                                title:response.success,
                                confirmButtonText: 'موافق'
                            })
                            // $('#to-other-branch-modal').modal('hide')
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
                    }
                });


        })

        $(document).on('click','#add_new_trade_name',function (e) {
            e.preventDefault()
            let tr=$(this).closest('tr');
            let tr_idx=$(`#items-pricing-table-body tr`).index(tr);
            let item_id=tr.find('input[name="sitems[]"]').val();
            // console.log("tr_idx "+tr_idx)
            $('#add-new-trade-name-modal').find('#to_item_id').val(item_id)
            $('#add-new-trade-name-modal').find('#to_tr_idx').val(tr_idx)
            $('#add-new-trade-form').trigger('reset');
            $('#add-new-trade-name-modal').modal('show')
        })
        $(document).on('submit','#add-new-trade-form',function (e) {
            let tr_idx=$(this).find('#to_tr_idx').val()
            let tr_id=$(this).find('#to_item_id').val()
            e.preventDefault()
            $.ajax({
                    url: '{{route("admin.tenders.trade.name")}}' ,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    data:new FormData(this) ,
                    success: function( response ) {
                        console.log(response)
                        if(response.status==true){
                            Swal.fire({
                                showCloseButton: true,
                                icon: 'success',
                                title:response.success,
                                confirmButtonText: 'موافق'
                            })
                            $('#add-new-trade-name-modal').modal('hide')
                            let select=$(`#items-pricing-table-body .tr_${tr_id}`).find('#trade_names');
                            select.append(new Option(`${response.data['name']}`,`${response.data['id']}`));
                            console.log($(`#items-pricing-table-body .tr_${tr_id}`).eq(tr_idx))
                            $(`#items-pricing-table-body tr`).eq(tr_idx)
                            .find('#trade_names').val(response.data['id']);
                            // load_data_table()
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
                    }
                });
        })
        $(document).on('click','#add_client_btn',function (e) {
           add_action()
        })
        $('#client-form').validate({
            // rules:{
            //     ar_name:{
            //         required: true,
            //     },
            //     en_name:{
            //         required: true,
            //     },
            //     email:{
            //         required: true,
            //         email:true
            //     },
            //     mobile:{
            //         required: true,
            //     },
            //     phone:{
            //         required: true,
            //     },
            //     address:{
            //         required: true,
            //     },
            //     licensed_operating_no:{
            //         required: true,
            //     },

            // },
            // messages: {
            //     ar_name:{
            //         required: "يجب إدخال الاسم بالعربي",
            //     },
            //     en_name:{
            //         required: "يجب إدخال الاسم بالانجليزي",
            //     },
            //     email:{
            //         required: "يجب إدخال البريد الالكتروني ",
            //         email:"يجب إدخال بريد الكتروني صحيح"
            //     },
            //     mobile:{
            //         required: "يجب إدخال رقم الجوال",
            //     },
            //     phone:{
            //         required: "يجب إدخال رقم الهاتف",
            //     },
            //     address:{
            //         required: "يجب إدخال العنوان",
            //     },
            //     licensed_operating_no:{
            //         required: "يجب إدخال رقم التشغيل المرخص",
            //     },
            // },
            submitHandler:function(event){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let hidden=$('#add-client #hidden').val();
                if (hidden==0) {
            $.ajax({
                url: '{{route("admin.clients.store")}}' ,
                type: "POST",
                data: $('#client-form').serialize(),
                success: function( response ) {
                    if(response.status==true){
                        $("#client").html('').trigger('change');
                        let client = new Option(`${response.client.name}`, `${response.client.id}`, true, true);
                        $("#client").append(client).trigger('change');

                        // load_data_table()
                        Swal.fire({
                            showCloseButton: true,
                            icon: 'success',
                            title: 'نجاح الإضافة.',
                            text:response.success,
                            confirmButtonText: 'موافق'
                        })
                        $('#client-form').trigger("reset");
                        $('#add-client').modal('hide');

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
            }
        })


    })
    function calc_total(quantity,price) {
        let total=0;
        if (isNaN(quantity)||isNaN(price)) {
            return total;
        }
        total= parseFloat(quantity)*parseFloat(price)
        return total.toFixed(2);
    }

    function check_numeric(input) {
        return $.isNumeric(input)
    }
    function append_to_tender_pricing(item='') {

        let lowest_items= $('#items-pricing-table-body tr.bg-primary-o-30')
               let pricing_items= $('#tender-pricing-table-body tr.tender_item')
               if (lowest_items.length>0) {
                   if (pricing_items.length==0) {
                        let table='';
                        lowest_items.each(function() {
                            let it_id=$(this).find("input[name='sitems[]']").val()
                            let it_no=$(this).find("#item_no").text()
                            let it_name=$(this).find("#item_name").text()
                            let it_tname=$(this).find("#trade_names :selected").val()
                            let it_shape=$(this).find("#shape").html()
                            let it_unit=$(this).find("#unit").text()
                            let it_quantity=$(this).find("#quantity").text()
                            let it_supplier=$(this).find("#suppliers :selected").text()
                            let it_price=$(this).find("#sprice").val()
                            let duration=$(this).find("#durations").val()
                            let expired=$(this).find("input[name='expired_at[]']").val()
                             table+=`
                            <tr class="tr_${it_id} tender_item">
                            <input type="hidden" name="pitems[]" id="" value="${it_id}">
                            <td>${it_no}</td>
                            <td>${it_name}</td>
                            <td id="it_trade_name">${it_tname}</td>
                            <td id="shape">${it_shape}</td>
                            <td>${it_unit}</td>
                            <td id="quantity_value">${it_quantity}</td>
                            <td id="supplier_name">${it_supplier}</td>
                            <td id="supplier_price">${it_price}</td>
                            <td id="profit"></td>
                            <td><input type="text" name="ten_prices[]" id="ten_prices" class="form-control"></td>
                            <td id="total">${calc_total(parseFloat(it_quantity),parseFloat(it_price))}</td>
                            <td id="duration">${duration}</td>
                            <td id="expired">${expired}</td>
                            <td><input type="text" name="ten_notes[]" id="ten_notes" class="form-control"></td>
                            </tr>
                            `
                        })

                        $('#tender-pricing-table-body').append(table)
                        compute_overall_total();

                   }else{
                        lowest_items.each(function() {
                            let prev_tr=$(this);
                            let it_id=$(this).find("input[name='sitems[]']").val()
                            if ($('#tender-pricing-table-body').find(`tr.tr_${it_id}`).length==0) {
                                let table=""
                                let it_no=$(this).find("#item_no").text()
                            let it_name=$(this).find("#item_name").text()
                            let it_tname=$(this).find("#trade_names :selected").val()
                            let it_shape=$(this).find("#shape").html()
                            let it_unit=$(this).find("#unit").text()
                            let it_quantity=$(this).find("#quantity").text()
                            let it_supplier=$(this).find("#suppliers :selected").text()
                            let it_price=$(this).find("#sprice").val()
                            let duration=$(this).find("#durations").val()
                            let expired=$(this).find("input[name='expired_at[]']").val()
                             table+=`
                            <tr class="tr_${it_id} tender_item">
                            <input type="hidden" name="pitems[]" id="" value="${it_id}">
                            <td>${it_no}</td>
                            <td>${it_name}</td>
                            <td id="it_trade_name">${it_tname}</td>
                            <td id="shape">${it_shape}</td>
                            <td>${it_unit}</td>
                            <td id="quantity_value">${it_quantity}</td>
                            <td id="supplier_name">${it_supplier}</td>
                            <td id="supplier_price">${it_price}</td>
                            <td id="profit"></td>
                            <td><input type="text" name="ten_prices[]" id="ten_prices" class="form-control"></td>
                            <td id="total">${calc_total(parseFloat(it_quantity),parseFloat(0))}</td>
                            <td id="duration">${duration}</td>
                            <td id="expired">${expired}</td>
                            <td><input type="text" name="ten_notes[]" id="ten_notes" class="form-control"></td>
                            </tr>
                            `

                            $('#tender-pricing-table-body').append(table)
                            compute_overall_total();

                            }else{

                                let it_shape=prev_tr.find("#shape").html()
                                let it_price=prev_tr.find("#sprice").val()
                                let it_quantity=prev_tr.find("#quantity").text()
                                let it_supplier=prev_tr.find("#suppliers :selected").text()
                                let it_trade_name=prev_tr.find("#trade_names :selected").text()
                                let it_durations=prev_tr.find("#durations").val()
                                let it_expired_at=prev_tr.find("input[name='expired_at[]']").val()

                                $('#tender-pricing-table-body').find(`tr.tr_${it_id}`).each(function() {

                                    let price= $(this).find('#ten_prices').val()
                                    $(this).find('#supplier_price').text(it_price)
                                    let supplier_price= $(this).find('#supplier_price').text()

                                    $(this).find('#quantity_value').text(it_quantity)
                                    $(this).find('#shape').html(it_shape)
                                    $(this).find('#supplier_name').text(it_supplier)
                                    $(this).find('#it_trade_name').text(it_trade_name)
                                    $(this).find('#duration').text(it_durations)
                                    $(this).find('#expired').text(it_expired_at)
                                    $(this).find('#profit').text(compute_profit(price,supplier_price))

                                    $(this).find('#total').text(calc_total(parseFloat($(this).find('#quantity_value').text()),price))
                                    compute_overall_total();


                                })


                            }
                        })
                   }

               }else{
                   if (item!='') {

                   let table=`
                            <tr class="tr_${item.item_id} tender_item">
                            <input type="hidden" name="pitems[]" id="" value="${item.item_id}">
                            <td>${item.item_no}</td>
                            <td>${item.item}</td>
                            <td id="it_trade_name"></td>
                            <td id="shape"></td>
                            <td>${item.unit_name}</td>
                            <td id="quantity_value">${item.item_quantity}</td>
                            <td id="supplier_name"></td>
                            <td id="supplier_price"></td>
                            <td id="profit"></td>
                            <td><input type="text" name="ten_prices[]" id="ten_prices" class="form-control" value="${item.item_price}"></td>
                            <td id="total">${calc_total(parseFloat(item.item_quantity),parseFloat(item.item_price))}</td>
                            <td id="duration"></td>
                            <td id="expired"></td>
                            <td><input type="text" name="ten_notes[]" id="ten_notes" class="form-control" value="${(item.notes!=null)? item.notes : ''}"></td>
                            </tr>
                            `
                            $('#tender-pricing-table-body').append(table)
                        // $(`#tender-pricing-table-body .tr_${item.item_id} #ten_prices`).keyup();
                        compute_overall_total();

                   }else{
                    $('.tender-pricing-table-body').html('')
                   }
               }
    }
    function compute_profit(tender_price,supplier_price) {
        let profit=0;
        if (isNaN(tender_price)||isNaN(supplier_price)) {
            return profit;
        }
        let diff_price=parseFloat(tender_price)-parseFloat(supplier_price);
        diff_price/=supplier_price;
        profit=diff_price*100;
        return profit.toFixed(2);
    }
    function compute_overall_total() {
        let sum=0;
        $("#tender-pricing-table-body #total").each(function(){
            if ($(this).text()!='') {
                sum += parseFloat($(this).text());
            }
        });
        $('#tender-pricing-table-footer #total').text(sum.toFixed(2));
    }
</script>
<script>
    //
    $(document).on('click','.add_active',function(e){

            let next_id=$(this).data('step')
            $("#progressbar li").removeClass("active");
            $(this).addClass("active");
            $("fieldset").css("display",'none');
            $("fieldset."+next_id).css("display",'block');
            if (next_id=='step4') {append_to_tender_pricing()}
            window.scrollTo(0, 0);

        })
</script>
<script>
         $(document).on('click','.check_main',function(){
            var check = $(this).is(':checked');
            $(".check_sub").prop('checked', check);
        });
</script>
<script>
    $(document).on('click','#order_delet_btn' ,function () {



        var array = [];
        var add_msg = "";
        var add_roll = "";
        Swal.fire({
            title: "هل أنت متاكد من  حذف المناقصات المحددة",
            text: "",
            allowOutsideClick: true,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            closeOnConfirm: 'Yes',
            closeOnCancel: 'Yes',
            confirmButtonText: 'نعم',
            cancelButtonText: 'لا',
            }).then(function(e) {
                if(e.value){
                                var i = 0;
                        $(".check_sub:checked").each(function (){
                                i = i + 1;
                            var id =$(this).attr('data-id');
                                array.push([id]);
                                // console.log(array);
                            if(i == 20){
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                url: "{{route("admin.tenders.delete_check")}}",
                                    type: "POST",
                                    dataType: "JSON",
                                    data: {array:array},
                                    success: function (data) {
                                    if(data.data == 1){
                                        Swal.fire({
                                                    title: "",
                                                    text: data.success,
                                                    type: "success",
                                                    showCancelButton: false,
                                                    confirmButtonColor: "#DD6B55",
                                                    confirmButtonText: "Ok",
                                                    cancelButtonText: "Cancel",
                                                    closeOnConfirm: true,
                                                    closeOnCancel: true
                                                });
                                                $(".check_sub").prop('checked', false);
                                                $(".check_main").prop('checked', false);
                                        }else{
                                            Swal.fire({
                                                    title: "",
                                                    text: "حدث خطا لم تتم عملية حذف المناقصات الحددة",
                                                    type: "error",
                                                    showCancelButton: false,
                                                    confirmButtonColor: "#DD6B55",
                                                    confirmButtonText: "Ok",
                                                    cancelButtonText: "Cancel",
                                                    closeOnConfirm: true,
                                                    closeOnCancel: true
                                                });
                                    }

                                    }
                                });
                                        i = 0;
                                        array = [];
                            }
                        });

    /*********/
                            if(array.length > 0){
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    url: "{{route("admin.tenders.delete_check")}}",
                                    type: "POST",
                                    dataType: "JSON",
                                    data: {array:array},
                                    success: function (data) {
                                        if(data.data == 1){
                                            Swal.fire({
                                                    title: "",
                                                    text:data.success,
                                                    type: "success",
                                                    showCancelButton: false,
                                                    confirmButtonColor: "#DD6B55",
                                                    confirmButtonText: "Ok",
                                                    cancelButtonText: "Cancel",
                                                    closeOnConfirm: true,
                                                    closeOnCancel: true
                                                });
                                                $(".check_sub").prop('checked', false);
                                                $(".check_main").prop('checked', false);
                                        }else{
                                            Swal.fire({
                                                    title: "",
                                                    text: "حدث خطا لم تتم عملية حذف المناقصات الحددة",
                                                    type: "error",
                                                    showCancelButton: false,
                                                    confirmButtonColor: "#DD6B55",
                                                    confirmButtonText: "Ok",
                                                    cancelButtonText: "Cancel",
                                                    closeOnConfirm: true,
                                                    closeOnCancel: true
                                                });
                                    }

                                    }
                                });
                                }

                    load_data_table();
                }
            });


});
</script>
<script>

//
$(document).on('change','#citem_name',function(e) {
    $('#add_competitor_item').click();
})

$(document).on('change','#item_name',function(e) {

    let item_id=$(this).val();

    if(item_id != null){
        $('#add_item').click();
    }
})

</script>
@endsection

