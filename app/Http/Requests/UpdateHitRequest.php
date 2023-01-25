<?php

namespace App\Http\Requests;

use App\Models\Hit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hit_edit');
    }

    public function rules()
    {
        return [
            'clinic_id' => [
                'required',
                'integer',
            ],
            'date_time' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'visit_type_id' => [
                'required',
                'integer',
            ],
            'duration_visit' => [
                'string',
                'nullable',
            ],
            'number_samples' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'report_type' => [
                'string',
                'nullable',
            ],
            'report_status' => [
                'string',
                'nullable',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
            'doctors.*' => [
                'integer',
            ],
            'doctors' => [
                'array',
            ],
        ];
    }
}
