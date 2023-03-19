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
        <th border="1" width="7%"style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">رقم المناقصة</th>
        <th border="1" width="10%"style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> المؤسسة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> فرع الشركة</th>
        <th border="1"  width="15%"style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">اسم الصنف</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">كمية المناقصة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">سعر المناقصة</th>
        <th border="1" width="5%" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> العملة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">المورد</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">سعر المورد</th>
        <th border="1" width="7%" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">نتيجة الترسية</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الكمية الموردة</th>
    </tr>
    @if(count($tenders)>0)
        @php 
                $i=0;
            
            $min_prices_items=$tenders->map(function($data,$key){
                return[
                    'tender_id'=>$key,
                    'it'=>$data->where('supplier_price', $data->min('supplier_price'))->pluck('it')->first(),
                ];
            })->toArray();
            $min_prices=array_column($min_prices_items, 'it','tender_id');
            
        @endphp
     
    @forelse($tenders as $key => $tender)
    @forelse($tender as  $k =>  $item)

         @php 
            $i++;
            $supplied_quantity='';
            $accept_bg="";
            if (!empty($item->supplier_price)) {
                if (array_key_exists($item->id,$min_prices) && $min_prices["$item->id"]==$item->it) {
                    $color="yellow !important";
                    $accepted= $item->accepted_item;
                    $supplied_quantity=$item->supplied_quantity;

                }else{
                    $color="unset";
                    $accepted='جاري';
                    $supplied_quantity='';

                }
            }else{
                $color="unset";
                $accepted= $item->accepted_item;
            }
            $accept_bg="";
                if ($item->accepted_item==1) {
                $item->accepted_item="نعم";
                $accept_bg="#68c168";
            }elseif ($item->accepted_item==0) {
                $item->accepted_item="جاري";

            }
     
        @endphp
        <tr>
            <td border="1"  style="text-align:center;font-size:10px;line-height: 300%;">
                {{$item->tender_no}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->client}}
            </td>
            <td border="1"style="text-align:center;font-size:10px">
                {{$item->branch_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px">
                {{$item->item_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px">
                {{$item->tender_quantity}}
            </td>
            <td border="1" style="text-align:center;font-size:10px">
                {{$item->tender_price}}
            </td>
            <td border="1" width="5%" style="text-align:center;font-size:10px">
                {{$item->currency_name}}
            </td>
            <td border="1" style="text-align:center;font-size:10px">
                {{$item->supplier}}
            </td>
            <td border="1" style="text-align:center;font-size:10px">
                {{$item->supplier_price}}
            </td>
            <td border="1" style='text-align:center;font-size:10px;'>
                {{$item->accepted_item}}
            </td>
            <td border="1" style="text-align:center;font-size:10px">
                {{$supplied_quantity}}
            </td>
        </tr>
    @endforeach
    @endforeach  
    @else
    <tr style='text-align:center;'>
        <td  border="1" style="text-align:center;font-size:10px;line-height: 300%; font-weight:bold;" colspan="12">   غير موجود بأي مناقصة  {{$item_name}}</td>
    </tr>
    @endif 
</table>

