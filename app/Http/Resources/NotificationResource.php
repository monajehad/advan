<?php


namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Notification;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        $data = json_decode($this->data);
        return [
//            'id' => $this->id,
            'title' => $data->title,
            'body' => $data->body,
//            'type' => isset($data->type) ? $data->type : '',
//            'status' => isset($data->status) ? $data->status : '',
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'read' => $this->read_at != null ? true : false,

        ];
    }
}
