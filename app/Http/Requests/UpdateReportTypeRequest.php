<?php

namespace App\Http\Requests;

use App\Models\ReportType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReportTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('report_type_edit');
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
