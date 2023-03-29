<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('client_create');
    // }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'qualification' => [
                'string',
                // 'required',
            ],
            'specialty_id' => [
                // 'required',
                'integer',
            ],
            'email' => [
                'string',
                // 'required',
            ],
            'phone' => [
                'string',
                'nullable',

            ],
            'mobile' => [
                'string',
                'required',

            ],
            'home_address'=> [
                'string',
                'nullable',
            ],
            'whatsapp_phone'=> [
                'string',
                'nullable',
            ],
            'item'=> [
                'string',
                'nullable',
            ],
            'facebook'=> [
                'string',
                'nullable',
            ],
            'instagram'=> [
                'string',
                'nullable',
            ],
            'website'=> [
                'string',
                'nullable',
            ],
            'category'=> [
                'string',
                'nullable',
            ],
            'area_1' => [
                'string',
                'nullable',
            ],
            'area_2' => [
                'string',
                'nullable',
            ],
            'area_2' => [
                'string',
                'nullable',
            ],
            'address_1' => [
                'string',
                'nullable',
            ],
            'address_2' => [
                'string',
                'nullable',
            ],
            'address_3' => [
                'string',
                'nullable',
            ],

            // 'status' => [
            //     'required',
            // ],
        ];
    }
}
