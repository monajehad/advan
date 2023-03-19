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
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">رقم المناقصة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> المؤسسة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> فرع الشركة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">اسم الصنف </th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> كمية المناقصة </th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> الكمية الموردة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> توريد كلي / جزئي ؟</th>
    </tr>
    @if(count($tenders)>0)
        @php 
                $i=0;

        @endphp
     
    @forelse($tenders as $key => $tender)

         @php 
            $i++;
            $supply_type="";
                    $color="";
                    if ($tender->tender_quantity>$tender->supplied_quantity && $tender->supplied_quantity !=0) {
                        $supply_type="جزئي";
                        $color="yellow";
                    }else  if ($tender->tender_quantity==$tender->supplied_quantity) {
                        $supply_type="كلي";
                        $color="green";
                    }
        @endphp
        <tr>
          
            <td border="1"  style="text-align:center;font-size:10px;;line-height: 300%;">
                {{$tender->tender_no}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;line-height: 300%;">
                {{$tender->client}}
            </td>
            <td border="1"style="text-align:center;font-size:10px;line-height: 300%;">
                {{$tender->branch_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;line-height: 300%;">
                {{$tender->item_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$tender->tender_quantity}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;line-height: 300%;">
                {{$tender->supplied_quantity}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;line-height: 300%;background-color:{{$color}}">
                {{$supply_type}}
            </td>
           
        </tr>
    @endforeach
    @else
    @endif 
</table>

