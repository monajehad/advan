<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use DB;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        // parent::__construct();
    }
    ///////////////////////////////////////////
    public function getIndex()
    {
        return view('auth.login');
    }
    ///////////////////////////////////////////
    public function postIndex(Request $request)
    {
        // dd($request->all());
        $field = 'username';

        $username = $request->get('username');
        $password = $request->get('password');
        $remember_token = $request->get('remember_token');

        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where("$field",$username)->first();
        if($user != ''){
            if($user->status != 1){
                return redirect('/')->with(['danger' => 'عذرا ، الحساب معطل الرجاء مراجعة الإدارة']);
            }
        }else{
            return redirect('/')->with(['danger' => 'عذرا ، خطأ في البيانات المدخلة']);
        }

        $admin[$field] = $username;
        $admin['password'] = $password;
        // $admin['status'] = 1;

        if (Auth::attempt($admin, $remember_token))
        {

            $token = Str::random(64);
            $user->token = $token;
            $user->save();
            return redirect()->intended('/home');
        }
        else
        {
            return redirect('/')->with(['danger' => 'عذرا ، خطأ في البيانات المدخلة']);
        }
    }
    ///////////////////////////////////////////
    public function getLogout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

      public function elogin($token){
          $user = User::where("token",$token)->first();
          if(!$user){
              return redirect('/login');
          }
          Auth::loginUsingId($user->id);
           return redirect()->to('/home');
    }
}
