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
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">اسم الصنف</th>
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الكمية</th>

        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">السعر</th>
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الوحدة</th>
     
      
   
    </tr>
    @php 
    $i=0;

@endphp
     
    @forelse( $competitorsItems as $citem)

       
            <tr>
             
                <td border="1"  style="text-align:center;font-size:10px;">
                    {{++$i}}
                </td>
                <td border="1" style="text-align:center;font-size:10px;">
                    {{$citem->item}}
                </td>
                <td border="1"style="text-align:center;font-size:10px;">
                    {{$citem->item_price}}
                </td>
                <td border="1"  style="text-align:center;font-size:10px;">
                    {{$citem->curreny_name}}
                </td>
                <td border="1"  style="text-align:center;font-size:10px;">
                    {{$citem->competitor}}
                </td>
                <td border="1"  style="text-align:center;font-size:10px;">
                    {{$citem->note}}
                </td>
            
                
            
            </tr>
    @endforeach
  
</table>

