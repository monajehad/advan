<?php

namespace App\Http\Resources;

use App\Models\SampleStock;
use Illuminate\Http\Resources\Json\JsonResource;

class SampleHitResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sample' => new SampleResource($this->samples),
            'quantity' => (int) $this->quantity,
        ];
    }
}
