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
            'user_name' => $this->user_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'description' => $this->description,
            'image' => $this->image_url,
            'logo' => $this->image_url,
            'categores' => CategoryResource::collection($this->categories),
        ];
    }
}
