<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Client;
use App\Models\Clinic;
use App\Models\Report;
use App\Models\ReportType;
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
            $reports=$reports->where('name','like','%'.$request->search.'%');
        }
        $reports=$reports->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.reports.table-data',compact('reports'))->render();
            return response()->json(['reports'=>$table_data]);

        }
        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = ReportType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('advan.admin.reports.index',compact('reports','users', 'types', 'clients'));
        // abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    }

    public function create()
    {
        // abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $types = Report::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // return view('advan.admin.reports.create', compact('users', 'types', 'clients'));
    }

    public function store(StoreReportRequest $request)
    {
        if($request->status == 'on'){
            $request->status='1';
      }
    //   dd($request->status);
      $report=Report::create([
          'name'=>$request->name,
          'user_id'=>$request->user_id,
          'type_id'=>$request->type_id,
          'client_id'=>$request->client_id,
          'title'=>$request->title,
          'note'=>$request->note,
          'time'=>$request->time,
          'date'=>$request->date,
          'description'=>$request->description,
          'status'=>$request->status,


      ]);
        // $report = Report::create($request->all());

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
        if($request->status == 'on'){
            $request->status='1';
      }
      // dd($request->status);
          $report->update([
          'name'=>$request->name,
          'user_id'=>$request->user_id,
          'client_id'=>$request->client_id,
          'note'=>$request->note,
          'time'=>$request->time,
          'date'=>$request->date,
          'description'=>$request->description,
          'status'=>$request->status,


      ]);

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        // abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->load('user', 'type', 'client');

        return view('advan.admin.reports.show', compact('report'));
    }

    public function destroy(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد التقرير']);
        $report=Report::where('id',$request->id)->first();
       if(!$report)
        return response()->json(['status'=>false,'error'=>'التقرير غير موجود']);
       $delete=$report->delete();
       if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف التقرير']);
       return response()->json(['status'=>true,'success'=>'تم حذف التقرير بنجاح']);


       return redirect()->route('admin.reports.index');


    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        Report::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function export_excel()
    {
        $reports=Report::select('id','type_id','hits_id','name','status','user_id','client_id','time','date'
        ,'title')->with('user','type','client')
        ->orderBy('id','desc')->get();
        @ob_start();
        echo  chr(239) . chr(187) . chr(191);
        $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>اسم الثلاثي</th>
            <th> اسم التقرير</th>
            <th> المندوب</th>
            <th> العميل</th>
            <th> التاريخ</th>
            <th> الوقت</th>
            <th> نوع التقرير</th>


            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
        if (count($reports)>0) {
            foreach ($reports as $report) {
                // $i=$key+1;
                $table.="
                    <tr>
                        <td>". '1++'  ."</td>
                        <td>". $report->name  ."</td>
                        <td>". $report->user->name  ."</td>
                        <td>". $report->client->name  ."</td>
                        <td>". $report->date  ."</td>
                        <td>". $report->time  ."</td>
                        <td>". $report->type ? $report->type->name  : ''  ."</td>


                    ";
                }
            }else{
                     $table.="
                     <tr>
                         <td style='text-align:center;font-weight:bold;' colspan=\"8\">لا يوجد تقارير</td>
                     </tr>
                     ";
            }
            $table.="
            </tbody>
            </table>
            ";
            echo $table;
            $filename="التقرير";
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=".$filename.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");

    }
}
