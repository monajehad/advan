<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportTypeResource;
use App\Models\ReportType;

class ReportTypeApiController extends Controller
{

    public function index()
    {
        $data = ReportTypeResource::collection(ReportType::where('status', 1)->get());
        return apiResponse($data);
    }
}
