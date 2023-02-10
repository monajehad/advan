<?php

namespace App\Http\Requests;

use App\Models\SampleStock;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySampleStockRequest extends FormRequest
{
    // public function authorize()
    // {
    //     abort_if(Gate::denies('sample_stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sample_stocks,id',
        ];
    }
}
