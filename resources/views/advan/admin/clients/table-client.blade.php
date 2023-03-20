 <html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    </head>
 <!--begin::Table-->
 <body>
    <h1>welcome</h1>
  <table class="table table-bordered " id="kt-table">
         <thead class="datatable-head">
             <tr class="text-center fw-bold fs-6 text-gray-800">
                 <th>#</th>
                 <th>اسم العميل</th>
                 <th> النوع</th>
                 <th> التخصص</th>
                 <th> التصنيف</th>
                 <th> المنطقة</th>
                 <th> الزيارات</th>
                 <th> العينات</th>




             </tr>
         </thead>

         <tbody class="text-center font-size-sm">
             @forelse($clients as $client)
             <tr class="data-row">
                <td class="checkbox--solid"> <input type="checkbox" class="sub_chk" data-id="{{$client->id}}"></td>
                <td class="name">{{$client->name}}</td>
                 <td class="name">{{$client->category_name}}</td>
                 <td class="name">{{$client->specialty->name}}</td>
                 <td class="name">{{$client->item}}</td>
                 <td class="name">{{$client->area_1_name}}</td>
                 <td class="name">{{$client->clientHits()->count()}}</td>
                 <td class="name">{{$client->clientHits()->get()->sum('number_samples')}}</td>




             </tr>
             @empty
             <tr>
                 <td class="text-muted text-center font-size-lg" colspan="10">لا يوجد عملاء</td>
             </tr>
             @endforelse
         </tbody>
     </table>

 </body>
 </html>


