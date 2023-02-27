<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SmsMessageResource;
use App\Models\SmsMessage;

class SmsMessageApiController extends Controller
{
    public function index()
    {
        $data = SmsMessageResource::collection(SmsMessage::with(['user', 'client'])->get());
        return apiResponse($data);
    }
}
