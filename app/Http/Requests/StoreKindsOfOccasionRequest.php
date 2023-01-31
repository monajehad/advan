<?php

namespace App\Http\Requests;

use App\Models\KindsOfOccasion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKindsOfOccasionRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('kinds_of_occasion_create');
    // }

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
