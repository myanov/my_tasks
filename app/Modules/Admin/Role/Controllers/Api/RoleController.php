<?php

namespace App\Modules\Admin\Role\Controllers\Api;

use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Requests\RoleRequest;
use App\Modules\Admin\Role\Services\RoleService;
use App\Services\Response\ResponseService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
	public function __construct(RoleService $roleService)
	{
		$this->service = $roleService;
	}

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function index()
	{
		try {
			$this->authorize('view', Role::class);
		} catch (AuthorizationException $exception) {
			return ResponseService::notAuthorize();
		}
		$roles = Role::all();

		return ResponseService::success([
			'items' => $roles,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(RoleRequest $request)
	{
		try {
			$this->authorize('create', Role::class);
		} catch (AuthorizationException $exception) {
			return ResponseService::notAuthorize();
		}
		$this->service->save($request, new Role());

		return ResponseService::success();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Modules\Admin\Role\Models\Role  $role
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Role $role)
	{
		try {
			$this->authorize('view', Role::class);
		} catch (AuthorizationException $exception) {
			return ResponseService::notAuthorize();
		}

		return ResponseService::success([
			'item' => $role->toArray(),
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Modules\Admin\Role\Models\Role  $role
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit(Role $role)
	{
		try {
			$this->authorize('edit', Role::class);
		} catch (AuthorizationException $exception) {
			return ResponseService::notAuthorize();
		}

		return ResponseService::success([
			'item' => $role->toArray(),
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Modules\Admin\Role\Models\Role  $role
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(RoleRequest $request, Role $role)
	{
		try {
			$this->authorize('edit', Role::class);
		} catch (AuthorizationException $exception) {
			return ResponseService::notAuthorize();
		}

		$this->service->save($request, $role);

		return ResponseService::success();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Modules\Admin\Role\Models\Role  $role
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Role $role)
	{
		try {
			$this->authorize('delete', Role::class);
		} catch (AuthorizationException $exception) {
			return ResponseService::notAuthorize();
		}

		$role->delete();

		return ResponseService::success();
	}
}
