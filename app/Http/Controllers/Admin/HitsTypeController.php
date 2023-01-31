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

    public function index(Request $request)
    {
        // abort_if(Gate::denies('hits_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HitsType::query()->select(sprintf('%s.*', (new HitsType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'hits_type_show';
                $editGate = 'hits_type_edit';
                $deleteGate = 'hits_type_delete';
                $crudRoutePart = 'hits-types';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? HitsType::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('advan.admin.hitsTypes.index');
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
