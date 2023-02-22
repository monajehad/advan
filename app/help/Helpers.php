<?php

namespace App\Http\Helpers;

use App\Models\Notification;
use App\Models\Setting;
use App\Models\System_Constants;
use App\Models\SmsLog;
use Illuminate\Support\Facades\Auth;

class Helpers
{

    public static function SendSms($mgs_sms,$mobile,$customer_id,$function_name=''){
        $setting = Setting::where('id',1)->first();

        if($setting){
            $sms_username = $setting->sms_username;
            $sms_password = $setting->sms_password;
            $sms_name = $setting->sms_name;
            if($mobile==0){

                $mobile = $setting->mobile;
            }

            $server_sms = System_Constants::where('type','server_sms')->where('value',$setting->sms_server)->first();
            if($server_sms){
                $url = $server_sms->value2;
                $url = str_replace('[username]',urlencode($sms_username),$url);
                $url = str_replace('[password]',urlencode($sms_password),$url);
                $url = str_replace('[sender]',urlencode($sms_name),$url);

                $url = str_replace('[api_key]',urlencode($setting->api_key),$url);
                $url = str_replace('[msg]',urlencode($mgs_sms),$url);

                $mobile = substr($mobile, 0, 1) == '0' ? substr($mobile,1) :  $mobile;
                $mobile = '972'.$mobile;
                $url = str_replace('[mobile]',$mobile,$url);

                $a = @file_get_contents($url);
                $a = explode(':',$a)[0];

                $log = new SmsLog();
                $log->customer_id = $customer_id;
                $log->mobile = $mobile;
                $log->date_time = date('Y-m-d H:i:s');
                $log->code_result = trim($a);
                $log->msg = $mgs_sms;
                $log->function_name = $function_name;
                if(Auth::check()){
                $log->user_id = Auth::user()->id;
                $log->network_id = Auth::user()->network_id;
                }
                $saved = $log->save();
            }
        }
    }

    public static function SendNotifications($title,$details,$url,$id_user,$type,$type_notifiable){

            $not=new Notification();
            $not->title=$title;
            $not->details=$details;
            $not->url=$url;
            $not->id_user=$id_user;
            $not->type=$type;
            $not->type_notifiable=$type_notifiable;
            $not->user_id = Auth::user()->id;
            $not->save();
    }



}
