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

        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">المناقصة</th>
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> المؤسسة</th>
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;"> فرع الشركة</th>

        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">اسم الصنف</th>
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">الاسم التجاري</th>
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">تاريخ استلام أمر التوريد</th>
        <th border="1"  style="font-weight:bold;text-align:center;font-size:10px;line-height: 30px;">مدة التوريد</th>
      
   
    </tr>
    @if(count($tender_items)>0)
        @php 
                $i=0;

        @endphp
     
    @forelse($tenders as $key => $tender)
        @forelse($tender_items as $item)

         @php 
            $i++;
        
     
        @endphp
        @if ($item->tender_id==$tender->id) 
                                
        @php 
        $date="";
        @endphp
            @if ($tender->notification_receipt_date &&$item->duration ) 
                @php 
                    $date = date_create($tender->notification_receipt_date );
                    date_add($date, date_interval_create_from_date_string("$item->duration days"));
                    $date =date_format($date, "Y-m-d");
                @endphp
            @endif
        <tr>

          
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$i}}
            </td>
            <td border="1" style="text-align:center;font-size:10px;">
                {{$tender->tender_no}}
            </td>
            <td border="1"style="text-align:center;font-size:10px;">
                {{$tender->client_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$tender->branch_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$item->item}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$item->trade_name}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$tender->notification_receipt_date}}
            </td>
            <td border="1"  style="text-align:center;font-size:10px;">
                {{$date}}
            </td>
            
           
        </tr>
        @endif
        @endforeach
    @endforeach
    @else
    @endif 
</table>

