<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClinicResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'address_3' => $this->address_3,
            'doctor_name' => $this->doctor_name,
//            'specialty' => new ClinicsSpecialtyResource($this->specialty),
//            'image' => optional($this->image)->url,
        ];
    }
}
