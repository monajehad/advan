<?php

namespace App\Http\Requests;

use App\Models\Clinic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClinicRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('clinic_create');
    // }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'doctor_name' => [
                'string',
                'required',
            ],
            'specialty_id' => [
                'required',
                'integer',
            ],
            'email' => [
                'string',
                // 'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'clinic_phone' => [
                'string',
                'nullable',
            ],
            'address_1' => [
                'string',
                'nullable',
            ],
            'address_2' => [
                'string',
                'nullable',
            ],
            'address_3' => [
                'string',
                'nullable',
            ],
            'latitude' => [
                'string',
                'required',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
