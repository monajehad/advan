<table>
    <tr>
        <td  style="font-size:14px;font-weight:bold;text-align:center;line-height: 34px">{{$filename}}</td>
    </tr>
</table>
<table cellpadding="0">
    <tr>
    <td><br></td>
    </tr>
</table>




<table cellpadding="0" width="100%">

    @if(count($tenders)>0)
    @php 
    $i=0;
    
@endphp
     
    @forelse($tenders as $key => $tender)

         @php 
            $i++;
            $row_color='';
                if($tender->guarantee_status==1)
                    $tender->guarantee_status="نعم"; 
                elseif($tender->guarantee_status==0)
                    $tender->guarantee_status="لا"; 
                if($tender->bid_status==1){
                    $tender->bid_status="جاري الترسية"; 
                }elseif($tender->bid_status==0){
                    $tender->bid_status="لم يتم الترسية"; 
                }elseif($tender->bid_status==2){
                    $tender->bid_status="تم الترسية"; 
                }
                if($tender->complete_status==1){
                    $row_color='#6cff742b';

                    $tender->complete_status="نعم"; 
                }elseif($tender->complete_status==0){
                $row_color='unset';

                    $tender->complete_status="لا";
                }
     
             
        @endphp
        <tr>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">#</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">المناقصة</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">فرع الشركة</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">القطاع</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">العميل</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">نوع الكفالة</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">نسبة الكفالة</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">قيمة الكفالة</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">رقم كفالة دخول العطاء</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الضريبة</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">العملة</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">سعر التحويل</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الشخص المسؤول</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">تاريخ تقديم المناقصة</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">تاريخ استلام أمر التوريد</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">تم استرداد الكفالة؟</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">حالة العطاء</th>
            <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">المناقصة منجزة؟</th>
        </tr>
        <tr>
            <td border="1"  style="text-align:center;font-size:10px;;">
                {{$i}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;;">
                {{$tender->tender_no}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->branch_name}}
            </td>
            <td border="1"style="text-align:center;font-size:10px;">
                {{$tender->sector_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$client_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$tender->guarantee_type_name}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->guarantee_rate}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->guarantee_value}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->guarantee_no}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->tax_name}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->curreny_name}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->transfer_price}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->manager}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->representation_date}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->notification_receipt_date}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->guarantee_status}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->bid_status}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->complete_status}}
            </td>
            
        </tr>
        <tr>
            <td border="1" colspan="18" style="text-align:center;font-size:10px;background-color:blue;line-height: 30px; color: rgb(73, 63, 63);">بيانات أصناف المناقصة</td>
        </tr> 
        <br>
     
        <tr>
            <td    colspan="18">
                
            
           <table cellpadding="0" width="100%">
                <tr>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">#</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">اسم الصنف</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الاسم التجاري</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الشكل</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الكمية</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">سعر المناقصة</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الوحدة</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">المورد</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> سعر المورد</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">نتيجة الترسية</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> تاريخ الانتهاء</th>
                    <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> مدة التوريد بالأيام</th>
                </tr>
                @php
                    $x=0;
                @endphp
                @forelse($tender_items as $key => $value)
                    @if($value->tender_id==$tender->id)

                        @php 
                        
                            $x++;
                        
                                $accept_color="";
                                if ( $value->accepted_item==1) {
                                    $value->accepted_item="نعم";
                                    $accept_color="#68c168";
                                }elseif ($value->accepted_item==0) {
                                    $value->accepted_item="جاري";
                                    $accept_color="";
                                }
                            
                        @endphp
                        <tr>
                            <td border="1"  style="text-align:center;font-size:10px;;">
                                {{$x}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->item}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->trade_name}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->shape_name}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->tender_quantity}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->tender_price}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->unit_name}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->supplier_name}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->supplier_price}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->accepted_item}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->expired_date}}
                            </td>
                            <td border="1" style="text-align:center;font-size:10px;">
                                {{$value->duration}}
                            </td>
                        </tr>

                    @endif
                
                @endforeach
            </table>
            </td>
        </tr>  
        <br>
        <br>
    @endforeach
    @else
    @endif 
</table>

