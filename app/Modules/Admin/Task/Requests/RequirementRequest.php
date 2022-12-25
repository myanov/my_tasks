<?php

namespace App\Modules\Admin\Task\Requests;

use App\Services\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class RequirementRequest extends ApiRequest
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
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'title' => ['required'],
			'requirement_status_id' => ['required', 'numeric'],
		];
	}
}
