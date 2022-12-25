<?php

namespace App\Modules\Admin\Task\Controllers\Api;

use App\Modules\Admin\Task\Models\Requirement;
use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\Task\Requests\RequirementRequest;
use App\Modules\Admin\Task\Services\RequirementService;
use App\Services\Response\ResponseService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequirementController extends Controller
{
	public function __construct(RequirementService $requirementService)
	{
		$this->service = $requirementService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(): JsonResponse
	{
		$this->authorize('view', Requirement::class);

		return ResponseService::success(['items' => $this->service->getRequirements()]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(RequirementRequest $request): JsonResponse
	{
		$this->authorize('create', Requirement::class);

		try {
			$requirement = $this->service->save($request);
		} catch (\InvalidArgumentException $exception) {
			return ResponseService::sendJsonResponse(false, JsonResponse::HTTP_INTERNAL_SERVER_ERROR, [
				'error' => $exception->getMessage(),
			]);
		}

		return ResponseService::sendJsonResponse(true, JsonResponse::HTTP_CREATED, [], ['item' => $requirement]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Modules\Admin\Task\Models\Task  $task
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Requirement $requirement)
	{
		$this->authorize('view', Requirement::class);

		return ResponseService::success(['item' => $requirement->toArray()]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Modules\Admin\Task\Models\Task  $task
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(RequirementRequest $request, Requirement $requirement)
	{
		$this->authorize('edit', Requirement::class);

		try {
			$this->service->update($request, $requirement);
		} catch (\InvalidArgumentException $exception) {
			return ResponseService::sendJsonResponse(false, JsonResponse::HTTP_INTERNAL_SERVER_ERROR, [
				'error' => $exception->getMessage(),
			]);
		}

		return ResponseService::success(['item' => $requirement->toArray()]);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Modules\Admin\Task\Models\Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
	public function destroy(Requirement $requirement)
	{
		$this->authorize('delete', Requirement::class);

		try {
			$requirement->delete();
		} catch (\Exception $exception) {
			return ResponseService::sendJsonResponse(false, JsonResponse::HTTP_INTERNAL_SERVER_ERROR, [
				'error' => $exception->getMessage(),
			]);
		}

		return ResponseService::sendJsonResponse(true, JsonResponse::HTTP_NO_CONTENT);
	}
}
