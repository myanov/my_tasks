<?php

namespace App\Modules\Admin\Task\Services;

use App\Modules\Admin\Task\Models\Requirement;
use App\Modules\Admin\Task\Requests\RequirementRequest;
use Illuminate\Support\Facades\Auth;

class RequirementService
{
    public function getRequirements()
    {
        return Requirement::with('tasks')->get()->toArray();
    }

    public function save(RequirementRequest $request)
    {
        $requirement = new Requirement();

        $this->fillRequirement($request, $requirement);

        if (!$requirement->save())
        {
            throw new \InvalidArgumentException('Не удалось создать требование');
        }

        return $requirement->toArray();
    }

    public function update(RequirementRequest $request, Requirement $requirement)
    {
        $this->fillRequirement($request, $requirement);

        if (!$requirement->save())
        {
            throw new \InvalidArgumentException('Не удалось изменить требование');
        }

        return $requirement->toArray();
    }

    private function fillRequirement(RequirementRequest $request, Requirement $requirement)
    {
        $requirement->fill($request->only($requirement->getFillable()));
        $requirement->requirement_status_id = (int) $request->get('requirement_status_id');
        $requirement->creator_id = Auth::user()->id;
    }
}
