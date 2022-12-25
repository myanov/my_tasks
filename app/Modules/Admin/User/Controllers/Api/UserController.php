<?php

namespace App\Modules\Admin\User\Controllers\Api;

use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\User\Requests\UserRequest;
use App\Modules\Admin\User\Services\UserService;
use App\Services\Response\ResponseService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function __construct(UserService $userService)
	{
		$this->service = $userService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
	{
		$this->authorize('view', User::class);

		$users = $this->service->getUsers();

		return ResponseService::sendJsonResponse(
			true,
			200,
			[],
			[
				'items' => $users->toArray(),
			],
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(UserRequest $request)
	{
		$this->authorize('create', User::class);

		$user = $this->service->save($request, new User());

		return ResponseService::sendJsonResponse(
			true,
			201,
			[],
			[
				'item' => $user->toArray(),
			],
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Modules\Admin\User\Models\User  $user
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(User $user)
	{
		$this->authorize('view', User::class);

		return ResponseService::success([
			'item' => $user->toArray(),
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Modules\Admin\User\Models\User  $user
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(UserRequest $request, User $user)
	{
		$this->authorize('edit', $user);
		$user = $this->service->save($request, $user);

		return ResponseService::success([
			'item' => $user->toArray(),
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Modules\Admin\User\Models\User  $user
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(User $user)
	{
		$this->authorize('delete', $user);

		$user->delete();

		return ResponseService::success();
	}
}
