<?php

namespace App\Http\Requests;

use App\Models\Visitor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVisitorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('visitor_edit');
    }

    public function rules()
    {
        return [ 
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . request()->user_id,
            ], 
            'phone' => [
                'required',
                'size:10',
                'regex:/(05)[0-9]{8}/', 
            ], 
            'photo' => [
                'required',
            ], 
            'national' => [
                'string',
                'required',
            ], 
        ];
    } 
}
