<?php

namespace App\Http\Controllers\Tenders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Supplier;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;


class SupplierController extends Controller
{
      const PAGINATION_NO=20;

    public function index(Request $request)
    {


        $suppliers=Supplier::select('id','ar_name','en_name','email','mobile','phone','address','status');
        if($request->search){
            $suppliers=$suppliers->where('ar_name','like','%'.$request->search.'%')
            ->orWhere('en_name','like','%'.$request->search.'%');
        }
        $suppliers=$suppliers->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('tenders.supplier.table-data',compact('suppliers'))->render();
            return response()->json(['suppliers'=>$table_data]);

        }
        return view('tenders.supplier.index',compact('suppliers'));
    }
    public function add(Request $request)
    {
        $validation=Validator::make($request->all(),$this->rules(),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        $request->status= (isset($request->status))? 1: 0;
        $supplier=Supplier::create([
            'ar_name'=>$request->ar_name,
            'en_name'=>$request->en_name,
            'address'=>$request->address,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'phone'=>$request->phone,
            // "user_id"=>Auth::id(),
            "user_id"=>'1',
            'status'=>$request->status
        ]);

        if(!$supplier)
            return response()->json(['status'=>false,'error'=>'لم يتم إضافة المورد']);
        return response()->json(['status'=>true,'success'=>'تم إضافة المورد بنجاح']);

    }
    public function get_supplier($id)
    {
        $supplier=Supplier::where('id',$id)
        ->select('id','ar_name','en_name','email','mobile','phone','address','status')
        ->first();

        if(!$supplier)
            return response()->json(['status'=>false,'error'=>'المورد غير موجود']);

        return response()->json(['status'=>true,'supplier'=>$supplier]);
    }

    public function edit(Request $request)
    {
        $validation=Validator::make($request->all(),$this->rules($request->hidden),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        $request->status= (isset($request->status))? 1: 0;
        $supplier=Supplier::where('id',$request->hidden)->first();
        if(!$supplier)
            return response()->json(['status'=>false,'error'=>'المورد غير موجود']);
            $update=$supplier->update([
                'ar_name'=>$request->ar_name,
                'en_name'=>$request->en_name,
                'address'=>$request->address,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'phone'=>$request->phone,
                // "user_id"=>Auth::id(),
                "user_id"=>'1',
                'status'=>$request->status,
                'updated_at'=>Carbon::now()

            ]);
        if(!$update)
            return response()->json(['status'=>false,'error'=>'لم يتم تعديل المورد']);
        return response()->json(['status'=>true,'success'=>'تم تعديل المورد بنجاح']);
    }
    public function delete(Request $request)
    {
        if(!$request->id)
            return response()->json(['status'=>false,'error'=>'لم يتم تحديد المورد']);
        $supplier=Supplier::where('id',$request->id)->first();
        if(!$supplier)
            return response()->json(['status'=>false,'error'=>'المورد غير موجود']);
        $delete=$supplier->delete();
        if(!$delete)
            return response()->json(['status'=>false,'error'=>'لم يتم حذف المورد']);
        return response()->json(['status'=>true,'success'=>'تم حذف المورد بنجاح']);
    }
    public function change_status($id)
    {
        $supplier=Supplier::where('id',$id)->first();
        if(!$supplier)
            return response()->json(['status'=>false,'error'=>'المورد غير موجود']);
        if($supplier->status==1)
            $supplier->status=0;
        else if($supplier->status==0)
            $supplier->status=1;

        $update=$supplier->update();
        if(!$update)
            return response()->json(['status'=>false,'error'=>'لم يتم تغيير حالة المورد']);
        return response()->json(['status'=>true,'success'=>'تم تغيير حالة المورد بنجاح']);
    }
    public function export_excel()
    {
        $suppliers=Supplier::select('id','ar_name','en_name','email','mobile','phone','address','status')
        ->orderBy('id','desc')->get();
        @ob_start();
        echo  chr(239) . chr(187) . chr(191);
        $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>الاسم بالعربي</th>
            <th>الاسم بالانجليزي</th>
            <th>البريد الإلكتروني</th>
            <th>الجوال</th>
            <th>الهاتف</th>
            <th>العنوان</th>
            <th>الحالة</th>
            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
        if (count($suppliers)>0) {
            foreach ($suppliers as $key=>$suppliers) {
                $i=$key+1;
                $table.="
                    <tr>
                        <td>". $i  ."</td>
                        <td>".  $suppliers->ar_name."</td>
                        <td>".  $suppliers->en_name."</td>
                        <td>".  $suppliers->email."</td>
                        <td>".  $suppliers->mobile." </td>
                        <td> ". $suppliers->phone ."</td>
                        <td> ". $suppliers->address ."</td>
                        <td> ". $suppliers->status ."</td>
                    </tr>
                    ";
                }
            }else{
                     $table.="
                     <tr>
                         <td style='text-align:center;font-weight:bold;' colspan=\"8\">لا يوجد موردين</td>
                     </tr>
                     ";
            }
            $table.="
            </tbody>
            </table>
            ";
            echo $table;
            $filename="الموردون";
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=".$filename.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");

    }
    private function rules($id='')
    {
        $rules=[
            'ar_name'=>'required',
            'en_name'=>'required',
            'address'=>'required',
        ];
        if($id){
            $rules['email']="required|unique:suppliers,email,$id";
            $rules['mobile']="required|unique:suppliers,mobile,$id";
            $rules['phone']="required|unique:suppliers,phone,$id";


        }else{
            $rules['email']="required|unique:suppliers,email";
            $rules['mobile']="required|unique:suppliers,mobile";
            $rules['phone']="required|unique:suppliers,phone";
        }

        return $rules;
    }
    private function messages()
    {
        return[
            "email.required"=>"يجب إدخال البريد الالكتروني",
            "email.unique"=>"البريد الالكتروني مكرر",
            "mobile.required"=>"يجب إدخال رقم الجوال",
            "mobile.unique"=>"رقم الجوال مكرر",
            "phone.required"=>"يجب إدخال رقم الهاتف",
            "phone.unique"=>" رقم الهاتف مكرر",
            "ar_name.required"=>"يجب إدخال الاسم بالعربي",
            "en_name.required"=>"يجب إدخال الاسم بالانجليزي",
            "address.required"=>"يجب إدخال العنوان",
        ];
    }

}
