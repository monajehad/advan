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

        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> تاريخ تقديم المناقصة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">اسم الصنف </th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> الاسم التجاري</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> المورد</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> سعر المورد</th>

    
    </tr>
    @if(count($tenders)>0)
        @php 
                $i=0;

        @endphp
     
    @forelse($tenders as $key => $tender)
    @forelse($tender_items as $k =>  $item)

         @php 
            $i++;
            if (!empty($item->supplier_price)) {
                        if (array_key_exists($item->id,$min_prices) && $min_prices["$item->id"]==$item->it) {
                            $color="yellow !important";
                        }else{
                         $color="unset";
                         }
                    }else{
                        $color="unset";
                    }
     
        @endphp
        <tr style='background-color:{{$color}};'>
          
            <td border="1"  style="text-align:center;font-size:10px;;">
                {{$item->tender_no}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->client}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$item->branch_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$item->representation_date}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->item_name}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->trade_name}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->supplier}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->supplier_price}}
            </td>
           
        </tr>
        @endforeach

    @endforeach
    @else
    @endif 
</table>

