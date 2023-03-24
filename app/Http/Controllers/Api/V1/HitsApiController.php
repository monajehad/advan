<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHitRequest;
use App\Http\Requests\UpdateHitRequest;
use App\Http\Resources\HitResource;
use App\Models\Clinic;
use App\Models\Hit;
use App\Models\HitsSamples;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class HitsApiController extends Controller
{
    public function index(Request $request)
    {
        $hit = Hit::with(['client', 'visit_type', 'user'])

            ->where('user_id', Auth::id());
        if ($request->date) {
            $hit = $hit->where('date', 'LIKE', $request->date . '%');
        }
        if ($request->type) {
            $hit = $hit->where('type', $request->type);
        }
        if ($request->status) {
            $hit = $hit->where('status', $request->status);
        }
        $hit = $hit->orderByDesc('status')->get();
        $data = HitResource::collection($hit);
        return apiResponse($data);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:clients,id',
            'date' => '',
            'time'=>'',
            'visit_type_id' => 'nullable|exists:hits_types,id',
            'duration_visit' => '',
            'number_samples' => '',
            'address' => '',
            'category' => '',
            'samples' => '',
            'note' => '',
            'status' => 'required',
            'type' => 'required',
            'kinds_of_occasions' => '',


        ]);

        if ($validator->fails()) {
            $message = api('required all');
            return errorResponse($validator->errors()->first(), $message);
        }

//        if ($request->date_time)
//        {
//            $date = explode(' ', $request->date_time)[0];
//            $all_hit = Hit::where('user_id', Auth::id())->where('date_time', 'LIKE', $date . '%')->get();
//            foreach ($all_hit as $value)
//            {
//
//                if($value->date_time != null && $value->duration_visit != null)
//                {
//                    $duration_visitv_old = explode(':', $value->duration_visit);
//                    $hours_old = $duration_visitv_old[0];
//                    $minutes_old = $duration_visitv_old[1];
//                    $all_minutes_old = $hours_old * 60 + $minutes_old;
//                    $date_carbon_start_old = Carbon::parse($value->date_time);
//                    $date_carbon_end_old = Carbon::parse($value->date_time)->addMinute($all_minutes_old);
//
//                    $duration_visitv_new = explode(':', $value->duration_visit);
//                    $hours_new = $duration_visitv_new[0];
//                    $minutes_new= $duration_visitv_new[1];
//                    $all_minutes_new = $hours_new * 60 + $minutes_new;
//                    $date_carbon_start_new = Carbon::parse($request->date_time);
//                    $date_carbon_end_new = Carbon::parse($value->date_time)->addMinute($all_minutes_new);
//
////                    return [
////                        '$date_carbon_start_new' => $date_carbon_start_new,
////                        '$date_carbon_start_old' => $date_carbon_start_old,
////                        '$date_carbon_end_old' => $date_carbon_end_old,
////                        '$date_carbon_end_new' => $date_carbon_end_new,
////                        'dd' =>$date_carbon_start_new >= $date_carbon_start_old &&  $date_carbon_start_new <= $date_carbon_end_old  && $date_carbon_end_new >= $date_carbon_start_old &&  $date_carbon_end_new <= $date_carbon_end_old,
////                    ];
//
//                    if ($date_carbon_start_new >= $date_carbon_start_old &&  $date_carbon_start_new <= $date_carbon_end_old  && $date_carbon_end_new >= $date_carbon_start_old &&  $date_carbon_end_new <= $date_carbon_end_old  )
//                    {
//                        $message = api('time_conflict');
//                        return errorResponse($message);
//                    }
//                }
//
//            }
//        }

        // $request->request->add(['user_id' => Auth::id(), 'sms_id' => $request->kinds_of_occasions]);

        $hit = Hit::create($request->all());

//        if ($request->kinds_of_occasions && $request->sms_message) {
//            $clinic = Clinic::find($request->clinic_id);
//            if ($clinic->phone)
//            {
//                $sms =  sms($clinic->phone, $request->sms_message);
//                \App\Models\SmsMessage::create([
//                    'title' => 'زيارة',
//                    'message' => $request->sms_message,
//                    'user_id' => Auth::id(),
//                    'doctor_id' => $request->clinic_id,
//                    'status' => $sms,
//                ]);
//            }
//        }

        // if ($request->categories) {
        //     $categories = explode(",", $request->categories);
        //     $hit->categories()->sync($categories);
        // }


        if ($request->samples) {
            $sample1 = collect($request->samples);
            foreach ($sample1 as $sample) {
                HitsSamples::create([
                    'hit_id' => $hit->id,
                    'sample_id' => $sample['id'],
                    'quantity' => $sample['quantity'],
                ]);
            }
        }

        // if ($request->doctors) {
        //     $doctors = explode(",", $request->doctors);
        //     $hit->doctors()->sync($doctors);
        // }

        return apiResponse(new HitResource($hit));
    }


    public function show(Hit $hit)
    {
        $data = new HitResource($hit->load(['client', 'visit_type', 'user']));
        return apiResponse($data);
    }

    public function update(Request $request, $id)
    {
        Hit::find($id)->update($request->all());
        return apiResponse(true);
    }

}
