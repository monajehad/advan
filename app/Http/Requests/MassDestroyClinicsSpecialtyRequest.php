<?php

namespace App\Http\Requests;

use App\Models\ClinicsSpecialty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClinicsSpecialtyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('clinics_specialty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:clinics_specialties,id',
        ];
    }
}
