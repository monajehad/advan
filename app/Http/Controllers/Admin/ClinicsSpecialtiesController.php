<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClinicsSpecialtyRequest;
use App\Http\Requests\StoreClinicsSpecialtyRequest;
use App\Http\Requests\UpdateClinicsSpecialtyRequest;
use App\Models\ClinicsSpecialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClinicsSpecialtiesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('clinics_specialty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClinicsSpecialty::query()->select(sprintf('%s.*', (new ClinicsSpecialty())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'clinics_specialty_show';
                $editGate = 'clinics_specialty_edit';
                $deleteGate = 'clinics_specialty_delete';
                $crudRoutePart = 'clinics-specialties';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? ClinicsSpecialty::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('advan.admin.clinicsSpecialties.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('clinics_specialty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.clinicsSpecialties.create');
    }

    public function store(StoreClinicsSpecialtyRequest $request)
    {
        $clinicsSpecialty = ClinicsSpecialty::create($request->all());

        return redirect()->route('admin.clinics-specialties.index');
    }

    public function edit(ClinicsSpecialty $clinicsSpecialty)
    {
        // abort_if(Gate::denies('clinics_specialty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.clinicsSpecialties.edit', compact('clinicsSpecialty'));
    }

    public function update(UpdateClinicsSpecialtyRequest $request, ClinicsSpecialty $clinicsSpecialty)
    {
        $clinicsSpecialty->update($request->all());

        return redirect()->route('admin.clinics-specialties.index');
    }

    public function show(ClinicsSpecialty $clinicsSpecialty)
    {
        // abort_if(Gate::denies('clinics_specialty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('advan.admin.clinicsSpecialties.show', compact('clinicsSpecialty'));
    }

    public function destroy(ClinicsSpecialty $clinicsSpecialty)
    {
        // abort_if(Gate::denies('clinics_specialty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clinicsSpecialty->delete();

        return back();
    }

    public function massDestroy(MassDestroyClinicsSpecialtyRequest $request)
    {
        ClinicsSpecialty::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
