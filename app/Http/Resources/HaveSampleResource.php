<?php

namespace App\Http\Resources;

use App\Models\Hit;
use App\Models\HitsSamples;
use App\Models\Sample;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class HaveSampleResource extends JsonResource
{
    public function toArray($request)
    {


        $quantity_rest = HitsSamples::where('sample_id' , $this->id)->whereHas('hits', function($q){
            $q->where('user_id', Auth::id())->where('status' , 1);
        })->sum('quantity');

        $quantity_received = Sample::where('user_id', Auth::id())->where('sample_id' , $this->sample_id)->where('status' , 2)->sum('quantity');
        return [
            'id' => $this->id,
            'name' => optional($this->sample)->name,
            'quantity_received' => (int) $quantity_received,
            'quantity_not_received' => (int) Sample::where('user_id', Auth::id())->where('sample_id' , $this->sample_id)->where('status' , 2)->sum('quantity_request') - $quantity_received,
            'quantity_have' => (int) $quantity_received - $quantity_rest,
        ];
    }
}
