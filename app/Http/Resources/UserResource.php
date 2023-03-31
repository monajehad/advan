<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'name' => $this->name,
            // 'user_name' => $this->user_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobile' => $this->mobile,
            // 'description' => $this->description,
            'image' => $this->image_url,
            'category_id'=> $this->category_id,
           'item_id'=> $this->item_id,
           'home_address'=> $this->home_address,
        'whatsapp_phone'=>$this->whatsapp_phone ,

        'facebook'=>$this->facebook,
        'instagram'=> $this->instagram,
            // 'logo' => $this->image_url,
            // 'categores' => CategoryResource::collection($this->categories),
        ];
    }
}
