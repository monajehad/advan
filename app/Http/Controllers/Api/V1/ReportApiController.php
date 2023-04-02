<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Hit;
use App\Models\HitsSamples;
use App\Models\Report;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ReportApiController extends Controller
{
    public function index(Request $request)
    {
        $report = Report::with(['user', 'type', 'client']);
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


        // reports to samples
        // $samples=Sample::
        // select('samples.id','samples.sample_id','samples.category_id'
        // ,'samples.user_id','samples.available','samples.date')->with(['category','item','sample', 'user', 'stock_available']);


        $responseData = [];
        $samples = Sample::where('user_id', Auth::id())->with(['category','item','sample', 'user', 'stock_available'])->get();
        foreach ($samples as $sample) {

            $responseData[] = [
                'اسم العينة' => $sample->sample->name,
                'العائلة' => $sample->category->name,
                'الكمية' => $sample->quantity_request,
                'التاريخ' => $sample->date,
            ];
        }
        if($request->search){
            $samples=$samples->where('samples.user_id',$request->user);
            // ->orWhere('category_names','like','%'.$request->search.'%');
        }
        $responseDataHit = [];
        $samples = Hit::where('user_id', Auth::id())->with(['client','user','samples'])->get();
        $reports = DB::table('hits_samples')
        ->join('hits', 'hits_samples.id', '=', 'hits.id')
        ->select('hits_samples.sample_id', 'hits.client_id', 'hits.date')
        ->where('Hits.user_id', 4)
        // ->with(['client','user','samples'])
        ->get();

        // hits to users
        $hits = Hit::with(['client', 'visit_type', 'user'])->where('Hits.user_id', Auth::id())->get();
        foreach ($hits as $hit) {

            $responseDataHit[] = [
                'اسم العميل' => $hit->client->name,
                'نوع الزيارة' => $hit->visit_type->name,
                'التاريخ' => $hit->date,
            ];
        }


        return apiResponse($responseData,$reports,$responseDataHit);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
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
        $data = new ReportResource($report->load(['user', 'type', 'client']));
        return apiResponse($data);
    }

    public function update($id , Request $request)
    {
        Report::find($id)->update($request->all());
        return apiResponse(true);
    }

}
