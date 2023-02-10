<?php

namespace App\Http\Requests;

use App\Models\SampleStock;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSampleStockRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('sample_stock_create');
    // }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'quantity' => [
                'string',
                'required',
            ],
            'received_quantity' => [
                'string',
                // 'required',
            ],
            // 'received_date' => [
            //     'date_format:' . config('panel.date_format'),
            //     'nullable',
            // ],
            // 'end_date' => [
            //     'date_format:' . config('panel.date_format'),
            //     'nullable',
            // ],
            // 'date' => [
            //     'date_format:' . config('panel.date_format'),
            //     'nullable',
            // ],
            'category_id' => [
                'required',
                'integer',
            ],
            'item_id' => [
                // 'required',
                'integer',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
