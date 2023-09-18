<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{

    public function authorize()
    {
        return true;

    }


    public function rules()
    {
        return [
            'name' => 'required',
            'user_id' => 'nullable',
            'manager_id' => 'nullable',
            'address' => 'required',
        ];
    }
}
