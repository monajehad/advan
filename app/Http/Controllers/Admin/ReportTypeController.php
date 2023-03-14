<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReportTypeRequest;
use App\Http\Requests\StoreReportTypeRequest;
use App\Http\Requests\UpdateReportTypeRequest;
use App\Models\Report;
use App\Models\ReportType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportTypeController extends Controller
{
    use CsvImportTrait;
    const PAGINATION_NO=20;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('report_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportTypes = Report::all();
        if($request->search){
            $reports=$reportTypes->where('name','like','%'.$request->search.'%');
        }
        $reportTypes=$reportTypes->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.reportTypes.table-data',compact('reportTypes'))->render();
            return response()->json(['reportTypes'=>$table_data]);

        }
        return view('advan.admin.reportTypes.index', compact('reportTypes'));



    }

    public function create()
    {
        // abort_if(Gate::denies('report_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.reportTypes.create');
    }

    public function store(StoreReportTypeRequest $request)
    {
        if($request->status == 'on'){
            $request->status='1';
      }
      // dd($request->status);
      $reportType=ReportType::create([
          'name'=>$request->name,
          'status'=>$request->status,


      ]);

        return redirect()->route('admin.report-types.index');
    }

    public function edit(ReportType $reportType)
    {
        // abort_if(Gate::denies('report_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.reportTypes.edit', compact('reportType'));
    }

    public function update(UpdateReportTypeRequest $request, ReportType $reportType)
    {

        if($request->status == 'on'){
            $request->status='1';
      }
      // dd($request->status);
      $reportType->update([
          'name'=>$request->name,
          'status'=>$request->status,


      ]);

        return redirect()->route('admin.report-types.index');
    }

    public function show(ReportType $reportType)
    {
        // abort_if(Gate::denies('report_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.reportTypes.show', compact('reportType'));
    }

    public function destroy(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد نوع التقرير']);
        $reportType=Report::where('id',$request->id)->first();
       if(!$reportType)
        return response()->json(['status'=>false,'error'=>'نوع التقرير غير موجود']);
       $delete=$reportType->delete();
       if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف نوع التقرير']);
       return response()->json(['status'=>true,'success'=>'تم حذف نوع التقرير بنجاح']);


       return redirect()->route('admin.report-types.index');


    }

    public function massDestroy(MassDestroyReportTypeRequest $request)
    {
        ReportType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
