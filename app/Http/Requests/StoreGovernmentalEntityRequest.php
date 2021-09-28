<?php

namespace App\Http\Requests;

use App\Models\GovernmentalEntity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGovernmentalEntityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('governmental_entity_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
