<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClinicsSpecialtyResource;
use App\Models\ClinicsSpecialty;

class ClinicsSpecialtiesApiController extends Controller
{
    public function index()
    {
        $data = ClinicsSpecialtyResource::collection(ClinicsSpecialty::where('status', 1)->get());
        return apiResponse($data);
    }
}
