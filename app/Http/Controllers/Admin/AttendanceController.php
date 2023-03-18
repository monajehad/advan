<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAttendanceRequest;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Hit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    use CsvImportTrait;
    const PAGINATION_NO=20;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $attendances=Attendance::with('user')->select('id','user_id','start_time','end_time','date','tracking_array');
        if($request->search){
            $attendances=$attendances->where('name','like','%'.$request->search.'%')
            ->orWhere('username','like','%'.$request->search.'%');
        }
        $attendances=$attendances->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.attendances.table-data',compact('attendances'))->render();
            return response()->json(['attendances'=>$table_data]);

        }
        $users = User::where('user_type' , 2)->get();

        return view('advan.admin.attendances.index',compact('attendances','users'));



    }

    public function create()
    {
        // abort_if(Gate::denies('attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('advan.admin.attendances.create', compact('users'));
    }

    public function store(StoreAttendanceRequest $request)
    {
        $attendance = Attendance::create($request->all());

        return redirect()->route('admin.attendances.index');
    }

    public function edit(Attendance $attendance)
    {
        // abort_if(Gate::denies('attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendance->load('user');

        return view('advan.admin.attendances.edit', compact('users', 'attendance'));
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->all());

        return redirect()->route('admin.attendances.index');
    }

    public function show(Attendance $attendance)
    {
        // abort_if(Gate::denies('attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance->load('user');

        return view('advan.admin.attendances.show', compact('attendance'));
    }

    public function track($id)
    {
        // abort_if(Gate::denies('attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance = Attendance::findOrFail($id);

        if ($attendance->tracking_array)
        {
            $hit = Hit::query()->where('status', '1')->where('user_id' , $attendance->user_id)->whereDate('date_time' , $attendance->date)->get();
        }else{
            $hit = Hit::query()->where('user_id' , $attendance->user_id)->whereDate('date' , $attendance->date)->get();
        }

        $attendance->load('user');

        return view('advan.admin.attendances.track', compact('attendance' , 'hit'));
    }

    public function destroy(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد الحضور']);
        $attendance=Attendance::where('id',$request->id)->first();
       if(!$attendance)
        return response()->json(['status'=>false,'error'=>'الحضور غير موجود']);
       $delete=$attendance->delete();
       if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف الحضور']);
       return response()->json(['status'=>true,'success'=>'تم حذف الحضور بنجاح']);


       return redirect()->route('admin.categories.index');


    }

    public function massDestroy(MassDestroyAttendanceRequest $request)
    {
        Attendance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function export_excel()
    {
        $attendances=Attendance::select('id','user_id','date','start_time','end_time')
        ->orderBy('id','desc')->get();
        @ob_start();
        echo  chr(239) . chr(187) . chr(191);
        $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>الاسم </th>
            <th>التاريخ</th>
            <th>بداية الوقت </th>
            <th>انتهاء الوقت</th>
            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
        if (count($attendances)>0) {
            foreach ($attendances as $key=>$attendance) {
                $i=$key+1;
                $table.="
                    <tr>
                        <td>". $i  ."</td>
                        <td>".  $attendance->user->name."</td>
                        <td>".  $attendance->date."</td>
                        <td>".  $attendance->start_time."</td>
                        <td>".  $attendance->end_time." </td>

                    ";
                }
            }else{
                     $table.="
                     <tr>
                         <td style='text-align:center;font-weight:bold;' colspan=\"8\">لا يوجد حضور</td>
                     </tr>
                     ";
            }
            $table.="
            </tbody>
            </table>
            ";
            echo $table;
            $filename="الحضور";
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=".$filename.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");

    }
}
