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
    <tr >
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">#</th>

        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">المناقصة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> المؤسسة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> فرع الشركة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">اسم الصنف </th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> الاسم التجاري</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> الوحدة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> المورد</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> سعر الشراء</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> الكمية</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> الكمية الموردة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">  الكمية المتبقية</th>
       
    
    </tr>
    @if(count($tender_items)>0)
        @php 
                $i=0;

        @endphp
     
    @forelse($tenders as $key => $tender)
    @forelse($tender_items as $k =>  $item)

         @php 
            $i++;
          
     
        @endphp
        <tr>
            <td border="1"  style="text-align:center;font-size:10px;;">
                {{$i}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;;">
                {{$tender->tender_no}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->client_name}}
            </td>
            <td border="1"style="text-align:center;font-size:10px;">
                {{$tender->branch_name}}
            </td>

         
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$item->item}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->trade_name}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->unit_name}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->supplier_name}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->supplier_price}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->item_quantity}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->supplied_quantity}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->remain_quantity}}
            </td>
           
        </tr>
        @endforeach

    @endforeach
    @else
    @endif 
</table>

