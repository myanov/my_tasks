<?php

namespace App\Modules\Admin\Role\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Role\Models\Permission;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Services\PermissionService;
use App\Services\Response\ResponseService;
use Couchbase\KeyValueException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $this->authorize('view', Role::class);
        } catch (AuthorizationException $exception) {
            return ResponseService::notAuthorize();
        }

        $roles = Role::with('permissions')->get();

        return ResponseService::success([
            'items' => $roles
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->authorize('create', Role::class);
        } catch (AuthorizationException $exception) {
            return ResponseService::notAuthorize();
        }

        try {
            $this->service->save($request);
        } catch (\InvalidArgumentException $exception) {
            return ResponseService::sendJsonResponse(false, 402, ['message' => $exception->getMessage()]);
        }

        return ResponseService::success();
    }
}
