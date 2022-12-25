<?php

namespace App\Modules\Admin\Role\Requests;

use App\Services\Requests\ApiRequest;
use Illuminate\Support\Facades\Auth;

class RoleRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canDo(['SUPER_ADMINISTRATOR', 'ROLES_ACCESS']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'alias' => 'required'
        ];
    }
}
