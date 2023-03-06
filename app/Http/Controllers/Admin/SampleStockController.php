<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySampleStockRequest;
use App\Http\Requests\StoreSampleStockRequest;
use App\Http\Requests\UpdateSampleStockRequest;
use App\Models\Category;
use App\Models\Hit;
use App\Models\HitsSamples;
use App\Models\Item;
use App\Models\Sample;
use App\Models\SampleStock;
use App\Models\SystemConstant;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SampleStockController extends Controller
{
    const PAGINATION_NO=20;

    public function index(Request $request)
    {

        // abort_if(Gate::denies('sample_stock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $samples_stock = SampleStock::with(['category','item'])->select(sprintf('%s.*', (new SampleStock())->table));
        $samples_stock=SampleStock::
        leftJoin('system_constants as unit_constants', function($join) {
            $join->on('unit_constants.value', '=', 'sample_stocks.unit')->where('unit_constants.type','unit')->whereNull('unit_constants.deleted_at');
        })
        ->select('unit_constants.name as unit_name','sample_stocks.id','sample_stocks.item_id','sample_stocks.unit','sample_stocks.category_id'
        ,'sample_stocks.quantity','sample_stocks.status','sample_stocks.received_quantity','sample_stocks.date')->with(['category','item']);

        $samples_stock=$samples_stock->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.sampleStocks.table-data',compact('samples_stock'))->render();
            return response()->json(['samples_stock'=>$table_data]);

    }

    $unit_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','unit']])->orderBy('order')->get();
    $data['unit_select']=$unit_select;

    $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
    $items = Item::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


            return view('advan.admin.sampleStocks.index', compact('samples_stock','categories','data','items'));


    }

    public function create()
    {
        // abort_if(Gate::denies('sample_stock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $unit_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','unit']])->orderBy('order')->get();
        // $data['unit_select']=$unit_select;

        // $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        // $items = Item::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        // return view('advan.admin.sampleStocks.create', compact('categories','data','items'));
    }

    public function store(StoreSampleStockRequest $request) {
        if($request->status == 'on'){
            $request['status']='1';

      }

        $request['available']=$request->quantity - $request->received_quantity;
        $sampleStock = SampleStock::create(

            $request->all()

    );

            // $sampleStock->date->format('m/Y');
        return redirect()->route('admin.sample-stocks.index');
    }

    public function edit(SampleStock $sampleStock)
    {
        // abort_if(Gate::denies('sample_stock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $unit_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','unit']])->orderBy('order')->get();
        $data['unit_select']=$unit_select;
        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $items = Item::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sampleStock->load('category','item');

        return view('advan.admin.sampleStocks.edit', compact('categories', 'sampleStock','items','data'));
    }

    public function update(UpdateSampleStockRequest $request, SampleStock $sampleStock)
    {
        if($request->status == 'on'){
            $request->status='1';
      }
      $request['status']='1';

        $sampleStock->update($request->all());

        return redirect()->route('admin.sample-stocks.index');
    }

    public function show(SampleStock $sampleStock)
    {
        // abort_if(Gate::denies('sample_stock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sampleStock->load('category');

        return view('advan.admin.sampleStocks.show', compact('sampleStock'));
    }

    public function destroy(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد مخزون العينة']);
        $sampleStock=SampleStock::where('id',$request->id)->first();
       if(!$sampleStock)
        return response()->json(['status'=>false,'error'=>'مخزون العينة غير موجود']);
       $delete=$sampleStock->delete();
       if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف مخزون العينة']);
       return response()->json(['status'=>true,'success'=>'تم حذف مخزون العينة بنجاح']);


       return redirect()->route('admin.sampleStocks.index');


    }
    public function massDestroy(MassDestroySampleStockRequest $request)
    {
        SampleStock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
