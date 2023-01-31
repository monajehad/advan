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
    public function index(Request $request)
    {
        // abort_if(Gate::denies('vacation_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VacationRequest::with(['user'])->select(sprintf('%s.*', (new VacationRequest())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'vacation_request_show';
                $editGate = 'vacation_request_edit';
                $deleteGate = 'vacation_request_delete';
                $crudRoutePart = 'vacation-requests';

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

            $table->editColumn('days', function ($row) {
                return $row->days ? $row->days : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? VacationRequest::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        $users = User::get();

        return view('advan.admin.vacationRequests.index', compact('users'));
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

    public function destroy(VacationRequest $vacationRequest)
    {
        // abort_if(Gate::denies('vacation_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacationRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyVacationRequestRequest $request)
    {
        VacationRequest::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
