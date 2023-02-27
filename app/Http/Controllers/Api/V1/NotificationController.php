<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $query = Notification::where('notifiable_id', Auth::id())->orderByDesc('created_at')->get();
        foreach ($query as $notification) {
            $notification->read_at = now();
            $notification->save();
        }
        $data = NotificationResource::collection($query);
        return apiResponse($data);
    }
}
