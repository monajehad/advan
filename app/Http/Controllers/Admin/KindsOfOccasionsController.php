<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyKindsOfOccasionRequest;
use App\Http\Requests\StoreKindsOfOccasionRequest;
use App\Http\Requests\UpdateKindsOfOccasionRequest;
use App\Models\KindsOfOccasion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KindsOfOccasionsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('kinds_of_occasion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = KindsOfOccasion::query()->select(sprintf('%s.*', (new KindsOfOccasion())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'kinds_of_occasion_show';
                $editGate = 'kinds_of_occasion_edit';
                $deleteGate = 'kinds_of_occasion_delete';
                $crudRoutePart = 'kinds-of-occasions';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? KindsOfOccasion::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('advan.admin.kindsOfOccasions.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('kinds_of_occasion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.kindsOfOccasions.create');
    }

    public function store(StoreKindsOfOccasionRequest $request)
    {
        $kindsOfOccasion = KindsOfOccasion::create($request->all());

        return redirect()->route('admin.kinds-of-occasions.index');
    }

    public function edit(KindsOfOccasion $kindsOfOccasion)
    {
        // abort_if(Gate::denies('kinds_of_occasion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.kindsOfOccasions.edit', compact('kindsOfOccasion'));
    }

    public function update(UpdateKindsOfOccasionRequest $request, KindsOfOccasion $kindsOfOccasion)
    {
        $kindsOfOccasion->update($request->all());

        return redirect()->route('admin.kinds-of-occasions.index');
    }

    public function show(KindsOfOccasion $kindsOfOccasion)
    {
        // abort_if(Gate::denies('kinds_of_occasion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.kindsOfOccasions.show', compact('kindsOfOccasion'));
    }

    public function destroy(KindsOfOccasion $kindsOfOccasion)
    {
        // abort_if(Gate::denies('kinds_of_occasion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kindsOfOccasion->delete();

        return back();
    }

    public function massDestroy(MassDestroyKindsOfOccasionRequest $request)
    {
        KindsOfOccasion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
