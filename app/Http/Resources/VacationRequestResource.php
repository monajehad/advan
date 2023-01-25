<?php

namespace App\Http\Resources;

use App\Models\VacationRequest;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VacationRequestResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'days' => (int) $this->days,
            'start_date' => Carbon::parse($this->start_date)->format('F d,Y'),
            'end_date' =>  Carbon::parse($this->end_date)->format('F d,Y'),
            'reason' => $this->reason,
            'status' => VacationRequest::STATUS_SELECT[$this->status]
        ];
    }
}
