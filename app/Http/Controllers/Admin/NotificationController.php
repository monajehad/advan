<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;


class NotificationController extends Controller
{
    //
    const PAGINATION_NO=20;

      //
      public function index(Request $req){
        $input = $req->all();
        $fcm_token = $input['fcm_token'];
        $user_id = $input['user_id'];


         $user = User::findOrFail($user_id);

        $user->fcm_token = $fcm_token;
        $user->save();
        return response()->json([
            'success'=>true,
            'message'=>'User token updated successfully.'
        ]);
     }
       public function get(Request $request){
        $notifications=Notification::with('user')->get();
        // dd($notifications);
        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        // $notifications=$notifications->orderBy('id','desc')->paginate(self::PAGINATION_NO);
        if ($request->ajax()) {
            $table_data=view('advan.admin.notifications.table-data',compact('notifications'))->render();
            return response()->json(['notifications'=>$table_data]);

        }
        return view('advan.admin.notifications.index',compact('users','notifications'));

     }
     public function destroy(Request $request)
     {
         if(!$request->id)
         return response()->json(['status'=>false,'error'=>'لم يتم تحديد الاشعار']);
         $notification=Notification::where('id',$request->id)->first();
        if(!$notification)
         return response()->json(['status'=>false,'error'=>'الاشعار غير موجود']);
        $delete=$notification->delete();
        if(!$delete)
         return response()->json(['status'=>false,'error'=>'لم يتم حذف الاشعار']);
        return response()->json(['status'=>true,'success'=>'تم حذف الاشعار بنجاح']);


        return redirect()->route('notifications');


     }

     public function updateToken(Request $request){
        try{
            $request->user()->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }
//      public function createNotification(Request $request)
// {
//        $input = $request->all();
//        $title = $input['title'];
//        $body = $input['body'];
//        $user_id = $input['user_id'];

//        $notification = new Notification([
//         'title' => $title,
//         'body' => $body,
//         'user_id' => $user_id
//       ]);

//       $notification->save();
//       return redirect()->back();
// }
public function sendNotification(Request $request)
{
    $firebaseToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();

    $SERVER_API_KEY = 'AAAAbn6ZtdM:APA91bF6CqSuLBeoGlz_kxV_kPSOZcwCcds0YaGW4M92uFZhWMpfIOCYIumeDqDikpv_Rh2MpRR_NCZlVFrvaEYHQzN1Os6WFBJNAI6uRagL4OJ8W41YklIfyhfSmUNsrdhgJNKY1NQq';

    $data = [
        "registration_ids" => $firebaseToken,
        "notification" => [
            "title" => $request->title,
            "body" => $request->body,
        ]
    ];
    $dataString = json_encode($data);

    $headers = [
        'Authorization: key=' . $SERVER_API_KEY,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);


    $input = $request->all();
    $title = $input['title'];
    $body = $input['body'];
    $user_id = $input['user_id'];

    $notification = new Notification([
     'title' => $title,
     'body' => $body,
     'user_id' => $user_id
   ]);


       $notification->save();

   return redirect('/notification')->with('message', 'Notification sent!');
}




}
