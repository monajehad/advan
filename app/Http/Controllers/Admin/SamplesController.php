<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySampleRequest;
use App\Http\Requests\StoreSampleRequest;
use App\Http\Requests\UpdateSampleRequest;
use App\Models\Category;
use App\Models\HitsSamples;
use App\Models\Sample;
use App\Models\SampleStock;
use App\Models\SystemConstant;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SamplesController extends Controller
{
    const PAGINATION_NO=20;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('sample_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $samples=Sample::
        leftJoin('system_constants as unit_constants', function($join) {
            $join->on('unit_constants.value', '=', 'samples.unit')->where('unit_constants.type','unit')->whereNull('unit_constants.deleted_at');
        })
        ->select('unit_constants.name as unit_name','samples.id','samples.sample_id','samples.unit','samples.category_id'
        ,'samples.user_id','samples.quantity_request', 'samples.stock_available_id','samples.date','samples.status')->with(['category','item','sample', 'user', 'stock_available']);

        if($request->user){
            $samples=$samples->where('samples.user_id',$request->user);
            // ->orWhere('category_names','like','%'.$request->search.'%');
        }
        if($request->category){
            $samples=$samples->where('samples.category_id',$request->category);
            // ->orWhere('category_names','like','%'.$request->search.'%');
        }
        $samples=$samples->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.samples.table-data',compact('samples'))->render();
            return response()->json(['samples'=>$table_data]);

    }

        // $sample_stocks = SampleStock::where('status' , 1)->get();
        // $users         = User::where('status' , 1)->get();
        $unit_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','unit']])->orderBy('order')->get();
        $data['unit_select']=$unit_select;

        $categories = Category::get('name', 'id');
        $sample_stocks = SampleStock::where('status', 1)->get()->pluck('name', 'id','status');

        $users = User::get('name', 'id');
        return view('advan.admin.samples.index', compact('sample_stocks','categories','data','users','samples'));

    }
    public function create()
    {
        // abort_if(Gate::denies('sample_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        // return view('advan.admin.samples.create', compact('samples', 'users','data','categories'));
    }

    public function store(StoreSampleRequest $request)
    {
        if($request->status == 'on'){
            $request['status']='1';
      }
        dd($request->all());
        $sample = Sample::create($request->all());

        return redirect()->route('admin.samples.index');
    }

    public function edit(Sample $sample)
    {
        // abort_if(Gate::denies('sample_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','unit']])->orderBy('order')->get();
        $data['unit_select']=$unit_select;

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $samples = SampleStock::where('status', 1)->get()->pluck('name', 'id','status');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sample->load('sample', 'user', 'stock_available');

        return view('advan.admin.samples.edit', compact('samples', 'users', 'sample','data','categories'));
    }

    public function update(UpdateSampleRequest $request, Sample $sample)
    {
        if($request->status == 'on'){
            $request['status']='1';

      }
    //   dd($request);
        $sample->update($request->all());

        return redirect()->route('admin.samples.index');
    }

    public function show(Sample $sample)
    {
        // abort_if(Gate::denies('sample_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sample->load('sample', 'user', 'stock_available');

        return view('admin.samples.show', compact('sample'));
    }

    public function destroy(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد العينة']);
        $sample=Sample::where('id',$request->id)->first();
       if(!$sample)
        return response()->json(['status'=>false,'error'=>'العينة غير موجود']);
       $delete=$sample->delete();
       if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف العينة']);
       return response()->json(['status'=>true,'success'=>'تم حذف العينة بنجاح']);


       return redirect()->route('admin.samples.index');


    }
    public function massDestroy(MassDestroySampleRequest $request)
    {
        Sample::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function report(Request $request)
    {
        $sample = Sample::where('status' , 2);
        if ($request->user_name)
        {
            $sample = $sample->where('user_id' , $request->user_name);
        }
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            request()->query('y', Carbon::now()->year),
            request()->query('m', Carbon::now()->month)
        ));
        $to      = clone $from;
        $to->day = $to->daysInMonth;

        $sample = $sample->whereBetween('received_date', [$from, $to]);

        $sample = $sample->get();
        $user = User::find($request->user_name);
        return view('admin.report' , compact('sample' , 'user'));
    }

    public function report_stock(Request $request , $id)
    {
        $sample = Sample::where('id' , $id)->get();
        $user = User::find(Sample::find($id)->user_id);
        $type = 'stock';
        return view('admin.report' , compact('sample' , 'user' , 'type'));
    }
}
