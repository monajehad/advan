<?php

namespace App\Http\Requests;

use App\Models\ClinicsSpecialty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClinicsSpecialtyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('clinics_specialty_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
