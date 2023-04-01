<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceApiController extends Controller
{

    public function index()
    {
        $data = AttendanceResource::collection(Attendance::all())->
        where('user_id', Auth::id())->with(['user'])->get();

        return apiResponse($data);
    }

    public function store(Request $request)
    {
        // return $request;
        $request->request->add(['user_id' => Auth::id()]);

        $validator = Validator::make($request->all(), [
            'date' => 'required',
        ]);

        // if ($validator->fails()) {
        //     $message = api('required all');
        //     return errorResponse($validator->errors()->first(), $message);
        // }


        if ($request->start_time) {
            $attendance =  Attendance::create($request->all());
        }

        if ($request->end_time) {
            $attendance = Attendance::where('user_id', Auth::id())->where('date', $request->date)->where('end_time' , null)->first();
            if ($attendance) {
                $attendance->end_time = $request->end_time;
                $attendance->save();
            }else{
                return errorResponse('not found attendance', 'not found attendance');
            }
        }


       if ($request->tracking_array)
       {
           $attendance->tracking_array = $request->tracking_array;
           $attendance->save();
       }
        return apiResponse(true);
    }
}
