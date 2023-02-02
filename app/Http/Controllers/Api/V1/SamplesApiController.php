<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSampleRequest;
use App\Http\Requests\UpdateSampleRequest;
use App\Http\Resources\HaveSampleResource;
use App\Http\Resources\SampleResource;
use App\Models\Attendance;
use App\Models\HitsSamples;
use App\Models\Sample;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserAlert;

class SamplesApiController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->status)) {
            $data = SampleResource::collection(Sample::all());
            // with(['sample', 'user', 'stock_available'])->where('user_id', Auth::id())->where('status', $request->status)->get()
        } else {
            $data = SampleResource::collection(Sample::all());
            // with(['sample', 'user', 'stock_available'])->where('user_id', Auth::id())->get()
        }

        return apiResponse([
            'data' => $data,
            'sample_received' => (int)Sample::where('user_id', Auth::id())->where('status', 2)->sum('quantity'),
            'sample_used' => (int)HitsSamples::whereHas('hits', function ($q) {
                $q->where('user_id', Auth::id())->where('status', 1);
            })->sum('quantity'),
        ]);

    }

    public function store(Request $request)
    {
        $request->request->add(['user_id' => Auth::id(), 'status' => 0]);

        $validator = Validator::make($request->all(), [
            'sample_id' => 'required|exists:sample_stocks,id',
            'quantity_request' => 'required',
        ]);

        if ($validator->fails()) {
            $message = api('required all');
            return errorResponse($validator->errors()->first(), $message);
        }

        Sample::create($request->all());


        $userAlert = UserAlert::create([
            'alert_text' => 'طلب عينة جديد',
            'alert_link' => 'يوجد طلب طلب عينة جديدة',
        ]);
        $userAlert->users()->sync(1);

        return apiResponse(true);
    }


    public function confirm($id)
    {
        $sample = Sample::find($id);
        if ($sample) {
            $sample->status = 2;
            $sample->received_date = Carbon::parse(Carbon::now())->format('Y-m-d');
            $sample->save();
            return apiResponse(true);
        } else {
            return apiResponse(false);
        }
    }

    public function have()
    {

        $data = Sample::with(['sample', 'user', 'stock_available'])->where('status' , 2)->get()->unique('sample_id');
        // ->where('user_id', Auth::id())
        return apiResponse(HaveSampleResource::collection($data));
    }
}
