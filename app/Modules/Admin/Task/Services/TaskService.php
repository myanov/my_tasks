<?php

namespace App\Modules\Admin\Task\Services;

use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\Task\Models\TaskStatus;
use App\Modules\Admin\Task\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function getTasks() : array
    {
        $statuses = TaskStatus::with('tasks')->get();

        return $statuses->toArray();
    }

    public function save(TaskRequest $request) : array
    {
        $task = new Task();
        $this->fillTask($request, $task);

        if (!$task->save())
        {
            throw new \InvalidArgumentException('Не удалось создать задачу');
        }

        return $task->toArray();
    }

    public function update(TaskRequest $request, Task $task) : array
    {
        $this->fillTask($request, $task);

        if (!$task->save())
        {
            throw new \InvalidArgumentException('Не удалось обновить задачу');
        }

        return $task->toArray();
    }

    private function fillTask(TaskRequest $request, Task $task) : void
    {
        $task->fill($request->only($task->getFillable()));
        $task->task_category_id = (int) $request->get('task_category_id');
        $task->task_status_id = (int) $request->get('task_status_id');
        $task->requirement_id = (int) $request->get('requirement_id');
        $task->responsible_id = (int) $request->get('responsible_id');
        $task->creator_id = Auth::user()->id;
    }
}
