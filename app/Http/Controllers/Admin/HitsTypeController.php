<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHitsTypeRequest;
use App\Http\Requests\StoreHitsTypeRequest;
use App\Http\Requests\UpdateHitsTypeRequest;
use App\Models\HitsType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HitsTypeController extends Controller
{
    use CsvImportTrait;
    const PAGINATION_NO=20;

    public function index(Request $request)
    {

        $hits_type=HitsType::select('id','name','status');
        if($request->search){
            $hits_type=$hits_type->where('name','like','%'.$request->search.'%');
        }
        $hits_type=$hits_type->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.hitsTypes.table-data',compact('hits_type'))->render();
            return response()->json(['hits_type'=>$table_data]);

        }
        return view('advan.admin.hitsTypes.index',compact('hits_type'));


        // abort_if(Gate::denies('hits_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    }

    public function create()
    {
        // abort_if(Gate::denies('hits_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.hitsTypes.create');
    }

    public function store(StoreHitsTypeRequest $request)
    {
        $hitsType = HitsType::create($request->all());

        return redirect()->route('admin.hits-types.index');
    }

    public function edit(HitsType $hitsType)
    {
        // abort_if(Gate::denies('hits_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.hitsTypes.edit', compact('hitsType'));
    }

    public function update(UpdateHitsTypeRequest $request, HitsType $hitsType)
    {
        $hitsType->update($request->all());

        return redirect()->route('admin.hits-types.index');
    }

    public function show(HitsType $hitsType)
    {
        // abort_if(Gate::denies('hits_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.hitsTypes.show', compact('hitsType'));
    }

    public function destroy(HitsType $hitsType)
    {
        // abort_if(Gate::denies('hits_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hitsType->delete();

        return back();
    }

    public function massDestroy(MassDestroyHitsTypeRequest $request)
    {
        HitsType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
