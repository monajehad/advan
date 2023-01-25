<?php

namespace App\Http\Requests;

use App\Models\Sample;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSampleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sample_edit');
    }

    public function rules()
    {
        return [
            'sample_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'quantity_request' => [
                'string',
                'nullable',
            ],
            'quantity' => [
                'string',
                'required',
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
