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
use Illuminate\Support\Facades\DB;
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
        // if($request->user){
        //     $samples_stock=$samples_stock->where('samples_stock.user_id',$request->user);
        //     // ->orWhere('category_names','like','%'.$request->search.'%');
        // }
        if($request->category){
            $samples_stock=$samples_stock->where('sample_stocks.category_id',$request->category);
            // ->orWhere('category_names','like','%'.$request->search.'%');
        }
        if($request->date){
            $samples_stock=$samples_stock->where('sample_stocks.date',$request->date);
            // ->orWhere('category_names','like','%'.$request->search.'%');
        }
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

      }else{
        $request['status']='0';
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
            $request['status']='1';
      }else{
        $request['status']='0';
      }


        $sampleStock->update($request->all());

        return redirect()->route('admin.sample-stocks.index');
    }

    public function show(SampleStock $sampleStock)
    {
        // abort_if(Gate::denies('sample_stock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $unit_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','unit']])->orderBy('order')->get();
        $data['unit_select']=$unit_select;
        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $items = Item::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sampleStock->load('category');

        return view('advan.admin.sampleStocks.show', compact('categories', 'sampleStock','items','data'));
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
    public function massDestroy(Request $request)
    {
        $ids = $request->ids;
        DB::table("sample_stocks")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"تم حذف مخزون العينة ."]);
    }

    public function export_excel()
    {
        $samples_stock=SampleStock::
        leftJoin('system_constants as unit_constants', function($join) {
            $join->on('unit_constants.value', '=', 'sample_stocks.unit')->where('unit_constants.type','unit')->whereNull('unit_constants.deleted_at');
        })
        ->select('unit_constants.name as unit_name','sample_stocks.id','sample_stocks.item_id','sample_stocks.unit','sample_stocks.category_id'
        ,'sample_stocks.quantity','sample_stocks.status','sample_stocks.received_quantity','sample_stocks.date')->with(['category','item'])
        ->orderBy('id','desc')->get();
        @ob_start();
        echo  chr(239) . chr(187) . chr(191);
        $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>اسم الصنف</th>
            <th> العائلة</th>
            <th> الوحدة</th>
            <th> كمية المخزون</th>
            <th> الكمية الموزعة</th>
            <th> الكمية المتبقية</th>
            <th> شهر/سنة</th>

            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
            if (count($samples_stock)>0) {
                foreach ($samples_stock as $key=>$sample_stock) {
                    $i=$key+1;
                    $table.="
                        <tr>
                            <td>". $i  ."</td>
                            <td >". $sample_stock->item ? $sample_stock->item->name : ''  ."</td>
                            <td >". $sample_stock->category->name ??''  ."</td>
                            <td >". $sample_stock->unit_name ."</td>
                            <td >". $sample_stock->quantity  ."</td>
                            <td >". $sample_stock->received_quantity ."</td>
                            <td >". $sample_stock->quantity - $sample_stock->received_quantity   ."</td>
                            <td >".  $sample_stock->date   ."</td>

        </tr>
                        ";
                    }
            }else{
                     $table.="
                     <tr>
                         <td style='text-align:center;font-weight:bold;' colspan=\"8\">لا يوجد مخزون العينات</td>
                     </tr>
                     ";
            }
            $table.="
            </tbody>
            </table>
            ";
            echo $table;
            $filename="مخزون العينة";
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=".$filename.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");

    }
}
