<?php

namespace App\Http\Resources;

use App\Models\Hit;
use Illuminate\Http\Resources\Json\JsonResource;

class HitResource extends JsonResource
{
    public function toArray($request)
    {
        $date = null;
        $time = null;
        if ($this->date_time)
        {
            $date_time = explode(" " , $this->date_time);
            $date = $date_time[0];
            $time = $date_time[1];
        }
        return [
            'id' => $this->id,
            'clinic' => new ClinicResource($this->clinic),
            'date_time' => $this->date_time,
            'date' => $date,
            'time' => $time,
            'visit_type' => new HitsTypeResource($this->visit_type),
            'duration_visit' => $this->duration_visit,
            'number_samples' => $this->number_samples,
            'address' => $this->address,
            'note' => $this->note ?? '',
            'status' => Hit::STATUS_SELECT[$this->status],
            'status_id' => $this->status,
            'category' => CategoryResource::collection($this->categories),
            'doctors' => ClinicResource::collection($this->doctors),
            'samples' => SampleHitResource::collection($this->samples),
            'kinds_of_occasions' => $this->sms,
            'type' => $this->type,
        ];
    }
}
