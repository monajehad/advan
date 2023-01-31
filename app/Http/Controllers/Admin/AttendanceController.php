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

    public function index(Request $request)
    {
        // abort_if(Gate::denies('attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Attendance::with(['user'])->select(sprintf('%s.*', (new Attendance())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'attendance_show';
                $trackGate = 'attendance_track';
                $editGate = 'attendance_edit';
                $deleteGate = 'attendance_delete';
                $crudRoutePart = 'attendances';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row',
                'trackGate',
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('start_time', function ($row) {
                return $row->start_time ? $row->start_time : '';
            });
            $table->editColumn('end_date', function ($row) {
                return $row->end_date ? $row->end_date : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        $users = User::where('user_type' , 2)->get();

        return view('advan.admin.attendances.index', compact('users'));
    }

    // public function create()
    // {
    //     // abort_if(Gate::denies('attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

    //     return view('advan.admin.attendances.create', compact('users'));
    // }

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
            $hit = Hit::query()->where('user_id' , $attendance->user_id)->whereDate('date_time' , $attendance->date)->get();
        }

        $attendance->load('user');

        return view('advan.admin.attendances.track', compact('attendance' , 'hit'));
    }

    public function destroy(Attendance $attendance)
    {
        // abort_if(Gate::denies('attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance->delete();

        return back();
    }

    public function massDestroy(MassDestroyAttendanceRequest $request)
    {
        Attendance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
