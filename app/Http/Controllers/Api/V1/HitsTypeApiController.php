<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\HitsTypeResource;
use App\Models\HitsType;

class HitsTypeApiController extends Controller
{
    public function index()
    {
        $data = HitsTypeResource::collection(HitsType::where('status', 1)->get());
        return apiResponse($data);
    }
}
