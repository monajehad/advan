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
    const PAGINATION_NO=20;

    public function index(Request $request)
    {


        $reports=Report::select('id','type_id','hits_id','name','status','user_id','client_id','time','date'
        ,'title')->with('user','type','client');
        if($request->search){
            $reports=$reports->where('name','like','%'.$request->search.'%')
            ->orWhere('username','like','%'.$request->search.'%');
        }
        $reports=$reports->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.reports.table-data',compact('reports'))->render();
            return response()->json(['reports'=>$table_data]);

        }
        return view('advan.admin.reports.index',compact('reports'));
        // abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    }

    public function create()
    {
        // abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = Report::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('advan.admin.reports.create', compact('users', 'types', 'clients'));
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

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report->load('user', 'type', 'client');

        return view('advan.admin.reports.edit', compact('users', 'types', 'clients', 'report'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        // abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->load('user', 'type', 'client');

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
