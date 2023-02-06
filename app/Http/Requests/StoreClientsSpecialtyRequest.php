<?php

namespace App\Http\Requests;

use App\Models\ClientsSpecialty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientsSpecialtyRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('clinics_specialty_create');
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
