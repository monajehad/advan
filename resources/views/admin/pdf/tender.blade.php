

<table cellpadding="0">
    <tr>
    <td><br></td>
    </tr>
</table>

<table>
    <tr>
        <td  style="font-size:14px;font-weight:bold;text-align:center;line-height: 34px">عرض أسعار {{$tender->id}}</td>
    </tr>
</table>
<table cellpadding="0">
    <tr>
    <td><br></td>
    </tr>
</table>
<table cellpadding="0" width="100%" border="1">
    <tr>
    <th border="1" width="40%" style="line-height: 20px;font-weight:bold;text-align:center;font-size:12px"> زبون {{$tender->client_id}}</th>
    </tr>
    <tr>
        <td border="1" width="40%" style="text-align:right;font-size:12px">
            <span style="font-weight:bold;line-height: 18px"> {{$tender->client}}</span><br>
            <span style="line-height:18px"> {{$tender->client_address}} </span><br>
            <span style="line-height: 18px"> {{$tender->client_mobile}} </span>
        </td>
    </tr>
</table>
<table cellpadding="0">
    <tr>
    <td><br></td>
    </tr>
</table>

<table cellpadding="0" width="100%">
    <tr>
    <th border="1" width="10%" style="font-weight:bold;text-align:center;font-size:10px">صنف</th>
    <th border="1" width="25%" style="font-weight:bold;text-align:center;font-size:10px">بيان</th>
    <th border="1" width="21%" style="font-weight:bold;text-align:center;font-size:10px">وحدة</th>
    <th border="1" width="21%" style="font-weight:bold;text-align:center;font-size:10px">سعر</th>
    <th border="1" width="10%" style="font-weight:bold;text-align:center;font-size:10px">كمية</th>
    <th border="1" width="10%" style="font-weight:bold;text-align:center;font-size:10px">المجموع</th>
</tr>
@php 
    $total=0;
    $i=0;
    @endphp
    @forelse($tender->items as $item)
    @php 
    
        $sub_total=floatval($item->tender_quantity)*floatval($item->tender_price);
        $total+=$sub_total;
        @endphp
    <tr>
        <td border="1" width="10%" style="text-align:center;font-size:10px">
        {{$item->item_id}}
        </td>
        <td border="1" width="25%" style="text-align:center;font-size:10px">
            {{$item->item}}
        </td>
        <td border="1" width="21%" style="text-align:center;font-size:10px">
            {{$item->unit_name}}
        </td>
        <td border="1" width="21%" style="text-align:center;font-size:10px">
            {{$item->tender_price}}
        </td>
        <td border="1" width="10%" style="text-align:center;font-size:12px">
        {{$item->tender_quantity}}
        </td>
        <td border="1" width="10%" style="text-align:center;font-size:12px">
        {{$sub_total}}
        </td>
    </tr>
@endforeach
<tr>
        <td colspan="5" style="text-align: left;font-size:10px;font-weight:bold;"> المجموع </td>
        <td border="1" style="text-align: center;font-weight:bold;font-size:10px">{{$total}}</td>
    </tr>
    <!-- <tr>
        <td colspan="5" style="text-align: left;font-size:12px;font-weight:bold;">ضريبة  </td>
        <td border="1" style="text-align: center;font-weight:bold;font-size:12px"></td>
    </tr> -->
    
</table>
@if($tender->notes)
<table cellpadding="0">
    <tr>
    <td><br></td>
    </tr>
</table>
<table cellpadding="0">
<tr>
    <th border="1" width="40%" style="line-height: 20px;font-weight:bold;text-align:center;font-size:12px">ملاحظة</th>
    </tr>
    <tr>
        <td border="1" width="40%" style="text-align:right;font-size:12px">
            <span style="line-height: 20px;"> {{$tender->notes}}</span><br>
        </td>
    </tr>
</table>
@endif
