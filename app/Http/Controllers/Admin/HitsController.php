<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHitRequest;
use App\Http\Requests\StoreHitRequest;
use App\Http\Requests\UpdateHitRequest;
use App\Models\Category;
use App\Models\Client;
use App\Models\Clinic;
use App\Models\Hit;
use App\Models\HitsSamples;
use App\Models\HitsType;
use App\Models\KindsOfOccasion;
use App\Models\SystemConstant;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HitsController extends Controller
{

    const PAGINATION_NO=20;

    public function index(Request $request)
    {

        $hits=Hit::leftJoin('system_constants as category_constants', function($join) {
            $join->on('category_constants.value', '=', 'hits.category')->where('category_constants.type','category')->whereNull('category_constants.deleted_at');
        })
        ->select('category_constants.name as category_name','hits.id','hits.address','hits.date','hits.time','hits.note','hits.category','hits.client_id','hits.user_id','hits.status')
        ->with(['client','user','samples']);

        if($request->user){
            $hits=$hits->where('hits.user_id',$request->user)
            ;
        }
        if($request->address){
            $hits=$hits->where('hits.client_id',$request->address)
            ;
        }
        if($request->date){
            $hits=$hits->where('hits.date',$request->date)
            ;
        }
        $hits=$hits->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.hits.table-data',compact('hits'))->render();
            return response()->json(['hits'=>$table_data]);

        }
        $clients            = Client::get();
        $users              = User::get();
        return view('advan.admin.hits.index',compact('hits','clients','users'));

                // $d = explode(' ', $row->date_time);
                // if (count($d) > 1) {
                //     return Carbon::parse($row->date_time)->isoFormat('Y-M-D - h:mm A');
                // }else{
                //     return Carbon::parse($row->date_time)->isoFormat('Y-M-D');
                // }


           }

    public function note(Request $request)
    {
        // abort_if(Gate::denies('hit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

//         if ($request->ajax()) {
//             $hits = Hit::with(['client',  'user', 'date_time'])->where('note' , '!=' , null);
//             $hits=$hits->orderBy('id','desc')->paginate(self::PAGINATION_NO);
//         }
// //             if ($request->y&& $request->m) {
//                 $from = Carbon::parse(sprintf(
//                     '%s-%s-01',
//                     request()->query('y', Carbon::now()->year),
//                     request()->query('m', Carbon::now()->month),
//                 ));
//                 $to      = clone $from;


//                 if ($request->d == 0)
//                 {
//                     $to->day = $to->daysInMonth;
//                     $query = $query->whereBetween('date_time', [$from, $to]);
//                 }else{

// //                    dd($to->addDay($request->d - 1)->format('Y-m-d'));
//                     $query = $query->where('date_time', 'LIKE' , '%'.$to->addDay($request->d - 1)->format('Y-m-d').'%');

//                 }


//             }

//            if ($request->start && $request->end) {
//                $from = Carbon::parse($request->start);
//                $to      = Carbon::parse($request->end);
//                $query = $query->whereBetween('date_time', [$from, $to]);
//            }
            // $query = $query->select(sprintf('%s.*', (new Hit())->table));



                // $d = explode(' ', $row->date_time);
                // if (count($d) > 1) {
                //     return Carbon::parse($row->date_time)->isoFormat('Y-M-D - h:mm A');
                // }else{
                //     return Carbon::parse($row->date_time)->isoFormat('Y-M-D');
                // }


                $clients            = Client::get();
                $users              = User::get();
                return view('advan.admin.hits.note',compact('clients','users'));
        }

    public function map(Request $request)
    {
        // abort_if(Gate::denies('hit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::where('user_type' , 2)->where('status' , 1)->get();


        $hits = new Hit();
        $user = new Hit();

        if ($request->from_date && $request->to_date)
        {
            $hits  = $hits->whereBetween('date' , [$request->from_date , $request->to_date]);
            $user = $user->whereBetween('date' , [$request->from_date , $request->to_date]);
        }else{
            $hits =$hits->whereDate('date', Carbon::today());
            $user = $user->whereDate('date', Carbon::today());
        }

        if ($request->user && $request->user != '')
        {
            $hits = $hits->where('user_id' , $request->user);
            $user = $user->where('user_id' , $request->user);
        }

        $hits = $hits->get()->unique('client_id');
        $user = $user->get()->unique('user_id');


        return view('advan.admin.hits.map', compact('hits' , 'user' , 'users'));
    }

    public function create()
    {
        // abort_if(Gate::denies('hit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data=[];
        $category_select=SystemConstant::select('id','name','value','type')->where([['type','category']])->orderBy('order')->get();
        $data['category_select']=$category_select;
        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $visit_types = HitsType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sms = KindsOfOccasion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        // $doctors = Client::pluck('doctor_name', 'id');

        return view('advan.admin.hits.create', compact('clients', 'visit_types', 'users', 'sms', 'categories','data'));
    }

    public function store(StoreHitRequest $request)
    {
        $hit = Hit::create($request->all());
        $hit->categories()->sync($request->input('categories', []));
        $hit->names()->sync($request->input('names', []));

        return redirect()->route('admin.hits.index');
    }
    public function get_hit($id)
    {
        $hit=Hit::where('hits.id',$id)
        ->select('hits.id','hits.client_id',
        'hits.date_time','hits.visit_type_id','hits.duration_visit','hits.number_samples'
        ,'hits.address','hits.report_type','hits.report_status','hits.user_id','hits.note','hits.type','hits.category','hits.status'
        )
        ->first();
        if(!$hit)
            return response()->json(['status'=>false,'error'=>'الصنف غير موجود']);

        return response()->json(['status'=>true,'hit'=>$hit]);
    }
    public function edit(Hit $hit)
    {
        // abort_if(Gate::denies('hit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data=[];
        $category_select=SystemConstant::select('id','name','value','type')->where([['type','category']])->orderBy('order')->get();
        $data['category_select']=$category_select;

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $visit_types = HitsType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sms = KindsOfOccasion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        $hit->load('client', 'visit_type', 'user', 'sms');

        return view('advan.admin.hits.edit', compact('clients', 'visit_types', 'users', 'sms', 'data', 'hit'));
    }

    public function update(UpdateHitRequest $request, Hit $hit)
    {
        dd($request->all());
        $hit->update($request->all());
        // $hit->categories()->sync($request->input('categories', []));
        // $hit->doctors()->sync($request->input('doctors', []));

        return redirect()->route('admin.hits.index');
    }

    public function show(Hit $hit)
    {
        // abort_if(Gate::denies('hit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hit->leftJoin('system_constants as category_constants', function($join) {
            $join->on('category_constants.value', '=', 'hits.category')->where('category_constants.type','category')->whereNull('category_constants.deleted_at');
        })
        ->select('category_constants.name as category_name','hits.id','hits.date_time','hits.note','hits.category','hits.client_id','hits.user_id','hits.status')
        ->with(['client','user','samples','visit_type','user']);

        // $hit->load('client', 'visit_type', 'user', 'sms');

        $sample = HitsSamples::where('hit_id', $hit->id)->get();
        return view('advan.admin.hits.show', compact('hit' , 'sample'));
    }

    public function destroy(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد الزيارة']);
        $hit=hit::where('id',$request->id)->first();
       if(!$hit)
        return response()->json(['status'=>false,'error'=>'الزيارة غير موجود']);
       $delete=$hit->delete();
       if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف الزيارة']);
       return response()->json(['status'=>true,'success'=>'تم حذف الزيارة بنجاح']);


       return redirect()->route('admin.hits.index');


    }

    public function massDestroy(MassDestroyHitRequest $request)
    {
        Hit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
