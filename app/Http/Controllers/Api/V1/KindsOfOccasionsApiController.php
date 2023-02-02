<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\KindsOfOccasionResource;
use App\Models\KindsOfOccasion;

class KindsOfOccasionsApiController extends Controller
{
    public function index()
    {
        $data = KindsOfOccasionResource::collection(KindsOfOccasion::where('status', 1)->get());
        return apiResponse($data);
    }

}
