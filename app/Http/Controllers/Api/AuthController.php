<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserAlert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    protected $expiredMinuteCode = 2;
    protected $expiresAtAccessToken = 9999; // week


    public function login(Request $request)
    {
        $validator = $this->Loginvalidator($request);

        if ($validator->fails()) {
            $message = api('required all');
            return errorResponse($validator->errors()->first(), $message);
        }
        $user = User::where('email' , $request->email)->first();
        if ($user && $user->status != 1) {

            $message = api('user_not_active');
            return errorResponse($message);
        }

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            $message = api('error login');
            return errorResponse(null, $message, UNAUTHORIZED);
        }

        $user = $request->user();

        if($request->fcm_token) {
            $user->fcm_token= $request->fcm_token;
            $user->save();
        }

        $tokenResult = $this->createToken($user, $request);

        $data = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user' => new UserResource($user),
        ];

        return apiResponse($data);
    }

    private function Loginvalidator(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);
    }

    protected function createToken($user, $request)
    {
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks($this->expiresAtAccessToken);
        $token->save();
        return $tokenResult;
    }

    public function register(Request $request)
    {
        $validator = $this->Registervalidator($request);

        if ($validator->fails()) {
            $message = api('required all');
            return errorResponse($validator->errors()->first(), $message);
        }

        $user = DB::transaction(function () use ($request) {
            $user = $this->createUser($request);
            return $user;
        });

        $user = $this->genarateAndSaveCode($user);
        $data = [
            'email' => $user->email,
            'name' => $user->name,
            // 'user_name' => $user->user_name,
            'mobile' => $user->mobile,
        ];

        $userAlert = UserAlert::create([
            'alert_text' => 'طلب انضمام جديد',
            'alert_link' => 'يوجد طلب انضمام مندوب جديدة',
        ]);
        $userAlert->users()->sync(1);
        $message = api('success register');
        return apiResponse($data, $message);

    }

    private function Registervalidator(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|string|email|unique:users|max:255',
            'mobile' => 'required|string|unique:users',
            // 'user_name' => 'required|string|unique:users',
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    private function createUser(Request $request)
    {
        $user = new User([
            'name' => $request->name,
            // 'user_name' => $request->user_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $request->password,
            'user_type' => '2',
            'status_id' => '1'
        ]);
        $user->save();
        $user->roles()->sync('2');

        return $user;
    }

    private function genarateAndSaveCode($user)
    {
        $code = random_int(1000, 9999);
        $user->code = $code;
        $user->save();
        return $user;
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return successResponse(true,'تم تسجيل الخروج بنجاح');
    }

    public function user(Request $request)
    {
        // $user = $request->id;
        // if(!$user)
        //     return successResponse(false);

        return apiResponse(new UserResource($request));


    }

    public function update_profile(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);

        $user->fill(Arr::except($request->all(), ['password' , 'image']))->save();


        if ($request->file('image')) {
            $image = saveOriginalImage($request->file('image'),User::DIR_UPLOAD );
            $user->image = $image;
            $user->save();
        }

        $data = new UserResource($user);

        return apiResponse($data);
    }

    public function update_passwprd(Request $request)
    {

        $validator = $this->UpdatePasswordValidator($request);

        if ($validator->fails()) {
            $message = trans('cruds.api.required_all');
            return errorResponse($validator->errors()->first(), $message);
        }
        $id = Auth::id();
        $user = User::find($id);

        if ($request->old_password == '') {

            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            return successResponse(true);
        } else {
            if (Hash::check($request->old_password, $user->password)) {
                $user->fill([
                    'password' => Hash::make($request->new_password)
                ])->save();
                return successResponse(true);

            } else {
                return errorResponse(trans('cruds.api.similarity'));
            }

        }
    }

    private function UpdatePasswordValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'new_password' => 'required',
            'confirmed_password' => 'required|same:new_password',
        ]);
    }

}
