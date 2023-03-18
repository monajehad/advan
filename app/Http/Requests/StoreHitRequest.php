<?php

namespace App\Http\Requests;

use App\Models\Hit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHitRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('hit_create');
    // }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'required',
                'date_format:' . ('Y-m-d'),
            ],
            'start_time' => [
                'required',
                // 'date_format:' . config('panel.time_format'),
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
            // 'categories.*' => [
            //     'integer',
            // ],
            // 'categories' => [
            //     'array',
            // ],
            // 'doctors.*' => [
            //     'integer',
            // ],
            // 'doctors' => [
            //     'array',
            // ],
        ];
    }
}
