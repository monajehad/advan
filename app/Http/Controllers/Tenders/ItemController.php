<?php

namespace App\Http\Controllers\Tenders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\SystemConstant;
use App\Models\ItemTradeNames;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Imports\ItemsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{   const PAGINATION_NO=20;
    use FileUploadTrait;
    public function index(Request $request)
    {

        $data=[];
        $unit_select=  DB::connection('mysql_second')->table("SystemConstant")->select('id','name','value','type')->where([['status',1],['type','unit']])->orderBy('order')->get();
        $shape_select= DB::connection('mysql_second')->table("SystemConstant")->select('id','name','value','type')->where([['status',1],['type','pharmaceutical_form']])->orderBy('order')->get();

        $items=Item::
        leftJoin('system_constants as unit_constants', function($join) {
            $join->on('unit_constants.value', '=', 'items.unit')->where('unit_constants.type','unit')->whereNull('unit_constants.deleted_at');
        })->leftJoin('system_constants as shape_constants', function($join) {
            $join->on('shape_constants.value', '=', 'items.pharmaceutical_form')->where('shape_constants.type','pharmaceutical_form')->whereNull('shape_constants.deleted_at');
        })
        ->select('unit_constants.name as unit_name','shape_constants.name as shape_name','items.id','items.item_no','items.name','items.unit','items.pharmaceutical_form','items.status');

        if($request->search){
            $items = $items->where('items.name','like','%'.$request->search.'%');
        }

        $items = $items->orderBy('id','desc')->paginate(self::PAGINATION_NO);

        $data['items']=$items;
        $data['unit_select']=$unit_select;
        $data['shape_select']=$shape_select;

        if($request->ajax()){
            $table_data=view('admin.item.table-data',compact('data'))->render();
            return response()->json(['items'=>$table_data]);
        }
        return view('tenders.item.index',compact('data'));

    }
    public function get_item($id)
    {
        $item=Item::where('items.id',$id)
        ->select('items.id','items.item_no','items.name','items.unit','items.status','items.pharmaceutical_form')
        ->first();
        if(!$item)
            return response()->json(['status'=>false,'error'=>'الصنف غير موجود']);
        $item->names=ItemTradeNames::where('item_id',$item->id)->pluck('trade_name');

        return response()->json(['status'=>true,'item'=>$item]);
    }
    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),$this->rules(),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        $request->status= (isset($request->status))? 1: 0;
        DB::transaction(function () use ($request){
            $add_arr=[
                "item_no"=>$request->item_no,
                "name"=>$request->name,
                "unit"=>$request->unit,
                "pharmaceutical_form"=>$request->shape,
                "user_id"=>Auth::id(),
                'status'=>$request->status
            ];
            $item=Item::create($add_arr);
            if ($request->names) {
                foreach ($request->names as $name) {
                    ItemTradeNames::create([
                        "trade_name"=>$name,
                        "item_id"=>$item->id,
                        "user_id"=>Auth::id(),

                    ]);
                }
            }
        });
        return response()->json(['status'=>true,'success'=>'تم إضافة الصنف بنجاح']);
    }

    public function update(Request $request)
    {
        $validation=Validator::make($request->all(),$this->rules($request->hidden),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        $request->status= (isset($request->status))? 1: 0;
        $item=Item::where('id',$request->hidden)->first();
        if(!$item)
            return response()->json(['status'=>false,'error'=>'الصنف غير موجود']);

        DB::transaction(function () use ($request,&$item){
            $update_arr=[
                "item_no"=>$request->item_no,
                "name"=>$request->name,
                "unit"=>$request->unit,
                "pharmaceutical_form"=>$request->shape,
                "user_id"=>Auth::id(),
                'status'=>$request->status,
                'updated_at'=>Carbon::now()
            ];

            $item->update($update_arr);
            ItemTradeNames::where('item_id',$item->id)->delete();
            if ($request->names) {
                foreach ($request->names as $name) {
                    ItemTradeNames::create([
                        "trade_name"=>$name,
                        "item_id"=>$item->id,
                        "user_id"=>Auth::id(),
                    ]);
                }
            }
        });
        return response()->json(['status'=>true,'success'=>'تم تعديل الصنف بنجاح']);
    }

    public function delete(Request $request)
    {
        if(!$request->id)
            return response()->json(['status'=>false,'error'=>'لم يتم تحديد الصنف']);
        $item=Item::where('id',$request->id)->first();
        if(!$item)
            return response()->json(['status'=>false,'error'=>'الصنف غير موجود']);
        DB::transaction(function () use ($request,&$item){
            $this->removeFile($item->pharmaceutical_form);
            ItemTradeNames::where('item_id',$item->id)->delete();
            $item->delete();
        });
        return response()->json(['status'=>true,'success'=>'تم حذف الصنف بنجاح']);
    }
    public function change_status($id)
    {
        $item=Item::where('id',$id)
        ->first();

        if(!$item)
            return response()->json(['status'=>false,'error'=>'الصنف غير موجود']);

        if($item->status==1){
            $item->status=0;
        }else if($item->status==0){
            $item->status=1;
        }
        $update=$item->update();
        if(!$update)
            return response()->json(['status'=>false,'error'=>'لم يتم تغيير حالة الصنف']);
        return response()->json(['status'=>true,'success'=>'تم تغيير حالة الصنف بنجاح']);
    }
    public function import_excel(Request $request)
    {
        //dd($request->all());
        $validation=Validator::make($request->all(),[
            'file'=>'required|mimes:csv,xlsx,xls'
        ],[
            'file.required'=>'يجب رفع ملف',
            'file.mimes'=>'فقط يمكن رفع ملف من امتداد csv,xlsx,xls',

        ]);
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);

        }
        try {
            Excel::import(new ItemsImport, $request->file('file'));
            return response()->json(['status'=>true,'success'=>'تم الاضافة بنجاح من اكسل']);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // $failures = $e->failures();
            // dd($failures->first());
            return response()->json(['status'=>false,'error'=>'خطأ في بيانات الملف']);
       }

    }
    public function export_excel()
    {
        $items=Item::
        leftJoin('system_constants as unit_constants', function($join) {
            $join->on('unit_constants.value', '=', 'items.unit')->where('unit_constants.type','unit')->whereNull('unit_constants.deleted_at');
        })->leftJoin('system_constants as shape_constants', function($join) {
            $join->on('shape_constants.value', '=', 'items.pharmaceutical_form')->where('shape_constants.type','pharmaceutical_form')->whereNull('shape_constants.deleted_at');
        })->leftJoin('item_trade_names', function($join) {
            $join->on('item_trade_names.item_id', '=', 'items.id')->whereNull('item_trade_names.deleted_at');
        })->groupBy('items.id')
        ->select(
        DB::raw('GROUP_CONCAT(item_trade_names.trade_name) as trade_names')
        ,'unit_constants.name as unit_name','shape_constants.name as shape_name','items.id','items.item_no','items.name','items.unit','items.pharmaceutical_form','items.status')
        ->orderBy('id','desc')->get();
        // dd($items);
        @ob_start();
        echo  chr(239) . chr(187) . chr(191);
        $items_table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>رقم الصنف</th>
            <th>الاسم</th>
            <th>الوحدة</th>
            <th>الشكل الصيدلاني</th>
            <th>الحالة</th>
            <th>الأسماء التجارية</th>
            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
        if (count($items)>0) {
            foreach ($items as $key=>$item) {
                $i=$key+1;
                // $status='';
                // if ($status) {
                //     # code...
                // }
                $items_table.="
                    <tr>
                        <td>". $i  ."</td>
                        <td>".  $item->item_no."</td>
                        <td>".  $item->name."</td>
                        <td>".  $item->unit_name."</td>
                        <td>".  $item->shape_name." </td>
                        <td> ". $item->status ."</td>
                        <td> ". $item->trade_names ."</td>
                    </tr>
                ";
            }
        }else{
                 $items_table.="
                 <tr>
                     <td style='text-align:center;font-weight:bold;' colspan=\"7\">لا يوجد أصناف</td>
                 </tr>
                 ";
        }
        $items_table.="
        </tbody>
        </table>
        ";
        echo $items_table;
        $filename="الأصناف";
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=".$filename.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
    public function download_excel()
    {
        $path = public_path('file.xlsx');
        $response = Response::download($path);
        return $response;
    }
    private function rules($id='')
    {
        $rules=[];
        if($id){
            $rules['item_no']="required|unique:items,item_no,$id";
        }else{
            $rules['item_no']="required|unique:items,item_no";
        }
        $rules['name']="required";
        $rules['unit']="required";
        $rules['shape']="required";

        return $rules;
    }
    private function messages()
    {
        return[
            "item_no.required"=>"يجب إدخال رقم الصنف",
            "item_no.unique"=>"رقم الصنف مكرر",
            "name.required"=>"يجب إدخال اسم الصنف",
            "unit.required"=>"يجب اختيار الوحدة",
            "unit.required"=>"يجب اختيار الشكل",
        ];
    }

}

