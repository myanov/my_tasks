<?php

namespace App\Modules\Admin\Task\Controllers\Api;

use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\Task\Requests\TaskRequest;
use App\Modules\Admin\Task\Services\TaskService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
	public function __construct(TaskService $taskService)
	{
		$this->service = $taskService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
	{
		$this->authorize('view', Task::class);

		$tasks = $this->service->getTasks();

		return ResponseService::success([
			'items' => $tasks,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(TaskRequest $request)
	{
		$this->authorize('create', Task::class);

		try {
			$task = $this->service->save($request);
		} catch (\InvalidArgumentException $exception) {
			return ResponseService::sendJsonResponse(false, 501, ['error' => $exception->getMessage()]);
		}

		return ResponseService::sendJsonResponse(true, JsonResponse::HTTP_CREATED, [], ['item' => $task]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Modules\Admin\Task\Models\Task  $task
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Task $task)
	{
		$this->authorize('view', Task::class);

		return ResponseService::success(['item' => $task->toArray()]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Modules\Admin\Task\Models\Task  $task
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(TaskRequest $request, Task $task)
	{
		$this->authorize('edit', Task::class);

		try {
			$task = $this->service->update($request, $task);
		} catch (\InvalidArgumentException $exception) {
			return ResponseService::sendJsonResponse(false, JsonResponse::HTTP_INTERNAL_SERVER_ERROR, [
				'error' => $exception->getMessage(),
			]);
		}

		return ResponseService::sendJsonResponse(true, JsonResponse::HTTP_OK, [], ['item' => $task]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Modules\Admin\Task\Models\Task  $task
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Task $task)
	{
		$this->authorize('delete', Task::class);

		if (!$task->delete()) {
			return ResponseService::sendJsonResponse(false, JsonResponse::HTTP_INTERNAL_SERVER_ERROR, [
				'error',
				'Не удалось удалить задачу',
			]);
		}

		return ResponseService::sendJsonResponse(true, JsonResponse::HTTP_NO_CONTENT);
	}
}
