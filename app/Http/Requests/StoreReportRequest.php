<?php

namespace App\Http\Requests;

use App\Models\Report;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReportRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('report_create');
    // }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'type_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'date' => [
                // 'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time' => [
                // 'required',
                'date_format:' . config('panel.time_format'),
            ],
            'clinic_name' => [
                'string',
                'nullable',
            ],
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
