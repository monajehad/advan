<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVacationRequestRequest;
use App\Http\Requests\UpdateVacationRequestRequest;
use App\Http\Resources\VacationRequestResource;
use App\Models\Attendance;
use App\Models\VacationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class VacationRequestApiController extends Controller
{
    public function index()
    {
        $data = VacationRequestResource::collection(VacationRequest::all());
        // where('user_id', Auth::id())->with(['user'])->get()
        return apiResponse($data);
    }


    public function store(Request $request)
    {
        $request->request->add(['user_id' => Auth::id() , 'status' => 0]);

        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
        ]);;

        if ($validator->fails()) {
            $message = api('required all');
            return errorResponse($validator->errors()->first(), $message);
        }
        $start_date = \Carbon\Carbon::parse($request->start_date);
        $end_date = \Carbon\Carbon::parse($request->end_date);

        $diff_in_days = $start_date->diffInDays($end_date);

        $request->request->add(['days' => $diff_in_days]);

        VacationRequest::create($request->all());
        return apiResponse(true);
    }
}
