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
use App\Models\Hit;
use App\Models\KindsOfOccasion;
use App\Models\Sample;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserAlert;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClientsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request,$clientId)
    {

        $search = $request->search ? $request->search : "";

        $data = ClientResource::collection(Client::with(['specialty'])->where('status', 1)->Search($search)->get());



        return apiResponse($data );
    }

    public function show($clientId)
{
    $data = ClientResource::collection(Client::with(['specialty'])->where('status', 1)->where('id' , $clientId)->get());
//current Month Visits
    $currentMonthVisits = DB::table('hits')
    ->where('client_id', $clientId)
    ->whereMonth('date', Carbon::now()->month)
    ->count();
// samples to client
$total_samples = DB::table('hits')
->where('client_id', $clientId)
->sum('number_samples');

// average hits
    $visits =
        DB::table('hits')
            ->select('client_id',  DB::raw('AVG(id) as avg_visits'))
            ->where('client_id', $clientId)
            ->groupBy('client_id')
            ->get();
    return apiResponse([$data,'زيارات الشهر الحالي'=>$currentMonthVisits,
    'اجمالي العينات المستلمة'=>$total_samples,
    'متوسط الزيارات الشهرية'=>$visits
]);

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
