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

        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">المناقصة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> المؤسسة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> فرع الشركة</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">اسم الصنف </th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> المورد</th>
        <th border="1" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">تاريخ الانتهاء</th>
    </tr>
    @if(count($tenders)>0)
        @php 
                $i=0;

        @endphp
     
    @forelse($tenders as $key => $item)

         @php 
            $i++;
        
     
        @endphp
        <tr>
          
            <td border="1"  style="text-align:center;font-size:10px;;line-height: 300%;">
                {{$item->tender_no}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;line-height: 300%;">
                {{$item->client}}
            </td>
            <td border="1"style="text-align:center;font-size:10px;line-height: 300%;">
                {{$item->branch_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$item->item}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;line-height: 300%;">
                {{$item->supplier}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;line-height: 300%;">
                {{$item->expired_date}}
            </td>
           
        </tr>
    @endforeach
    @else
    <tr style='text-align:center;'>
        <td  border="1" style="text-align:center;font-size:10px;line-height: 300%; font-weight:bold;" colspan="7">لا يوجد أصناف منهية</td>
    </tr>
    @endif 
</table>

