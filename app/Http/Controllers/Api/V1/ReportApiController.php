<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ReportApiController extends Controller
{
    public function index(Request $request)
    {
        $report = Report::with(['user', 'type', 'clinic']);
            // ->where('user_id', Auth::id());


        if ($request->date) {
            $report = $report->where('date', 'LIKE', $request->date . '%');
        }

        if ($request->from_date && $request->to_date) {
            $report = $report->whereBetween('date', [$request->from_date, $request->to_date]);
        }
        if ($request->type) {
            $report = $report->where('status', $request->type);
        }
        if ($request->search) {
            $report = $report->where('title', 'LIKE', $request->search . '%');
        }
        $report = $report->get();
        $data = ReportResource::collection($report);
        return apiResponse($data);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'clinic_id' => 'required|exists:clinics,id',
            'date' => 'required',
            'name' => 'required',
            'time' => 'required',
            'title' => 'required',
            'note' => '',
            'hits_id' => '',
            'description' => 'required',
            'type_id' => 'required|exists:report_types,id',
        ]);;

        if ($validator->fails()) {
            $message = api('required all');
            return errorResponse($validator->errors()->first(), $message);
        }

        $request->request->add(['user_id' => Auth::id() , 'status' => 1]);


        $hit = Report::create($request->all());

        return apiResponse(true);
    }


    public function show(Report $report)
    {
        $data = new ReportResource($report->load(['user', 'type', 'clinic']));
        return apiResponse($data);
    }

    public function update($id , Request $request)
    {
        Report::find($id)->update($request->all());
        return apiResponse(true);
    }

}
