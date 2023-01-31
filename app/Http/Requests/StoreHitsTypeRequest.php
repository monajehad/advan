<?php

namespace App\Http\Requests;

use App\Models\HitsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHitsTypeRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('hits_type_create');
    // }

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
