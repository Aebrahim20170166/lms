<?php

namespace App\Domains\V1\Roles\Repositories;

use App\Domains\V1\Roles\Contracts\RoleRepositoryInterface;
use App\Models\Role;

class EloquentRoleRepository implements RoleRepositoryInterface
{
    public function paginate(int $perPage = 10)
    {
        return Role::where('id', '<>', 2)->paginate($perPage);
    }

    public function find(int $id)
    {
        return Role::where('id', '<>', 2)->findOrFail($id);
    }

    public function create(array $data)
    { 
        $data['permissions'] = json_encode($data['permissions']);
        return Role::create($data);
    }

    public function update(int $id, array $data)
    {
        $role = $this->find($id);
        $data['permissions'] = json_encode($data['permissions']);
        $role->update($data);
        return $role;
    }

    public function delete(int $id)
    {
        $role = $this->find($id);
        return $role->delete();
    }
}
