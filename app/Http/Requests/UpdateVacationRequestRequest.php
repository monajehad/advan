<?php

namespace App\Http\Requests;

use App\Models\VacationRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVacationRequestRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('vacation_request_edit');
    // }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'days' => [
                'string',
                'required',
            ],
            'start_date' => [
                'required',
                'date_format:' . 'Y-m-d',
            ],
            'end_date' => [
                'date_format:' . 'Y-m-d',
                'nullable',
            ],
            'reason' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
