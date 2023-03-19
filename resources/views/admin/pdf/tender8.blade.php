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

       
        <th border="1" width="10%" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">#</th>

        <th border="1" width="18%" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">المناقصة</th>
        <th border="1" width="18%" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> فرع الشركة</th>
        <th border="1" width="18%" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">القطاع</th>
        <th border="1" width="36%" style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> المؤسسة</th>
   
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
          
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$i}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$item->tender_no}}
            </td>
            <td border="1"style="text-align:center;font-size:10px;">
                {{$item->branch_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$item->sector_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$item->client}}
            </td>
           
           
        </tr>
    @endforeach
    @else
    @endif 
</table>

