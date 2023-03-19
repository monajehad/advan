<style>
    .table th, .table td{
        font-size: 11px;
        text-align: center;
    }
</style>


<table>
    <tr>
        <td  style="font-size:14px;font-weight:bold;text-align:center;line-height: 34px">مناقصة
         <span style="dir:ltr;text-decoration: underline;">{{$tender->tender_no}}</span>
        </td>
    </tr>
   
</table>
<table cellpadding="0">
    <tr>
    <td><br></td>
    </tr>
    <tr>
        <td><br></td>
        </tr>
</table>
<table>
    <tr>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">اسم العميل : </span> {{$tender->client}}</td>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">فرع الشركة : </span> {{$tender->branch_name}} </td>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">القطاع : </span> {{$tender->sector_name}}  </td>
    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">نوع الكفالة : </span> {{$tender->guarantee_type_name}}</td>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">نسبة الكفالة : </span> {{$tender->guarantee_rate .'%'}}</td>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">تاريخ تقديم المناقصة : </span> {{$tender->representation_date}}</td>

    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">الضريبة : </span> {{$tender->tax_name}}</td>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">العملة : </span> {{$tender->curreny_name}}</td>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">سعر التحويل : </span> {{$tender->transfer_price}}</td>

    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">المسؤول : </span> {{$tender->manager}}</td>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">رقم كفالة دخول العطاء : </span> {{$tender->guarantee_no}}</td>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">تاريخ استلام أمر التوريد:</span> {{$tender->notification_receipt_date}}</td>

    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">الكفالة : </span>
            @if($tender->guarantee_status==1)
            مستردة
            @elseif($tender->guarantee_status==0)
                  غير مستردة
            @endif 
        </td>
        <td width="33%" style="font-size:13px;text-align:right"><span style="font-weight:bold;">حالة العطاء : </span>
            @if($tender->bid_status==1)
            تم الترسية  
            @elseif($tender->bid_status==0)
           لم يتم الترسية 
            @endif 
        </td>
    </tr>
</table>
<table cellpadding="0">
    <tr>
    <td><br></td>
    </tr>
</table>
@if($tender->notes)
<table cellpadding="0">
    <tr>
    <td style="font-size:15px;text-align:right"><span style="font-weight:bold;">الملاحظات :</span></td>
    </tr>
    <tr>
      <td width="2%"></td>
    <td width="96%" style="font-size:13px;text-align:right;text-align: justify;">{{$tender->notes}}</td>
    <td width="2%"></td>
</tr>
</table>
@endif
<br pageBreak="true">
<table>
    <tr>
        <td  style="font-size:14px;font-weight:bold;text-align:right;line-height: 34px">أصناف المناقصة
        </td>
    </tr>
   
</table>
<table cellpadding="3" width="100%" border="1">
    <tr>
    <th border="1" width="3%" style="font-weight:bold;text-align:center;font-size:12px">#</th>
    <th border="1" width="15%" style="font-weight:bold;text-align:center;font-size:12px">رقم الصنف</th>
    <th border="1" width="15%" style="font-weight:bold;text-align:center;font-size:12px">اسم الصنف</th>
    <th border="1" width="20%" style="font-weight:bold;text-align:center;font-size:12px">الاسم التجاري</th>
    <th border="1" width="10%" style="font-weight:bold;text-align:center;font-size:12px">الشكل</th>
    <th border="1" width="10%" style="font-weight:bold;text-align:center;font-size:12px">الوحدة</th>
    <th border="1" width="5%" style="font-weight:bold;text-align:center;font-size:12px">الكمية</th>
    <th border="1" width="5%" style="font-weight:bold;text-align:center;font-size:12px">السعر</th>
    <th border="1" width="5%" style="font-weight:bold;text-align:center;font-size:12px">الإجمالي</th>
    <th border="1" width="6%" style="font-weight:bold;text-align:center;font-size:12px">مدة التوريد</th>
    <th border="1" width="6%" style="font-weight:bold;text-align:center;font-size:12px">تاريخ الانتهاء</th>

</tr>
@php 
    $total=0;
    $i=0;
    @endphp
    @forelse($tender->items as $item)
    <tr>
        <td border="1" width="3%" style="text-align:center;font-size:12px">{{++$i}}</td>
        <td border="1" width="15%" style="text-align:center;font-size:12px">{{$item->item_no}}</td>
        <td border="1" width="15%" style="text-align:center;font-size:12px">{{$item->item}}</td>
        <td border="1" width="20%" style="text-align:center;font-size:12px">{{$item->trade_name}}</td>
        <td border="1" width="10%" style="text-align:center">
        {{$item->shape_name}}
        </td>
        <td border="1" width="10%" style="text-align:center;font-size:12px">{{$item->unit_name}}</td>
        <td border="1" width="5%" style="text-align:center;font-size:12px">{{$item->tender_quantity}}</td>
        <td border="1" width="5%" style="text-align:center;font-size:12px">{{$item->tender_price}}</td>
        @php 
        $sub_total=floatval($item->tender_quantity)*floatval($item->tender_price);
        $total+=$sub_total;
        @endphp
        <td border="1" width="5%" style="text-align:center;font-size:12px">{{$sub_total}}</td>
        <td border="1" width="6%" style="text-align:center;font-size:12px">{{$item->duration}}</td>
        <td border="1" width="6%" style="text-align:center;font-size:12px">{{$item->expired_date}}</td>
</tr>
    @empty
    <tr>
    <td colspan="12">لا يوجد أصناف لهذه المناقصة</td>
   </tr>
    @endforelse
    
    <tr>
        <td colspan="10" style="text-align: left;font-size:12px;font-weight:bold;">المجموع</td>
        <td style="text-align: center;font-weight:bold;font-size:12px">{{$total}}</td>
    </tr>
</table>
@if(!empty($tender->notes))

<table cellpadding="3">
    <tr>
        <td  style="font-size:14px;text-align:right;line-height: 34px">
        <span style="font-weight:bold">الملاحظات</span>
        <br>
        {{$tender->notes}}
        </td>
    </tr>

   
</table>
@endif