<?php

namespace App\Http\Requests;

use App\Models\SmsMessage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySmsMessageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sms_message_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sms_messages,id',
        ];
    }
}
