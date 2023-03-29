<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
define('DIR_UPLOAD', 'uploads');

function assetUpload($dir)
{
    return asset(DIR_UPLOAD . '/' . $dir);
}

function getSetting($settingname = 'sitename')
{

    if (\App\Models\Setting::where('namesetting', '=', $settingname)->count() > 0) {

        return \App\Models\Setting::where('namesetting', $settingname)->get()[0]->value;
    }

}

function saveOriginalImage($image, $direction)
{
    $dir = DIR_UPLOAD . '/' . $direction;
    File::exists(myPublic() . $dir) or File::makeDirectory(myPublic() . $dir, 755, true);
    $img = Image::make($image);
    $mime = explode('/', $img->mime)[1];
    $file_name = rand(100, 9999999) . '.' . $mime;
    $img->save(myPublic() . $dir . '/' . $file_name);
    return $file_name;
}

function myPublic()
{
    return base_path() . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR;
}


function api($key, $placeholder = [], $locale = null)
{

    $group = 'api';
    if (is_null($locale))
        $locale = config('app.locale');
    $key = trim($key);
    $word = $group . '.' . $key;
    if (\Illuminate\Support\Facades\Lang::has($word))
        return trans($word, $placeholder, $locale);

    $messages = [
        $word => $key,
    ];

    app('translator')->addLines($messages, $locale);
        $translation_file = base_path() . '/resources/lang/ar/' . $group . '.php';
        $fh = fopen($translation_file, 'r+');
        $new_key = "    '$key' => '$key',\n];\n";
        fseek($fh, -4, SEEK_END);
        fwrite($fh, $new_key);
        fclose($fh);
    return trans($word, $placeholder, $locale);
//    return $key;

}



if (!function_exists('send_notification_fcm')) {
    function send_notification_fcm($token, $notification)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $extranotification = [
            'message' => $notification,
            'moredata' => 'dd'
        ];

        /**
         *
         * {
         * "notification": {
         * "title": "Portugal vs. Denmark",
         * "body": "5 to 1",
         * "icon": "firebase-logo.png",
         * "click_action": "http://localhost:8081"
         * },
         * "to": "YOUR-IID-TOKEN"
         * }
         **/

        if (!is_array($token)) {
            $token = [$token];
        }

        $fcmNotification = [
            'registration_ids' => $token, //multple token array
            //'to' => $token, //single token
            'notification' => $notification,
            'data' => $notification
        ];
        $headers = [
            'Authorization: key=' . config('fcm')['fcm_key'],
            'Content-Type: application/json'
        ];
        return curl($fcmUrl, $headers, $fcmNotification);
    }
}

if (!function_exists('curl')) {
    function curl($url, $headers, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}


function sms($phone , $message)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://int.mtcsms.com/sendsms.aspx?username='.getSetting('username_sms').'&password='.getSetting('password_sms').'&from='.getSetting('from_sms').'&to='.$phone.'&msg='.$message.'&type=0',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;

}

