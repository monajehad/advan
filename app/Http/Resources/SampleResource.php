<?php

namespace App\Http\Resources;

use App\Models\Hit;
use App\Models\HitsSamples;
use App\Models\Sample;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SampleResource extends JsonResource
{
    public function toArray($request)
    {


        $quantity_rest = HitsSamples::where('sample_id' , $this->id)->whereHas('hits', function($q){
        $q->where('user_id', Auth::id())->where('status' , 1);
    })->sum('quantity');

    // $sample=Sample::leftJoin('system_constants as unit_constants', function($join) {
    //     $join->on('unit_constants.value', '=', 'samples.unit')->where('unit_constants.type','unit')->whereNull('unit_constants.deleted_at');
    // })->select('unit_constants.name as unit_name','samples.id','samples.sample_id','samples.unit')
    // ->where('id',$this->id)
    // ->where('user_id', Auth::id());
    // ;
    // ->with(['category','item','sample', 'user', 'stock_available']);


        return [
            'id' => $this->id,
            'name' => optional($this->sample)->name,
            'unit'=>$this->unit,
            'date'=>$this->date,
            'quantity_request' => (int) $this->quantity_request,
            'quantity_received' => (int) $this->quantity,
            'quantity_rest' => (int) $this->quantity - $quantity_rest,
            'received_date' =>  $this->received_date,
            'status' =>  Sample::STATUS_SELECT[$this->status],
        ];
    }
}
