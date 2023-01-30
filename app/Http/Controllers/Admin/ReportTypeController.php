<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReportTypeRequest;
use App\Http\Requests\StoreReportTypeRequest;
use App\Http\Requests\UpdateReportTypeRequest;
use App\Models\ReportType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('report_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ReportType::query()->select(sprintf('%s.*', (new ReportType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'report_type_show';
                $editGate = 'report_type_edit';
                $deleteGate = 'report_type_delete';
                $crudRoutePart = 'report-types';

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
                return $row->status ? ReportType::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('advan.admin.reportTypes.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('report_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.reportTypes.create');
    }

    public function store(StoreReportTypeRequest $request)
    {
        $reportType = ReportType::create($request->all());

        return redirect()->route('admin.report-types.index');
    }

    public function edit(ReportType $reportType)
    {
        // abort_if(Gate::denies('report_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.reportTypes.edit', compact('reportType'));
    }

    public function update(UpdateReportTypeRequest $request, ReportType $reportType)
    {
        $reportType->update($request->all());

        return redirect()->route('admin.report-types.index');
    }

    public function show(ReportType $reportType)
    {
        // abort_if(Gate::denies('report_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.reportTypes.show', compact('reportType'));
    }

    public function destroy(ReportType $reportType)
    {
        // abort_if(Gate::denies('report_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportType->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportTypeRequest $request)
    {
        ReportType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
