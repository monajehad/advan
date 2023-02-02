<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreClinicRequest;
use App\Http\Requests\UpdateClinicRequest;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\KindsOfOccasionResource;
use App\Models\Attendance;
use App\Models\Clinic;
use App\Models\KindsOfOccasion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserAlert;

class ClinicsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {

        $search = $request->search ? $request->search : "";

        $data = ClinicResource::collection(Clinic::with(['specialty'])->where('status', 1)->Search($search)->get());
        return apiResponse($data);
    }


    public function store(Request $request)
    {
        $request->request->add(['status' => 0]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'doctor_name' => 'required',
            'specialty_id' => 'required|exists:clinics_specialties,id',
            'phone' => 'required',
            'times_work' => 'required',
            'clinic_phone' => 'required',
            'address_1' => '',
            'address_2' => '',
            'address_3' => '',
        ]);;

        if ($validator->fails()) {
            $message = api('required all');
            return errorResponse($validator->errors()->first(), $message);
        }

        $clinic = Clinic::create($request->all());

        if ($request->input('image', false)) {
            $clinic->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        $userAlert = UserAlert::create([
            'alert_text' => 'طلب انضمام عيادة جديد',
            'alert_link' => 'يوجد طلب انضمام عيادة جديدة',
        ]);
        $userAlert->users()->sync(1);
        return apiResponse(true);
    }
}
