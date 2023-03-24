<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\KindsOfOccasionResource;
use App\Models\Attendance;
use App\Models\Client;
use App\Models\KindsOfOccasion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserAlert;

class ClientsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {

        $search = $request->search ? $request->search : "";

        $data = ClientResource::collection(Client::with(['specialty'])->where('status', 1)->Search($search)->get());
        return apiResponse($data);
    }


    public function store(Request $request)
    {
        $request->request->add(['status' => 0]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'qualification' => '',
            'category' => '',
            'item' => '',
            'email' => 'required',
            'mobile' => 'required',
            'home_address' => 'required',
            'whatsapp_phone' => 'required',
            'specialty_id' => 'exists:clients_specialties,id',
            'phone' => '',
            'times_work' => '',
            'address_1' => '',
            'area_1' => '',
            'area_2' => '',
            'area_3' => '',
            'address_2' => '',
            'address_3' => '',
        ]);;

        if ($validator->fails()) {
            $message = api('required all');
            return errorResponse($validator->errors()->first(), $message);
        }

        $client = Client::create($request->all());

        if ($request->input('image', false)) {
            $client->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        $userAlert = UserAlert::create([
            'alert_text' => 'طلب انضمام عميل جديد',
            'alert_link' => 'يوجد طلب انضمام عميل جديدة',
        ]);
        $userAlert->users()->sync(1);
        return apiResponse(true);
    }
}
