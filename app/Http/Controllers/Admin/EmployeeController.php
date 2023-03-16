<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminController;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use App\Models\User_Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
{
    const PAGINATION_NO=20;

    public function index(Request $request)
    {

        $employees=Employee::select('id','name','username','email','mobile','status')->with('roles');
        if($request->search){
            $employees=$employees->where('name','like','%'.$request->search.'%')
            ->orWhere('username','like','%'.$request->search.'%');
        }
        $employees=$employees->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.employee.table-data',compact('employees'))->render();
            return response()->json(['employees'=>$table_data]);

        }
        return view('advan.admin.employee.index',compact('employees'));
    }
    public function add(Request $request)
    {
        $validation=Validator::make($request->all(),$this->rules(),$this->messages());
        // if ($validation->fails()) {
        //     return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        // }
        if(!$request->password)
            return response()->json(['status'=>false,'error'=>'يجب إدخال كلمة السر']);

        if(preg_match('/[^A-Za-z0-9]/', $request->username)){
            return response()->json(['status' => false , 'error' => 'اسم المستخدم يجب أن يحتوي على حروف انجليزية و يمكن إضافة أرقام']);
        }

        // $request->status= (isset($request->status))? 1: 0;
        // $request->tender_alert= (isset($request->tender_alert))? 1: 0;

        $password=Hash::make($request->password);
        // $employee = Employee::create($request->all());
        // $employee->roles()->sync($request->input('roles', []));
        // // $user->user_type = $request->input('roles');
        // $employee->save();
        // $user->categories()->sync($request->input('categories', []));


        $employee=Employee::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            // 'status'=>$request->status,

            'password'=>$request->password,

        ]);
        // if ($request->file('image')) {
        //     $image = saveOriginalImage($request->file('image'),Employee::DIR_UPLOAD );
        //     $employee->fill(['image' => $image])->save();
        // }
        $employee->roles()->sync($request->input('roles', []));
        // $employee->save();


        if(!$employee)
            return response()->json(['status'=>false,'error'=>'لم يتم إضافة المستخدم']);
        return response()->json(['status'=>true,'success'=>'تم إضافة المستخدم بنجاح']);

    }
    public function get_user($id)
    {
        $employee=Employee::where('id',$id)
        ->select('id','name','username','email','mobile','status')
        ->first();

        if(!$employee)
            return response()->json(['status'=>false,'error'=>'المستخدم غير موجود']);

        return response()->json(['status'=>true,'user'=>$employee]);
    }

    public function update(Request $request)
    {
        $validation=Validator::make($request->all(),$this->rules($request->hidden),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        if(preg_match('/[^A-Za-z0-9]/', $request->username)){
            return response()->json(['status' => false , 'error' => 'اسم المستخدم يجب أن يحتوي على حروف انجليزية و يمكن إضافة أرقام']);
        }

        $employee=Employee::where('id',$request->hidden)->first();

        if(!$employee)
            return response()->json(['status'=>false,'error'=>'المستخدم غير موجود']);

        $request->status= (isset($request->status))? 1: 0;
        $request->tender_alert= (isset($request->tender_alert))? 1: 0;
        $password=Hash::make($request->password);
        $update=$employee->update([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'status'=>$request->status,
            'tender_alert'=>$request->tender_alert,
            'updated_at'=>Carbon::now()

        ]);
        if(!$update)
            return response()->json(['status'=>false,'error'=>'لم يتم تعديل المستخدم']);
        return response()->json(['status'=>true,'success'=>'تم تعديل المستخدم بنجاح']);
    }
    public function delete(Request $request)
    {
        if(!$request->id)
            return response()->json(['status'=>false,'error'=>'لم يتم تحديد المستخدم']);
        $employee=Employee::where('id',$request->id)->first();
        if(!$employee)
            return response()->json(['status'=>false,'error'=>'المستخدم غير موجود']);
        $delete=$employee->delete();
        if(!$delete)
            return response()->json(['status'=>false,'error'=>'لم يتم حذف المستخدم']);
        return response()->json(['status'=>true,'success'=>'تم حذف المستخدم بنجاح']);
    }
    public function change_status($id)
    {
        $employee=Employee::where('id',$id)->first();
        if(!$employee)
            return response()->json(['status'=>false,'error'=>'المستخدم غير موجود']);
        if($employee->status==1)
            $employee->status=0;
        else if($employee->status==0)
            $employee->status=1;

        $update=$employee->update();
        if(!$update)
            return response()->json(['status'=>false,'error'=>'لم يتم تغيير حالة المستخدم']);
        return response()->json(['status'=>true,'success'=>'تم تغيير حالة المستخدم بنجاح']);
    }
    public function change_password(Request $request)
    {
        $validation=Validator::make($request->all(),['employee_id'=>'required','new_password'=>'required'],
            [
                'employee_id.required'=>"لم يتم تحديد المستخدم",
                'new_password.required'=>"يجب إدخال كلمة السر",
                'confirm_new_password.required'=>"يجب تأكيد كلمة السر",
            ]
        );
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        if($request->new_password != $request->confirm_new_password)
            return response()->json(['status'=>false,'error'=>'كلمة السر و تأكيدها غير متطابقتان']);

        $employee=Employee::where('id',$request->employee_id)->first();
        if(!$employee)
            return response()->json(['status'=>false,'error'=>'المستخدم غير موجود']);
        $employee->password=Hash::make($request->new_password);
        $employee->updated_at=Carbon::now();
        $update=$employee->update();
        if(!$update)
            return response()->json(['status'=>false,'error'=>'لم يتم تغيير كلمة السر']);
        return response()->json(['status'=>true,'success'=>'تم تغيير كلمة السر بنجاح']);

    }
    public function show()
    {
        return view('admin.employee.profile');
    }


    public function change_user_password(Request $request)
    {
        $validation=Validator::make($request->all(),['old_pass'=>'required','new_pass'=>'required','conf_pass'=>'required'],
            [
                'old_pass.required'=>"لم يتم تحديد المستخدم",
                'new_pass.required'=>"يجب إدخال كلمة السر",
                'conf_pass.required'=>"يجب تأكيد كلمة السر",
            ]
        );
        if ($validation->fails()) {
            session()->flash('pass_error',$validation->errors()->first());
            return redirect()->back()->withInput();
        }
        if($request->new_pass != $request->conf_pass){
            session()->flash('pass_error','كلمة السر و تأكيدها غير متطابقتان');
            return redirect()->back()->withInput();
        }
        $user=Auth::user();
        if(!Hash::check($request->old_pass, $user->password)){
            session()->flash('pass_error','كلمة السر الحالية خاطئة');
            return redirect()->back()->withInput();
        }
        $user->password=Hash::make($request->new_pass);
        $user->updated_at= Carbon::now();
        $update=$user->update();
        if(!$update)
        {
            session()->flash('pass_error','خطأ في تغيير كلمة السر');
        }else{
            session()->flash('pass_success','تم تغيير كلمة السر بنجاح');
        }
        return back()->withInput();
    }
    public function get_permissions($id)
    {
        // config()->set('database.connections.mysql.strict', false);
        $data=[];
        $user=Employee::where('id',$id)->first();
        if(!$user)
            return response()->json(['status'=>false,'error'=>'المستخدم غير موجود']);
        $data['permissions']=Permission::select('group', 'id','name','ar_name')->get()->groupBy('group')->toArray();

        // $data['permissions']=Permission::select("group",'count(permissions.id)')->groupby('group')->get()->toArray();
        // dd($data['permissions']);
        $user_permissions=DB::table('model_has_permissions')->where('model_id',$user->id)->pluck('permission_id')->toArray();
        if (count($user_permissions)>0) {
            $data['user_permissions']=$user_permissions;
        }else{
            $data['user_permissions']=[];
        }
        $data['user']=$user->id;
        $form=view('admin.user.sub.permission',compact('data'))->render();
        return response()->json(['status'=>true,'form'=>$form]);
    }
    // public function grant_user_permissions(Request $request)
    // {
    //     if(!$request->user)
    //         return response()->json(['status'=>false,'error'=>'لم يتم اختيار المستخدم']);
    //     if(count($request->all())==1)
    //         return response()->json(['status'=>false,'error'=>'لم يتم تحديد أي صلاحية']);
    //     $user=Employee::where('id',$request->user)->first();
    //     if(!$user)
    //         return response()->json(['status'=>false,'error'=>'المستخدم غير موجود']);


    //         DB::transaction(function () use ($request , $user){

    //               $user_permissions = User_Permission::where('model_id','=',$request->user)->get();
    //         foreach($user_permissions as $per){
	// 		    $user->revokePermissionTo($per->guard_name);
	// 		}
    //         foreach ($request->permissions as $permission) {
    //             // $perm = Permission::find($permission);

    //             $user->givePermissionTo($permission);
    //         }
    //     });
    //     // $per=$user->syncPermissions($request->permissions);
    //     // if(!$per)
    //     //     return response()->json(['status'=>false,'error'=>'لم يتم إعطاء الصلاحيات']);
    //     return response()->json(['status'=>true,'success'=>'تم إعطاء الصلاحيات بنجاح']);
    // }

    public function export_excel()
    {
        $users=Employee::select('id','name','username','email','mobile','status')
        ->orderBy('id','desc')->get();
        @ob_start();
        echo  chr(239) . chr(187) . chr(191);
        $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>الاسم بالكامل</th>
            <th>اسم المستخدم</th>
            <th>البريد الإلكتروني</th>
            <th>الجوال</th>
            <th>الحالة</th>
            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
        if (count($users)>0) {
            foreach ($users as $key=>$user) {
                $i=$key+1;
                $table.="
                    <tr>
                        <td>". $i  ."</td>
                        <td>".  $user->name."</td>
                        <td>".  $user->username."</td>
                        <td>".  $user->email."</td>
                        <td>".  $user->mobile." </td>
                        <td> ". $user->status ."</td>
                    </tr>
                    ";
                }
            }else{
                     $table.="
                     <tr>
                         <td style='text-align:center;font-weight:bold;' colspan=\"6\">لا يوجد مستخدمين</td>
                     </tr>
                     ";
            }
            $table.="
            </tbody>
            </table>
            ";
            echo $table;
            $filename="المستخدمون";
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
            $rules['email']="required|unique:users,email,$id";
            $rules['mobile']="required|unique:users,mobile,$id";
            $rules['username']="required|unique:users,username,$id";


        }else{
            $rules['email']="required|unique:users,email";
            $rules['mobile']="required|unique:users,mobile";
            $rules['username']="required|unique:users,username";
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
            "name.required"=>"يجب إدخال الاسم بالكامل",
            "username.unique"=>"اسم المستخدم مكرر",
            "username.required"=>"يجب إدخال اسم المستخدم",
        ];
    }




}
