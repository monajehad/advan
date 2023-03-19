<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Hit;
use App\Models\SystemConstant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    const PAGINATION_NO=6;


    public function index(Request $request)
    {
        $data=[];

        $clients=Client::
        leftJoin('system_constants as category_constants', function($join) {
            $join->on('category_constants.value', '=', 'clients.category')->where('category_constants.type','category')->whereNull('category_constants.deleted_at');
        })->leftJoin('system_constants as area_1_constants', function($join) {
            $join->on('area_1_constants.value', '=', 'clients.area_1')->where('area_1_constants.type','area_1')->whereNull('area_1_constants.deleted_at');
        })
        ->select('category_constants.name as category_name','area_1_constants.name as area_1_name','clients.id','clients.specialty_id','clients.category','clients.name','clients.item','clients.area_1','clients.status')
        ->with(['specialty','clientHits']);
        $clients=$clients->orderBy('id','desc')->paginate(self::PAGINATION_NO);

        $data['clients']=$clients;

        $area_1_select=SystemConstant::select('id','name','value','type')->where([['type','area_1']])->orderBy('order')->get();

        $hits=Hit::leftJoin('system_constants as category_constants', function($join) {
            $join->on('category_constants.value', '=', 'hits.category')->where('category_constants.type','category')->whereNull('category_constants.deleted_at');
        })->leftJoin('system_constants as area_1_constants', function($join) {
            $join->on('area_1_constants.value', '=', 'hits.area_1')->where('area_1_constants.type','area_1')->whereNull('area_1_constants.deleted_at');
        })
        ->select('category_constants.name as category_name','area_1_constants.name as area_1_name','hits.id','hits.area_1','hits.address','hits.date','hits.time','hits.note','hits.category','hits.client_id','hits.user_id','hits.status')
        ->with(['client','user','samples']);
        $hits=$hits->orderBy('id','desc')->paginate(self::PAGINATION_NO);

        return view('dashboard',compact('data','hits'));



    }

}
