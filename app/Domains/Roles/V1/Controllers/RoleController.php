<?php

namespace App\Domains\Roles\V1\Controllers;

use App\Domains\Roles\V1\Requests\AddRequest;
use App\Domains\Roles\V1\Requests\UpdateRequest;
use App\Domains\Roles\V1\Resources\RoleResource;
use App\Domains\Roles\Services\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use GeneralTrait;
    public function __construct(private RoleService $roles) {}

    public function index()
    {
        $roles = $this->roles->paginate();
        return $this->returnData("data", ['roles' => RoleResource::collection($roles)], __('api.returnData'));
    }

    public function create(Role $role)
    {
        $permissions = $role->getPermissions();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(AddRequest $request)
    {
        $this->roles->create($request->all());
        return redirect()->route('dashboard.roles.index')->with('success', 'Role created successfully');
    }

    public function edit($id)
    {
        $role = $this->roles->find($id);
        $permissions = $role->getPermissions();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->roles->update($id, $request->all());
        return redirect()->route('dashboard.roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $this->roles->delete($id);
        return redirect()->route('dashboard.roles.index')->with('success', 'Role deleted successfully');
    }
}
