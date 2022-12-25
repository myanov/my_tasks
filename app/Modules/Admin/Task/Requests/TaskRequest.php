<?php

namespace App\Modules\Admin\Task\Requests;

use App\Services\Requests\ApiRequest;

class TaskRequest extends ApiRequest
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
            'task_category_id' => ['required', 'numeric'],
            'task_status_id' => ['required', 'numeric'],
            'requirement_id' => ['required', 'numeric'],
            'responsible_id' => ['required', 'numeric']
        ];
    }
}
