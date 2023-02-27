<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientsSpecialtyResource;
use App\Models\ClientsSpecialty;

class ClientsSpecialtiesApiController extends Controller
{
    public function index()
    {
        $data = ClientsSpecialtyResource::collection(ClientsSpecialty::where('status', 1)->get());
        return apiResponse($data);
    }
}
