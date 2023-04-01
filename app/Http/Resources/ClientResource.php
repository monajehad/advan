<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
           'specialty' => new ClientsSpecialtyResource($this->specialty),
            // 'category'=>$this->category,
            'item'=>$this->item,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'home_address'=>$this->home_address,
            // 'phone'=>$this->phone,
            'whatsapp_phone'=>$this->whatsapp_phone,
            'facebook'=>$this->facebook,
            'instagram'=>$this->instagram,
            // 'website'=>$this->website,
            // 'area_1'=>$this->area_1,
            // 'area_2'=>$this->area_2,
            // 'area_3'=>$this->area_3,
            // 'address_1' => $this->address_1,
            // 'address_2' => $this->address_2,
            // 'address_3' => $this->address_3,
//            'image' => optional($this->image)->url,
        ];
    }
}
