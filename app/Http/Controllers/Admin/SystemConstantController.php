<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemConstant;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SystemConstantController extends Controller
{

    const PAGINATION_NO=20;

    public function index(Request $request)
    {
        $data=[];
        $system_constants=SystemConstant::where([['type','system_constants'],['value2','!=','order_tenders'],['value2','!=','order_type'],['status',1]])->select('name','value','type','order','status','value2')->get();
        $constants=SystemConstant::where('system_constants.type','!=','system_constants')
        ->where('system_constants.type','!=','order_tenders')
        ->where('system_constants.type','!=','order_type')
        ->leftJoin('system_constants as constants', function($join) {
            $join->on('constants.value2', '=', 'system_constants.type')->where('constants.type','system_constants')->whereNull('constants.deleted_at');
        })
        ->select('constants.name as type_name','system_constants.id','system_constants.name','system_constants.value','system_constants.type','system_constants.order','system_constants.status','system_constants.value2')->orderBy('type');

        if($request->search){
            $constants=$constants->where('system_constants.name','like','%'.$request->search.'%');
            // ->orWhere('value3','like','%'.$request->search.'%');
        }
        $constants=$constants->paginate(self::PAGINATION_NO);
        // $constants->each( function ($item){
        //     $item->type_name=SystemConstant::where('type',$item->type)->pluck('name')->first();
        // });
        // dd($constants);
        $data['system_constants']=$system_constants;
        $data['constants']=$constants;
        if ($request->ajax()) {
            $table_data=view('admin.system_constants.table-data',compact('data'))->render();
            return response()->json(['table_data'=>$table_data]);

        }
        return view('advan.admin.system_constants.index',compact('data'));
    }
    public function add(Request $request)
    {
        $validation=Validator::make($request->all(),$this->rules(),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        $request->status= (isset($request->status))? 1: 0;

        $constants= DB::table('system_constants')->where('type',$request->type);
        $highest_order=$constants->max('order');
        $highest_values=$constants->max('value');

        DB::transaction(function () use ($request,$highest_order,$highest_values){
           $constant=SystemConstant::create([
                'name'=>$request->name,
                'status'=>$request->status,
                'value'=>(++$highest_order),
                'order'=>(++$highest_values),
                'type'=>$request->type,
            ]);
            if ($constant->type=='tender_type') {
                Permission::create([
                    'name' => "tender_type_$constant->value",
                    'ar_name' => "مناقصات $constant->name",
                    'group' => 11,
                ]);
            }
        });

        return response()->json(['status'=>true,'success'=>'تم إضافة الثابت بنجاح']);

    }
    public function get_constant($id)
    {
        $constant=SystemConstant::where('id',$id)
        ->select('id','name','value','type','order','status','value2')->first();

        if(!$constant)
            return response()->json(['status'=>false,'error'=>'الثابت غير موجود']);

        // $constant->type_name=SystemConstant::where('type',$constant->type)->pluck('name')->first();

        return response()->json(['status'=>true,'constant'=>$constant]);

    }
    public function update(Request $request)
    {
        $validation=Validator::make($request->all(),$this->rules(),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        $request->status= (isset($request->status))? 1: 0;
        $constant=SystemConstant::where('id',$request->hidden)->first();
        if(!$constant)
            return response()->json(['status'=>false,'error'=>'الثابت غير موجود']);

        $constants=SystemConstant::where('type',$request->type);
        $highest_order=$constants->max('order');
        $highest_values=$constants->max('value');

        // if ($constant->type!=$request->type) {
        //     SystemConstant::where('type',$constant->type)->decrement('order',1);
        //     SystemConstant::where('type',$constant->type)->decrement('value',1);

        // }
        DB::transaction(function () use ($request,$constant,$highest_order,$highest_values){

            // if ($constant->type=='tender_type') {
            //     Permission::where(
            //         'name' , "tender_type_$constant->value",
            //     )->delete();
            // }
            $update_arr=[
                'name'=>$request->name,
                'status'=>$request->status,

            ];
            if ($constant->type!=$request->type) {
                $update_arr['value']=(++$highest_order);
                $update_arr['order']=(++$highest_values);
                $update_arr['type']=$request->type;
            }else{
                $update_arr['value']=($constant->value);
            }

            $constant=$constant->update($update_arr);
            // if ($request->type=='tender_type') {
            //     Permission::create([
            //         'name' => "tender_type_$highest_values",
            //         'ar_name' => "مناقصات $request->name",
            //         'group' => 11,
            //     ]);
            // }

        });


        return response()->json(['status'=>true,'success'=>'تم تعديل الثابت بنجاح']);

    }
    public function delete(Request $request)
    {
        if(!$request->id)
            return response()->json(['status'=>false,'error'=>'لم يتم تحديد الثابت']);
        DB::transaction(function () use ($request){
            $constant=SystemConstant::where('id',$request->id)->first();
            if(!$constant)
                return response()->json(['status'=>false,'error'=>'الثابت غير موجود']);
            // if ($constant->type=='tender_type') {
            //     Permission::where(
            //         'name' , "tender_type_$constant->value",
            //     )->delete();
            // }
            $delete=$constant->delete();
        });

        return response()->json(['status'=>true,'success'=>'تم حذف الثابت بنجاح']);
    }
    public function change_status($id)
    {

        $constant=SystemConstant::where('id',$id)->first();
        if(!$constant)
            return response()->json(['status'=>false,'error'=>'الثابت غير موجود']);
        if($constant->status==1)
            $constant->status=0;
        else if($constant->status==0)
            $constant->status=1;

        $update=$constant->update();
        if(!$update)
            return response()->json(['status'=>false,'error'=>'لم يتم تغيير حالة الثابت']);
        return response()->json(['status'=>true,'success'=>'تم تغيير حالة الثابت بنجاح']);
    }

    private function rules()
    {
        return[
            'name'=>'required',
            'type'=>'required',
        ];
    }
    public function messages()
    {
        return[

            "name.required"=>"يجب إدخال الاسم",
            "type.required"=>"يجب اختيار نوع الثابت",
        ];
    }
}
