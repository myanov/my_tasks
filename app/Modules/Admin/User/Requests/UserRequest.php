<?php

namespace App\Modules\Admin\User\Requests;

use App\Services\Requests\ApiRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('password', ['required', 'confirmed'], function ($input) {
            if (!empty($input->password) || (empty($input->password) && ($this->route()->getName() != 'api.users.update')))
            {
                return true;
            }
            return false;
        });

        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone' => 'nullable|phone',
            'company_id' => 'nullable',
            'role_id' => 'required'
        ];
    }
}
