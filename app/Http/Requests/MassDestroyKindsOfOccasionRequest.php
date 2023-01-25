<?php

namespace App\Http\Requests;

use App\Models\KindsOfOccasion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyKindsOfOccasionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('kinds_of_occasion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:kinds_of_occasions,id',
        ];
    }
}
