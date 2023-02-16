<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHitRequest;
use App\Http\Requests\StoreHitRequest;
use App\Http\Requests\UpdateHitRequest;
use App\Models\Category;
use App\Models\Client;
use App\Models\Clinic;
use App\Models\Hit;
use App\Models\HitsSamples;
use App\Models\HitsType;
use App\Models\KindsOfOccasion;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HitsController extends Controller
{
    public function index(Request $request)
    {

        // abort_if(Gate::denies('hit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Hit::with(['clinic', 'visit_type', 'user', 'sms', 'categories', 'doctors'])->select(sprintf('%s.*', (new Hit())->table));
            if ($request->from_date && $request->to_date)
            {
                $hits  = $query->whereBetween('date_time' , [$request->from_date , $request->to_date]);
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'hit_show';
                $editGate = 'hit_edit';
                $deleteGate = 'hit_delete';
                $crudRoutePart = 'hits';

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
            $table->addColumn('clinic_name', function ($row) {
                return $row->clinic ? $row->clinic->name : '';
            });

            $table->editColumn('duration_visit', function ($row) {
                return $row->duration_visit ? $row->duration_visit : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? Hit::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Hit::STATUS_SELECT[$row->status] : '';
            });

            $table->editColumn('date_time', function ($row) {
                $d = explode(' ', $row->date_time);
                if (count($d) > 1) {
                    return Carbon::parse($row->date_time)->isoFormat('Y-M-D - h:mm A');
                }else{
                    return Carbon::parse($row->date_time)->isoFormat('Y-M-D');
                }
            });

            $table->rawColumns(['actions', 'placeholder', 'clinic', 'user']);

            return $table->make(true);
        }

        $clinics            = Client::get();
        $hits_types         = HitsType::get();
        $users              = User::get();
        $kinds_of_occasions = KindsOfOccasion::get();
        $categories         = Category::get();

        return view('advan.admin.hits.index', compact('clinics', 'hits_types', 'users', 'kinds_of_occasions', 'categories'));
    }

    public function note(Request $request)
    {
        // abort_if(Gate::denies('hit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Hit::with(['clinic', 'visit_type', 'user', 'sms', 'categories', 'doctors'])->where('note' , '!=' , null);

            if ($request->y&& $request->m) {
                $from = Carbon::parse(sprintf(
                    '%s-%s-01',
                    request()->query('y', Carbon::now()->year),
                    request()->query('m', Carbon::now()->month),
                ));
                $to      = clone $from;


                if ($request->d == 0)
                {
                    $to->day = $to->daysInMonth;
                    $query = $query->whereBetween('date_time', [$from, $to]);
                }else{

//                    dd($to->addDay($request->d - 1)->format('Y-m-d'));
                    $query = $query->where('date_time', 'LIKE' , '%'.$to->addDay($request->d - 1)->format('Y-m-d').'%');

                }


            }

//            if ($request->start && $request->end) {
//                $from = Carbon::parse($request->start);
//                $to      = Carbon::parse($request->end);
//                $query = $query->whereBetween('date_time', [$from, $to]);
//            }
            $query = $query->select(sprintf('%s.*', (new Hit())->table));



            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'hit_show';
                $editGate = 'hit_edit';
                $deleteGate = 'hit_delete';
                $crudRoutePart = 'hits';

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
            $table->addColumn('clinic_name', function ($row) {
                return $row->clinic ? $row->clinic->name : '';
            });

            $table->editColumn('duration_visit', function ($row) {
                return $row->duration_visit ? $row->duration_visit : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? Hit::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Hit::STATUS_SELECT[$row->status] : '';
            });

            $table->addColumn('date', function ($row) {
                $d = explode(' ', $row->date_time);
                if (count($d) > 1) {
                    return Carbon::parse($row->date_time)->isoFormat('Y-M-D - h:mm A');
                }else{
                    return Carbon::parse($row->date_time)->isoFormat('Y-M-D');
                }
            });

            $table->rawColumns(['actions', 'placeholder', 'clinic', 'user']);

            return $table->make(true);
        }

        $clinics            = Client::get();
        $hits_types         = HitsType::get();
        $users              = User::get();
        $kinds_of_occasions = KindsOfOccasion::get();
        $categories         = Category::get();

        return view('advan.admin.hits.note', compact('clinics', 'hits_types', 'users', 'kinds_of_occasions', 'categories'));
    }

    public function map(Request $request)
    {
        // abort_if(Gate::denies('hit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::where('user_type' , 2)->where('status' , 1)->get();


        $hits = new Hit();
        $user = new Hit();

        if ($request->from_date && $request->to_date)
        {
            $hits  = $hits->whereBetween('date_time' , [$request->from_date , $request->to_date]);
            $user = $user->whereBetween('date_time' , [$request->from_date , $request->to_date]);
        }else{
            $hits =$hits->whereDate('date_time', Carbon::today());
            $user = $user->whereDate('date_time', Carbon::today());
        }

        if ($request->user && $request->user != '')
        {
            $hits = $hits->where('user_id' , $request->user);
            $user = $user->where('user_id' , $request->user);
        }

        $hits = $hits->get()->unique('clinic_id');
        $user = $user->get()->unique('user_id');


        return view('advan.admin.hits.map', compact('hits' , 'user' , 'users'));
    }

    public function create()
    {
        // abort_if(Gate::denies('hit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clinics = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $visit_types = HitsType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sms = KindsOfOccasion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        $doctors = Client::pluck('doctor_name', 'id');

        return view('advan.admin.hits.create', compact('clinics', 'visit_types', 'users', 'sms', 'categories', 'doctors'));
    }

    public function store(StoreHitRequest $request)
    {
        $hit = Hit::create($request->all());
        $hit->categories()->sync($request->input('categories', []));
        $hit->doctors()->sync($request->input('doctors', []));

        return redirect()->route('admin.hits.index');
    }

    public function edit(Hit $hit)
    {
        // abort_if(Gate::denies('hit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clinics = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $visit_types = HitsType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sms = KindsOfOccasion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        $doctors = Client::pluck('doctor_name', 'id');

        $hit->load('clinic', 'visit_type', 'user', 'sms', 'categories', 'doctors');

        return view('advan.admin.hits.edit', compact('clinics', 'visit_types', 'users', 'sms', 'categories', 'doctors', 'hit'));
    }

    public function update(UpdateHitRequest $request, Hit $hit)
    {
        $hit->update($request->all());
        $hit->categories()->sync($request->input('categories', []));
        $hit->doctors()->sync($request->input('doctors', []));

        return redirect()->route('admin.hits.index');
    }

    public function show(Hit $hit)
    {
        // abort_if(Gate::denies('hit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hit->load('clinic', 'visit_type', 'user', 'sms', 'categories', 'doctors');

        $sample = HitsSamples::where('hit_id', $hit->id)->get();
        return view('advan.admin.hits.show', compact('hit' , 'sample'));
    }

    public function destroy(Hit $hit)
    {
        // abort_if(Gate::denies('hit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hit->delete();

        return back();
    }

    public function massDestroy(MassDestroyHitRequest $request)
    {
        Hit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
