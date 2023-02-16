<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('user_edit');
    // }

    public function rules()
    {
        return [

            'email' => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
            ],

            'name' => [
                'string',
                'required',
                'unique:users,name,' . request()->route('user')->id,
            ],
            'qualification' => [
                'string',
                'required',
            ],

            'phone' => [
                'string',
                // 'required',
                'unique:users',
            ],
            'mobile' => [
                'string',
                'required',
                'unique:users,mobile,' . request()->route('user')->id,
            ],
            'jobId' => [
                'string',
                'required',
                'unique:users,jobId,' . request()->route('user')->id,

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


            'status' => [
                'required',
            ],
        ];
    }
}
