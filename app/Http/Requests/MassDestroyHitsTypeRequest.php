<?php

namespace App\Http\Requests;

use App\Models\HitsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHitsTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hits_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:hits_types,id',
        ];
    }
}
