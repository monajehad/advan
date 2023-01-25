<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SmsMessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'message' => $this->message,
            'doctor' =>  new ClinicResource($this->doctor),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
