<?php

namespace App\Http\Requests;

use App\Models\KindsOfOccasion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKindsOfOccasionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kinds_of_occasion_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
