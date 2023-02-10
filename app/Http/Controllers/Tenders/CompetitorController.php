<?php

namespace App\Http\Controllers\Tenders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Competitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CompetitorController extends Controller
{
   const PAGINATION_NO=20;

    public function index(Request $request)
    {

        $competitors=Competitor::select('id','name','email','mobile','phone','address','status','color');
        if($request->search){
            $competitors=$competitors->where('name','like','%'.$request->search.'%');
        }
        $competitors=$competitors->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('tenders.competitor.table-data',compact('competitors'))->render();
            return response()->json(['competitors'=>$table_data]);

        }
        return view('tenders.competitor.index',compact('competitors'));
    }
    public function add(Request $request)
    {
        $validation=Validator::make($request->all(),$this->rules(),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        $request->status= (isset($request->status))? 1: 0;
        $competitor=Competitor::create([
            'name'=>$request->name,
            'address'=>$request->address,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'color'=>$request->color,
            'phone'=>$request->phone,
            //  "user_id"=>Auth::id(),
            "user_id"=>'1',

             'status'=>$request->status,

        ]);
        if(!$competitor)
        return response()->json(['status'=>false,'error'=>'لم يتم إضافة المنافس']);
    return response()->json(['status'=>true,'success'=>'تم إضافة المنافس بنجاح']);
        // return redirect()->route('competitor.index');


    }
    public function get_competitor($id)
    {
        $competitor=Competitor::where('id',$id)
        ->select('id','name','email','mobile','phone','address','status','color')
        ->first();

        if(!$competitor)
            return response()->json(['status'=>false,'error'=>'المنافس غير موجود']);

        return response()->json(['status'=>true,'competitor'=>$competitor]);
    }

    public function edit(Request $request)
    {
        $validation=Validator::make($request->all(),$this->rules($request->hidden),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        $competitor=Competitor::where('id',$request->hidden)->first();
        $request->status= (isset($request->status))? 1: 0;
        if(!$competitor)
            return response()->json(['status'=>false,'error'=>'المنافس غير موجود']);
            $update=$competitor->update([
                'name'=>$request->name,
                'address'=>$request->address,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'phone'=>$request->phone,
                'color'=>$request->color,
                // "user_id"=>Auth::id(),
            "user_id"=>'1',

                'status'=>$request->status,
                'updated_at'=>Carbon::now()

            ]);
        if(!$update)
            return response()->json(['status'=>false,'error'=>'لم يتم تعديل المنافس']);
        return response()->json(['status'=>true,'success'=>'تم تعديل المنافس بنجاح']);
    }
    public function delete(Request $request)
    {
        if(!$request->id)
            return response()->json(['status'=>false,'error'=>'لم يتم تحديد المنافس']);
        $competitor=Competitor::where('id',$request->id)->first();
        if(!$competitor)
            return response()->json(['status'=>false,'error'=>'المنافس غير موجود']);
        $delete=$competitor->delete();
        if(!$delete)
            return response()->json(['status'=>false,'error'=>'لم يتم حذف المنافس']);
        return response()->json(['status'=>true,'success'=>'تم حذف المنافس بنجاح']);
    }
    public function change_status($id)
    {
        $competitor=Competitor::where('id',$id)->first();
        if(!$competitor)
            return response()->json(['status'=>false,'error'=>'المنافس غير موجود']);
        if($competitor->status==1)
            $competitor->status=0;
        else if($competitor->status==0)
            $competitor->status=1;

        $update=$competitor->update();
        if(!$update)
            return response()->json(['status'=>false,'error'=>'لم يتم تغيير حالة المنافس']);
        return response()->json(['status'=>true,'success'=>'تم تغيير حالة المنافس بنجاح']);
    }
    public function export_excel()
    {
        $competitors=Competitor::select('name','email','mobile','phone','address','status','color')
        ->orderBy('id','desc')->get();
        @ob_start();
        echo  chr(239) . chr(187) . chr(191);
        $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>الاسم بالكامل</th>
            <th>البريد الإلكتروني</th>
            <th>الجوال</th>
            <th>الهاتف</th>
            <th>العنوان</th>
            <th>الحالة</th>
            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
        if (count($competitors)>0) {
            foreach ($competitors as $key=>$competitor) {
                $i=$key+1;
                $table.="
                    <tr>
                        <td style='background-color:".$competitor->color."'>". $i  ."</td>
                        <td style='background-color:".$competitor->color."'>".  $competitor->name."</td>
                        <td style='background-color:".$competitor->color."'>".  $competitor->email."</td>
                        <td style='background-color:".$competitor->color."'>".  $competitor->mobile."</td>
                        <td style='background-color:".$competitor->color."'>".  $competitor->phone." </td>
                        <td style='background-color:".$competitor->color."'>".  $competitor->address." </td>
                        <td style='background-color:".$competitor->color."'> ". $competitor->status ."</td>
                    </tr>
                    ";
                }
            }else{
                     $table.="
                     <tr>
                         <td style='text-align:center;font-weight:bold;' colspan=\"7\">لا يوجد منافسين</td>
                     </tr>
                     ";
            }
            $table.="
            </tbody>
            </table>
            ";
            echo $table;
            $filename="المنافسون";
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=".$filename.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");

    }

    private function rules($id='')
    {
        $rules=[
            'name'=>'required',
        ];
        if($id){
            $rules['email']="nullable|unique:competitors,email,$id";
            $rules['mobile']="nullable|unique:competitors,mobile,$id";
            $rules['phone']="nullable|unique:competitors,phone,$id";


        }else{
            $rules['email']="nullable|unique:competitors,email";
            $rules['mobile']="nullable|unique:competitors,mobile";
            $rules['phone']="nullable|unique:competitors,phone";
        }

        return $rules;
    }
    private function messages()
    {
        return[
            "email.unique"=>"البريد الالكتروني مكرر",
            "mobile.unique"=>"رقم الجوال مكرر",
            "phone.unique"=>" رقم الهاتف مكرر",
            "name.required"=>"يجب إدخال الاسم بالعربي",
        ];
    }

}
