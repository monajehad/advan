<?php

namespace App\Http\Requests;

use App\Models\SmsMessage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSmsMessageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sms_message_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
