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
    const PAGINATION_NO=20;

    public function index(Request $request)
    {

        $kinds_of_occasion=KindsOfOccasion::select('id','name','description','status');
        if($request->search){
            $kinds_of_occasion=$kinds_of_occasion->where('name','like','%'.$request->search.'%');
        }
        $kinds_of_occasion=$kinds_of_occasion->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.KindsOfOccasions.table-data',compact('kinds_of_occasion'))->render();
            return response()->json(['kinds_of_occasion'=>$table_data]);

        }
        return view('advan.admin.KindsOfOccasions.index',compact('kinds_of_occasion'));
        // abort_if(Gate::denies('kinds_of_occasion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
