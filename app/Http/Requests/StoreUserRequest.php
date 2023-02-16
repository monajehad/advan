<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('user_create');
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
                'required',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'phone' => [
                'string',
                // 'required',
                'unique:users',
            ],
            'mobile' => [
                'string',
                'required',
                'unique:users',
            ],
            'jobId' => [
                'string',
                'required',
                'unique:users',
            ],
            'password' => [
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
            // 'facebook'=> [
            //     'string',
            //     'nullable',
            // ],
            // 'instagram'=> [
            //     'string',
            //     'nullable',
            // ],
            // 'website'=> [
            //     'string',
            //     'nullable',
            // ],
            'category'=> [
                'string',
                'nullable',
            ],

            'status' => [
                // 'required',
            ],
        ];
    }
}
