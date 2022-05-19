<?php

namespace App\Http\Requests;

use App\Models\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate as PermissionGate;

class MassDestroyGateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(PermissionGate::denies('gate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:gates,id',
        ];
    }
}
