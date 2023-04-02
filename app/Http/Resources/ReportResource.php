<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'note' => $this->note  ?? '',
            'type' => new ReportTypeResource($this->type),
            'name' => $this->name,
            'date' => $this->date,
            'time' => $this->time,
            'client' => new ClientResource($this->client),
        ];
    }
}
