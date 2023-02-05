<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class System_Constants extends Model
{

    use SoftDeletes;
    protected $table = 'system_constants';
    protected $fillable = ['name_ar','user_id','name_en','value','value2','value3','type','order','photo','status','user_id'];

    public function user_type(){
        return $this->where('type','user_type')->where('status',1)->get(['value as id','name_ar as name','photo']);
    }

    public function constants($constact){
        return $this->where('type',$constact)->where('status',1)->get(['value as id','name_ar as name','name_en']);
    }

    public function getSystem($name,$type){
        $system = $this->OrderBy('system_constants.id','desc');
        if($name != ''){
            $system = $system->Where('system_constants.name_ar', 'like', '%' .  $name . '%');
        }
        if($type != ''){
            $system = $system->Where('system_constants.type',$type);
        }
		$system = $system->leftjoin('system_constants as system', function ($join) {
						$join->on('system.value2', '=' ,'system_constants.type')->where('system.type','system_constants');
					});
        return $system = $system->where('system_constants.type','!=','system_constants')
				->select(['system_constants.id','system_constants.name_ar','system_constants.status','system.name_ar as type_name','system_constants.type'])->paginate(20);
    }

    public function addconstant($name,$type,$status){
        $this->name_ar = $name;
        $this->type = $type;
        $this->status = $status;
        $value = $this->where('type',$type)->max('value');
        $this->value = $value + 1;
        $this->user_id = Auth::user()->id;
        $this->save();
        return $this;
    }

    public function getconstant($id){
        return $this->find($id);
    }

    public function updateconstant($obj,$name,$type){
        $obj->name_ar = $name;
        return $obj->save();
    }

    public function UpdateStatus($obj){
        if($obj->status == 0){
            $obj->status = 1;
        }else{
            $obj->status = 0;
        }
        return  $obj->save();
    }

    public function deleteConstant($obj){
        return $obj->delete();
    }

    public function getBranch($id){
        return $this->where('type','branch')->where('value2',$id)->get(['value as id','name_ar as name']);
    }
}
