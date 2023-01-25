<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'day' => Carbon::parse($this->date)->format('l'),
            'date' => Carbon::parse($this->date)->format('F d,Y'),
            'start_time' => Carbon::parse($this->start_time)->format('h:i A'),
            'end_time' =>  Carbon::parse($this->end_time)->format('h:i A'),
        ];
    }
}
