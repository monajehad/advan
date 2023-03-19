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
     
   
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">رقم المناقصة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> فرع الشركة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">اسم الصنف </th>
        @if ($c_items) 
            @foreach ($c_items as $c) 
               <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;background-color:{{$c->color}}">{{$c->c_name}}</th>
            @endforeach
        @endif
   
    </tr>
    @if(count($data)>0)
        @php 
                $i=0;

        @endphp
     
    @forelse($data as $key => $item)

         @php 
            $i++;
        
     
        @endphp
        <tr>
          
            <td border="1"  style="text-align:center;font-size:10px;;">
                {{$item->tender_no}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->branch_name}}
            </td>
            <td border="1"style="text-align:center;font-size:10px;">
                {{$item->item_name}}
            </td>
            @if ($c_items) 
                @foreach ($c_items as $c) 
                    @if ($c->tender_id==$item->tender_id && $c->item_id==$item->item_id) 
                        <td border="1"  style="text-align:center;font-size:10px;background-color:{{$c->color}}">{{$c->item_price}}</td>

                    @else
                        <td  border="1"style="text-align:center;font-size:10px;background-color:{{$c->color}}"></td>
                    @endif
                @endforeach
            @endif
           
       
           
        </tr>
    @endforeach
    @else
    <tr style='text-align:center;'>
        <td  border="1" style="text-align:center;font-size:10px;line-height: 300%; font-weight:bold;" colspan="3">       لا يوجد أسعار ل  {{$item_name}}  لدى المنافسين</td>
    </tr>
    @endif 
</table>

