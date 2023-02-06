<?php

namespace App\Http\Requests;

use App\Models\ClientsSpecialty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientsSpecialtyRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('clinics_specialty_edit');
    // }

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
