<?php

namespace App\Http\Requests;

use App\Models\HitsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHitsTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hits_type_edit');
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
