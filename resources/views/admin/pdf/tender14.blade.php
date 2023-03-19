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
    <tr>

       
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">#</th>

        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">رقم الصنف</th>
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> اسم الصنف</th>
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> الكمية</th>

        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">السعر</th>
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الوحدة</th>
     
      
   
    </tr>
    @php 
    $i=0;

@endphp
     
    @forelse( $tender->items as $key => $value)

        @if ($value->type==1 && $value->accepted_item==1) 
       
            <tr>
                <td border="1"  style="text-align:center;font-size:10px;">
                    {{++$i}}
                </td>
                <td border="1" style="text-align:center;font-size:10px;">
                    {{$value->item_no}}
                </td>
                <td border="1"style="text-align:center;font-size:10px;">
                    {{$value->item}}
                </td>
                <td border="1"  style="text-align:center;font-size:10px;">
                    {{$value->item_quantity}}
                </td>
                <td border="1"  style="text-align:center;font-size:10px;">
                    {{$value->item_price}}
                </td>
                <td border="1"  style="text-align:center;font-size:10px;">
                    {{$value->unit_name}}
                </td>
            
                
            
            </tr>
        @endif
    @endforeach
  
</table>

