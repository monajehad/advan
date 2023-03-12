<?php

namespace App\Http\Requests;

use App\Models\Attendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;

class StoreAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attendance_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'required',
                // 'date_format:' . ('Y-m-d'),
            ],
            'start_time' => [
                'required',
                // 'date_format:' . config('panel.time_format'),
            ],
            'end_time' => [
                // 'date_format:' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
