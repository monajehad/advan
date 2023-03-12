<?php

namespace App\Http\Requests;

use App\Models\Report;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReportRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('report_edit');
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
                'required',
                'date_format:' . 'Y-m-d',
            ],
            'time' => [
                'required',
                // 'date_format:' . config('panel.time_format'),
            ],
            'client_name' => [
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
