<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Hit;
use App\Models\Sample;
use App\Models\SystemConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    const PAGINATION_NO=5;

    public function index(Request $request)
    {

        $clients=Client::
        leftJoin('system_constants as category_constants', function($join) {
            $join->on('category_constants.value', '=', 'clients.category')->where('category_constants.type','category')->whereNull('category_constants.deleted_at');
        })
        ->select('category_constants.name as category_name','clients.id','clients.category','clients.name')
        ->with(['specialty','clientHits']);


        $clients=$clients->orderBy('id','desc')->paginate(self::PAGINATION_NO);

        $responseData = [];
        foreach ($clients as $client) {
            $visits = Hit::where('client_id', $client->id)->get();
            $sampleCount = $visits->sum('number_samples');

            $responseData[] = [
                'client_name' => $client->name,
                'client_type' => $client->category_name,
                'sample_count' => $sampleCount,
                'visit_date' => $visits->pluck('date')->first(),
            ];
        }

        return response()->json($responseData);




    }

    public function getHit(Request $request)
    {

        $currentMonth = Carbon::now()->month;

         $visits = DB::table('hits')
        //  ->where('user_id', Auth::id())
                ->whereMonth('date', $currentMonth)
                ->count();

        // visits rate
        $totalVisits = Hit::count();
       $statusOneVisits = Hit::where('status', 1)
    //    ->where('user_id', Auth::id())
       ->count();

         if ($totalVisits > 0) {
             $visitRate = ($statusOneVisits / $totalVisits) * 100;
            } else {
                $visitRate = 0;
            }



        return response()->json([':الزيارات لشهر الحالي'=>$visits
      ,'الزيارات المنجزة:'=>$visitRate
    ]);

    }

}
