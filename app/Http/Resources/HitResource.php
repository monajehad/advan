<?php

namespace App\Http\Resources;

use App\Models\Hit;
use Illuminate\Http\Resources\Json\JsonResource;

class HitResource extends JsonResource
{
    public function toArray($request)
    {
        // $date = null;
        // $time = null;
        // if ($this->date)
        // {
        //     // $date = explode(" " , $this->date_time);
        //     $date = $date[0];
        //     $time = $date[1];
        // }
        return [
            'id' => $this->id,
            'client' => new ClientResource($this->client),
            'date' => $this->date,
            'date' => $this->date,
            'time' => $this->time,
            'visit_type' => new HitsTypeResource($this->visit_type),
            'duration_visit' => $this->duration_visit,
            'number_samples' => $this->number_samples,
            'address' => $this->address,
            'note' => $this->note ?? '',
            'status' => Hit::STATUS_SELECT[$this->status],
            'status_id' => $this->status,
            // 'category' => CategoryResource::collection($this->categories),
            // 'doctors' => ClientResource::collection($this->doctors),
            'samples' => SampleHitResource::collection($this->samples),
            'kinds_of_occasions' => $this->sms,
            'type' => $this->type,
        ];
    }
}
