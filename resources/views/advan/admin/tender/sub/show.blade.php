<div class="modal fade" id="show-tender" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">عرض المناقصة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            @if(isset($tender))

            <div class="modal-body card card-custom">
				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label font18">مناقصة رقم: <span class="label label-lg label-info label-inline mr-2"> {{$tender->tender_no}}</span></h3>
					</div>
					<div class="card-toolbar">
						<ul class="nav nav-light-success nav-bold nav-pills">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_4_1">
									<span class="nav-text">بيانات المناقصة</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_2">
									<span class="nav-text">أصناف المناقصة</span>
								</a>
							</li>
                            {{-- @can('item-price-offers') --}}

                            <li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_3">
									<span class="nav-text">عروض أسعار الأصناف</span>
								</a>
							</li>
                            {{-- @endcan --}}
                            <!-- <li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_4">
									<span class="nav-text">بيانات إضافية</span>
								</a>
							</li> -->
                            {{-- @can('tenders-competitor') --}}

                            <li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_4">
									<span class="nav-text">تقييم الأسعار</span>
								</a>
							</li>
                            {{-- @endcan --}}







                            {{-- @can('tenders-accept-items') --}}
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_5">
                                    <span class="nav-text">الترسية</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('tenders-supply') --}}
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_6">
                                    <span class="nav-text">التوريد</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- <li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_7">
									<span class="nav-text"> تكرار المناقصه </span>
								</a>
							</li> --}}
                            {{-- @can('tenders-print-pdf')  --}}
                            <li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_8">
									<span class="nav-text">إنشاء PDF</span>
								</a>
							</li>
                            {{-- @endcan --}}

						</ul>
					</div>
				</div>
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane fade show active" id="kt_tab_pane_4_1" role="tabpanel" aria-labelledby="kt_tab_pane_4_1">
                            <div class="row mx-6">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <table class="table table-bordered text-center">
                                        <tr>
                                            <th>العميل</th>
                                            <th>فرع الشركة</th>
                                            <th>نوع القطاع</th>
                                            <th>تاريخ تقديم المناقصة</th>



                                        </tr>
                                        <tr>
                                            <td>{{$tender->client}}</td>
                                            <td>{{$tender->branch_name}}</td>
                                            <td>{{$tender->sector_name}}</td>
                                            <td>{{$tender->representation_date}}</td>
                                        </tr>
                                        <tr>
                                            <th>نوع الكفالة</th>
                                            <th>نسبة الكفالة</th>
                                            <th>قيمة الكفالة</th>
                                            <th>العملة</th>
                                        </tr>
                                        <tr>
                                            <td>{{$tender->guarantee_type_name}}</td>
                                            <td>{{$tender->guarantee_rate}}</td>
                                            <td>{{$tender->guarantee_value}}</td>
                                            <td>{{$tender->curreny_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>الضريبة</th>
                                            <th>سعر التحويل</th>
                                            <th>ملف المناقصة</th>
                                            <th>تم استرداد الكفالة ؟</th>

                                        </tr>
                                        <tr>
                                        <td>{{$tender->tax_name}}</td>
                                        <td>{{$tender->transfer_price}}</td>


                                            <td>
                                                <a data-fancybox="gallery" href="{{$tender->tender_file}}">
                                                    <i class="fa fa-file"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if($tender->guarantee_status==1)
                                                    <span class="label label-lg label-success label-inline"> نعم</span>
                                                @elseif($tender->guarantee_status==0)
                                                    <span class="label label-lg label-danger label-inline"> لا</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>ملف الاحالة / الترسية</th>
                                            <th colspan="3"></th>


                                        </tr>
                                        <tr>
                                            <td>
                                                <a data-fancybox="gallery" href="{{$tender->referral_file}}">
                                                    <i class="fa fa-file"></i>
                                                </a>
                                            </td>
                                            <td colspan="3">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="4">بيانات إضافية</th>
                                        </tr>
                                        <tr>
                                            <th>الشخص المسؤول</th>
                                            <th>رقم كفالة دخول العطاء</th>
                                            <th>صورة الكفالة</th>
                                            <th>تاريخ استلام أمر التوريد</th>

                                        </tr>
                                        <tr>
                                            <td>{{$tender->manager}}</td>
                                            <td>{{$tender->guarantee_no}}</td>
                                            <td>
                                                @if($tender->guarantee_file)
                                                <a data-fancybox="gallery" href="{{asset($tender->guarantee_file)}}">
                                                    <i class="fa fa-picture-o"></i>
                                                </a>
                                                @endif
                                            </td>
                                            <td>{{$tender->notification_receipt_date}}</td>


                                        </tr>
                                        <tr>
                                            <th>ملف أمر التوريد</th>
                                            <th>حالة العطاء</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if($tender->notification_file)
                                                    <a data-fancybox="gallery" href="{{$tender->notification_file}}">
                                                        <i class="fa fa-file"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($tender->bid_status==1)
                                                <span class="label label-lg label-danger label-inline" style="background-color: #bdbec5;"> جاري الترسية  </span>

                                                @elseif($tender->bid_status==2)
                                                <span class="label label-lg label-success label-inline"> تم الترسية</span>

                                                @elseif($tender->bid_status==0)
                                                <span class="label label-lg label-danger label-inline"> لم يتم الترسية </span>

                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
						<div class="tab-pane fade" id="kt_tab_pane_4_2" role="tabpanel" aria-labelledby="kt_tab_pane_4_2">
                            <div class="row mx-6">
                                <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table" >
                                    <table class="table table-bordered items-table text-center">
                                        <thead>
                                            <tr>
                                                <th>رقم الصنف</th>
                                                <th>اسم الصنف</th>
                                                <th>الوحدة</th>
                                                <th>الكمية</th>
                                                <th>السعر</th>
                                                <th>نتيجة الترسية</th>
                                                <th>ملاحظات</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($tender->items as $item)
                                                @if($item->type==1)
                                                    <tr class="{{($item->accepted_item==1)? 'bg-success-o-50':''}}">
                                                        <td>{{$item->item_no}}</td>
                                                        <td>{{$item->item}}</td>
                                                        <td>{{$item->unit_name}}</td>
                                                        <td>{{$item->item_quantity}}</td>
                                                        <td>{{$item->item_price}}</td>
                                                        <td>
                                                            @if($item->accepted_item==1)
                                                                <span class="label label-lg label-success label-inline"> نعم</span>
                                                            @elseif($item->accepted_item==0)
                                                                <span class="label label-lg label-danger label-inline"> جاري</span>
                                                            @endif
                                                        </td>
                                                        <td>{{($item->notes!=null)? $item->notes:''}}</td>

                                                    </tr>
                                                @endif

                                            @empty
                                            <tr>
                                                <td class="text-muted text-center font-size-lg" colspan="7">لا يوجد أصناف للمناقصة</td>
                                            </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- @can('item-price-offers') --}}
					    <div class="tab-pane fade" id="kt_tab_pane_4_3" role="tabpanel" aria-labelledby="kt_tab_pane_4_3">
                            <div class="row mx-6 my-3">
                                <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table">
                                    <table class="table table-bordered items-pricing-table text-center">
                                        <thead>
                                            <tr>
                                                <th>رقم الصنف</th>
                                                <th>اسم الصنف</th>
                                                <th>الاسم التجاري</th>
                                                <th>المورد</th>
                                                <th>السعر</th>
                                                <th>تاريخ الانتهاء</th>
                                                <th>مدة التوريد بالأيام</th>
                                                <th>ملاحظات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($tender->items as $item)
                                                @if($item->type==2)
                                                    <tr class="@if((array_key_exists($item->item_id,$tender->min_suppliers_prices)) && $item->supplier_id== ($tender->min_suppliers_prices)["$item->item_id"] )  {{'bg-primary-o-30'}} @endif">
                                                        <td>{{$item->item_no}}</td>
                                                        <td>{{$item->item}}</td>
                                                        <td>{{$item->trade_item_name}}</td>
                                                        <td>{{$item->supplier_name}}</td>
                                                        <td>{{$item->item_price}}</td>
                                                        <td>{{$item->expired_date}}</td>
                                                        <td>{{$item->duration}}</td>
                                                        <td>{{($item->notes!=null)? $item->notes:''}}</td>

                                                    </tr>
                                                @endif
                                                @if($item->type==1)
                                                    <tr class="bg-primary-o-30">
                                                        <td>{{$item->item_no}}</td>
                                                        <td>{{$item->item}}</td>
                                                        <td>{{$item->trade_item_name}}</td>
                                                        <td>-</td>
                                                        <td>{{$item->item_price}}</td>
                                                        <td>{{$item->expired_date}}</td>
                                                        <td>{{$item->duration}}</td>
                                                        <td>{{($item->notes!=null)? $item->notes:''}}</td>

                                                    </tr>
                                                @endif

                                            @empty
                                            <tr>
                                                <td class="text-muted text-center font-size-lg" colspan="8">لا يوجد أصناف للمناقصة</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- @endcan --}}
                        <div class="tab-pane fade" id="kt_tab_pane_4_4" role="tabpanel" aria-labelledby="kt_tab_pane_4_4">
                            <div class="row mx-6" >
                                    <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>الرقم</th>
                                                    <th>الصنف</th>
                                                    <th>الوحدة</th>
                                                    <th>الكمية الكلية</th>



                                                    {{-- @foreach($tender->items->where('type',1) as $item)
                                                        @foreach($tender->compatitors as $c)
                                                            @php
                                                                $data="";
                                                                $items_data=$tender->competitorsItems->where('competitor_id',$c->id)->where('item_id',$item->item_id);
                                                            @endphp
                                                            @if($items_data)
                                                                @foreach($items_data as $it)
                                                                    @php $data.=$it->item_price.' '; @endphp
                                                                @endforeach

                                                                @if($data != '')
                                                                    <th style="background-color:{{$c->color}}">
                                                                        {{$c->name}}
                                                                    </th>

                                                                @else


                                                                @endif
                                                            @else
                                                            @endif
                                                        @endforeach
                                                    @endforeach --}}

                                                    @foreach($tender->competitorsItems as $item)

                                                        @foreach($tender->compatitors as $c)
                                                            @if($item->competitor_id == $c->id)
                                                            <th style="background-color:{{$c->color}}">
                                                                {{$c->name}}
                                                            </th>
                                                            @else

                                                            @endif
                                                        @endforeach
                                                    @endforeach


                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $count = count($tender->competitorsItems);
                                                    $v=0;
                                                @endphp
                                                @foreach($tender->items->where('type',1) as $item)
                                                <tr>
                                                    <td>{{$item->item_no}}</td>
                                                    <td>{{$item->item}}</td>
                                                    <td>{{$item->unit_name}}</td>
                                                    <td>{{$item->item_quantity}}</td>


                                                        {{-- @foreach($tender->compatitors as $c)
                                                            @php
                                                                $b=0;
                                                            @endphp
                                                            @php
                                                            $data="";
                                                            $items_data="";
                                                                $items_data=$tender->competitorsItems->where('competitor_id',$c->id)->where('item_id',$item->item_id);
                                                            @endphp
                                                            @if(count($items_data) > 0)
                                                                @foreach($items_data as $it)
                                                                    @php $data.=$it->item_price.' '; @endphp
                                                                @endforeach
                                                                @if($data != '')
                                                                    <td style="background-color:{{$c->color}}">
                                                                        {{ $data}}
                                                                    </td>
                                                                @else
                                                                @endif
                                                            @else
                                                            @endif
                                                        @endforeach --}}

                                                            @foreach($tender->competitorsItems as $item1)
                                                                @foreach($tender->compatitors as $c)
                                                                        @if($item1->competitor_id == $c->id)
                                                                            @if($item1->item_id == $item->item_id)
                                                                            <th style="background-color:{{$c->color}}">
                                                                                {{$item1->item_price}} {{$item1->curreny_name}}
                                                                                <br>
                                                                                ({{$item1->note}})
                                                                            </th>
                                                                            @else
                                                                            <td>
                                                                                -
                                                                            </td>

                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                            @endforeach





                                                    </tr>
                                                @endforeach



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>

                        {{-- @can('tenders-accept-items') --}}
                            <div class="tab-pane fade" id="kt_tab_pane_4_5" role="tabpanel" aria-labelledby="kt_tab_pane_4_5">
                                <div class="row mx-6" >
                                    <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table table-responsive">
                                        <table class="table table-bordered items-pricing-table text-center">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>اسم الصنف</th>
                                                    <th> الترسية </th>
                                                    <th>الأولوية</th>
                                                </tr>
                                            </thead>
                                            <tbody id="pricing-table-body">
                                                @forelse($tenderItems as $item)
                                                    <tr class="{{($item->accepted_item==1)? 'bg-success-o-50':''}}">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$item->item}}</td>
                                                        <td>
                                                            {{($item->accepted_item==1)? ' نعم ':' لا '}}
                                                        </td>
                                                        <td>
                                                            {{($item->has_priority==1)? ' نعم ':' لا '}}

                                                            {{-- <span class="switch priority-checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="priorities[]" id="priorities" value="yes" {{($item->has_priority==1)? 'checked':''}} disabled>
                                                                    <span></span>
                                                                </label>
                                                            </span> --}}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="tr-no-data">
                                                        <td class="text-muted text-center font-size-lg" colspan="3">لا يوجد أصناف للمناقصة</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        {{-- @endcan --}}
                        {{-- @can('tenders-supply') --}}
                            <div class="tab-pane fade" id="kt_tab_pane_4_6" role="tabpanel" aria-labelledby="kt_tab_pane_4_6">
                                <div class="row mx-6" >
                                    <div class="col-md-12 col-lg-12 col-sm-12 scrollable-table table-responsive">
                                        <table class="table table-bordered supplied-items-table text-center">
                                            <thead>
                                                <tr>
                                                    <th>اسم الصنف</th>
                                                    <th>الكمية</th>
                                                    <th>تاريخ التوريد</th>
                                                </tr>
                                            </thead>
                                            <tbody id="supplied-items-body">
                                                @forelse($supplied_items as $sitem)
                                                    <tr>
                                                        <td>{{$sitem->item}}</td>
                                                        <td>{{$sitem->quantity}}</td>
                                                        <td>{{$sitem->date}}</td>
                                                    </tr>
                                                @empty
                                                    <tr class="tr-no-data">
                                                        <td class="text-muted text-center font-size-lg" colspan="4">لا يوجد أصناف تم توريدها</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    2
                                </div>
                            </div>
                        {{-- @endcan --}}
                        {{-- <div class="tab-pane fade" id="kt_tab_pane_4_7" role="tabpanel" aria-labelledby="kt_tab_pane_4_7">
                            <div class="row mx-6" >
                                3
                            </div>
                        </div> --}}
                        {{-- @can('tenders-print-pdf')  --}}
                            <div class="tab-pane fade" id="kt_tab_pane_4_8" role="tabpanel" aria-labelledby="kt_tab_pane_4_8">
                                <div class="row mx-6" >
                                    <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                                        <button type="button" class="btn btn-sm btn-danger generate-tender-pdf"  data-tender-id="{{$tender->id}}">إنشاء PDF</button>
                                    </div>
                                </div>
                            </div>
                        {{-- @endcan --}}






					</div>
				</div>

            </div>
            @endif
        </div>
    </div>
</div>

