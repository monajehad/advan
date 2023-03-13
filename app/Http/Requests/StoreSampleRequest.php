<?php

namespace App\Http\Requests;

use App\Models\Sample;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSampleRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('sample_create');
    // }

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
            'date' => [
                'required',
                'date_format:' . 'Y-m',
            ],
            // 'quantity' => [
            //     'string',
            //     'required',
            // ],
            'category_id' => [
                // 'required',
                'integer',
            ],
            'unit' => [
                // 'required',
                'integer',
            ],
            // 'end_date' => [
            //     'date_format:' . config('panel.date_format'),
            //     'nullable',
            // ],
            'status' => [
                'required',
            ],
        ];
    }
}
