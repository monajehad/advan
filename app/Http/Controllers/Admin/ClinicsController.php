<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyClinicRequest;
use App\Http\Requests\StoreClinicRequest;
use App\Http\Requests\UpdateClinicRequest;
use App\Models\Clinic;
use App\Models\ClinicsSpecialty;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClinicsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('clinic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Clinic::with(['specialty'])->select(sprintf('%s.*', (new Clinic())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'clinic_show';
                $editGate = 'clinic_edit';
                $deleteGate = 'clinic_delete';
                $crudRoutePart = 'clinics';

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
            $table->editColumn('doctor_name', function ($row) {
                return $row->doctor_name ? $row->doctor_name : '';
            });
            $table->addColumn('specialty_name', function ($row) {
                return $row->specialty ? $row->specialty->name : '';
            });

            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('clinic_phone', function ($row) {
                return $row->clinic_phone ? $row->clinic_phone : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Clinic::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'specialty']);

            return $table->make(true);
        }

        $clinics_specialties = ClinicsSpecialty::get();

        return view('advan.admin.clinics.index', compact('clinics_specialties'));
    }

    public function create()
    {
        // abort_if(Gate::denies('clinic_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = ClinicsSpecialty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('advan.admin.clinics.create', compact('specialties'));
    }

    public function store(StoreClinicRequest $request)
    {
        $clinic = Clinic::create($request->all());

        if ($request->input('image', false)) {
            $clinic->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $clinic->id]);
        }

        return redirect()->route('admin.clinics.index');
    }

    public function edit(Clinic $clinic)
    {
        // abort_if(Gate::denies('clinic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = ClinicsSpecialty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clinic->load('specialty');

        return view('advan.admin.clinics.edit', compact('specialties', 'clinic'));
    }

    public function update(UpdateClinicRequest $request, Clinic $clinic)
    {
        $clinic->update($request->all());

        if ($request->input('image', false)) {
            if (!$clinic->image || $request->input('image') !== $clinic->image->file_name) {
                if ($clinic->image) {
                    $clinic->image->delete();
                }
                $clinic->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($clinic->image) {
            $clinic->image->delete();
        }

        return redirect()->route('admin.clinics.index');
    }

    public function show(Clinic $clinic)
    {
        // abort_if(Gate::denies('clinic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clinic->load('specialty', 'clinicHits');

        return view('advan.admin.clinics.show', compact('clinic'));
    }

    public function destroy(Clinic $clinic)
    {
        // abort_if(Gate::denies('clinic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clinic->delete();

        return back();
    }

    public function massDestroy(MassDestroyClinicRequest $request)
    {
        Clinic::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('clinic_create') && Gate::denies('clinic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Clinic();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
