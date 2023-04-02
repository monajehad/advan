<?php


namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Notification;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        // $data = json_decode($this->data);
        return [
           'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
//            'type' => isset($this->type) ? $this->type : '',
//            'status' => isset($this->status) ? $this->status : '',
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'read' => $this->read_at != null ? true : false,

        ];
    }
}
