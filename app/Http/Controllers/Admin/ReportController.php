<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Client;
use App\Models\Clinic;
use App\Models\Report;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Report::with(['user', 'type', 'clinic'])->select(sprintf('%s.*', (new Report())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'report_show';
                $editGate = 'report_edit';
                $deleteGate = 'report_delete';
                $crudRoutePart = 'reports';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('type_name', function ($row) {
                return $row->type ? $row->type->name : '';
            });

            $table->addColumn('hits_id', function ($row) {
                return $row->hits_id;
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('clinic_name', function ($row) {
                return $row->clinic ? $row->clinic->name : '';
            });

            $table->editColumn('time', function ($row) {
                return $row->time ? $row->time : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Report::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'type', 'clinic']);

            return $table->make(true);
        }

        $users   = User::get();
        $reports = Report::get();
        $clinics = Client::get();

        return view('advan.admin.reports.index', compact('users', 'reports', 'clinics'));
    }

    public function create()
    {
        // abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = Report::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clinics = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('advan.admin.reports.create', compact('users', 'types', 'clinics'));
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        // abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = Report::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clinics = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report->load('user', 'type', 'clinic');

        return view('advan.admin.reports.edit', compact('users', 'types', 'clinics', 'report'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        // abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->load('user', 'type', 'clinic');

        return view('advan.admin.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        // abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        Report::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
