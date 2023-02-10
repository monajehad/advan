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
        $samples_stock = SampleStock::with(['category','item'])->select(sprintf('%s.*', (new SampleStock())->table));

        $samples_stock=$samples_stock->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.sampleStocks.table-data',compact('samples_stock'))->render();
            return response()->json(['samples_stock'=>$table_data]);

    }
           $categories = Category::get();
           $items = Item::get();
            return view('advan.admin.sampleStocks.index', compact('samples_stock','categories','items'));


    }

    public function create()
    {
        // abort_if(Gate::denies('sample_stock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('advan.admin.sampleStocks.create', compact('categories'));
    }

    public function store(StoreSampleStockRequest $request)
    {
        $sampleStock = SampleStock::create($request->all());

        return redirect()->route('admin.sample-stocks.index');
    }

    public function edit(SampleStock $sampleStock)
    {
        // abort_if(Gate::denies('sample_stock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sampleStock->load('category');

        return view('advan.admin.sampleStocks.edit', compact('categories', 'sampleStock'));
    }

    public function update(UpdateSampleStockRequest $request, SampleStock $sampleStock)
    {
        $sampleStock->update($request->all());

        return redirect()->route('admin.sample-stocks.index');
    }

    public function show(SampleStock $sampleStock)
    {
        // abort_if(Gate::denies('sample_stock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sampleStock->load('category');

        return view('advan.admin.sampleStocks.show', compact('sampleStock'));
    }

    public function destroy(SampleStock $sampleStock)
    {
        // abort_if(Gate::denies('sample_stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sampleStock->delete();

        return back();
    }

    public function massDestroy(MassDestroySampleStockRequest $request)
    {
        SampleStock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
