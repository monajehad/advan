<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVacationRequestRequest;
use App\Http\Requests\StoreVacationRequestRequest;
use App\Http\Requests\UpdateVacationRequestRequest;
use App\Models\User;
use App\Models\VacationRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VacationRequestController extends Controller
{

    const PAGINATION_NO=20;
    public function index(Request $request)
    {
        // abort_if(Gate::denies('vacation_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacationRequests=VacationRequest::with('user')->select('id','user_id','days','start_date','end_date','reason','status');
        if($request->search){
            $categories=$vacationRequests->where('name','like','%'.$request->search.'%')
            ->orWhere('username','like','%'.$request->search.'%');
        }
        $vacationRequests=$vacationRequests->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.vacationRequests.table-data',compact('vacationRequests'))->render();
            return response()->json(['vacationRequests'=>$table_data]);

        }
        return view('advan.admin.vacationRequests.index', compact('vacationRequests'));



    }

    public function create()
    {
        // abort_if(Gate::denies('vacation_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('advan.admin.vacationRequests.create', compact('users'));
    }

    public function store(StoreVacationRequestRequest $request)
    {
        $vacationRequest = VacationRequest::create($request->all());

        return redirect()->route('admin.vacation-requests.index');
    }

    public function edit(VacationRequest $vacationRequest)
    {
        // abort_if(Gate::denies('vacation_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vacationRequest->load('user');

        return view('advan.admin.vacationRequests.edit', compact('users', 'vacationRequest'));
    }

    public function update(UpdateVacationRequestRequest $request, VacationRequest $vacationRequest)
    {

        $vacationRequest->update($request->all());

        return redirect()->route('admin.vacation-requests.index');
    }

    public function show(VacationRequest $vacationRequest)
    {
        // abort_if(Gate::denies('vacation_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacationRequest->load('user');

        return view('advan.admin.vacationRequests.show', compact('vacationRequest'));
    }

    public function destroy(Request $request)
    {
        // abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد طلب زيارة']);
    $vacationRequests=VacationRequest::where('id',$request->id)->first();
    if(!$vacationRequests)
        return response()->json(['status'=>false,'error'=>'طلب زيارة غير موجود']);
    $delete=$vacationRequests->delete();
    if(!$delete)
        return response()->json(['status'=>false,'error'=>'لم يتم حذف طلب زيارة']);
    return response()->json(['status'=>true,'success'=>'تم حذف طلب زيارة بنجاح']);


    }


    public function massDestroy(MassDestroyVacationRequestRequest $request)
    {
        VacationRequest::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
