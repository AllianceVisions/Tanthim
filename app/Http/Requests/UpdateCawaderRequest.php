<?php

namespace App\Http\Requests;

use App\Models\Cawader;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Auth;

class UpdateCawaderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cawader_edit') || Auth::user()->user_type == 'companiesAndInstitution'|| Auth::user()->user_type == 'client' || Auth::user()->user_type == 'governmental_entity'; 
    }

    public function rules()
    {
        return [
            'dob' => [
                'required',
                'date_format:' . config('panel.date_format'),
                'before:18 years ago'
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'degree' => [
                'required',
            ],
            'specializations.*' => [
                'integer',
            ],
            'specializations' => [
                'required',
                'array',
            ],
            'working_hours' => [
                'required',
                'integer',
                'min:1',
                'max:8',
            ],
            'identity_number' => [
                'string',
                'required',
                 'size:10',
                 'regex:/(10)[0-9]{8}|(11)[0-9]{8}|(12)[0-9]{8}|(13)[0-9]{8}|(14)[0-9]{8}|(15)[0-9]{8}|(20)[0-9]{8}|(21)[0-9]{8}|(22)[0-9]{8}|(23)[0-9]{8}|(24)[0-9]{8}|(25)[0-9]{8}/',                
            ],
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . request()->user_id,
            ], 
            'photo' => [
                'required',
            ], 
            'phone' => [
                'required',
                'size:10',
                'regex:/(05)[0-9]{8}/', 
                'unique:users,phone,' . request()->user_id,
            ], 
            'skills.*' => [
                'integer',
            ],
            'skills' => [
                'array',
            ],
            'experience_years' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
    public function messages()
    {
    return [
        'dob.before'=>'يجب ألا يقل سنك عن 18 عاما',
    ];
    }
        
}