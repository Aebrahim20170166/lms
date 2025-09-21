<?php

namespace App\Domains\Roles\Repositories;

use App\Domains\Roles\Contracts\RoleRepositoryInterface;
use App\Domains\Roles\Models\Role;

class EloquentRoleRepository implements RoleRepositoryInterface
{
    /**
     * Get a paginated list of roles.
     *
     * @param  int  $perPage  Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        // Return paginated list of roles
        return Role::paginate($perPage);
    }

    /**
     * Get all roles without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        // Return all roles as a collection
        return Role::get();
    }

    /**
     * Find a single role by its ID.
     *
     * @param  int  $id  Role primary key
     * @return Role
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id)
    {
        // Find role or fail (throws exception if not found)
        return Role::findOrFail($id);
    }

    /**
     * Create a new role with permissions.
     * Permissions may be provided as a comma-separated string or as an array.
     *
     * @param  array  $data  Role data
     * @return Role
     */
    public function create(array $data)
    {
        // Normalize Arabic permissions to array
        if (is_string($data['permissions_ar'])) {
            $data['permissions_ar'] = explode(',', $data['permissions_ar']);
        }

        // Normalize English permissions to array
        if (is_string($data['permissions_en'])) {
            $data['permissions_en'] = explode(',', $data['permissions_en']);
        }

        // Encode arrays as JSON strings for DB storage
        $data['permissions_ar'] = json_encode(array_map('trim', $data['permissions_ar']));
        $data['permissions_en'] = json_encode(array_map('trim', $data['permissions_en']));

        // Create and return the new role
        return Role::create($data);
    }

    /**
     * Update an existing role by ID.
     * Supports both array and comma-separated string formats for permissions.
     *
     * @param  int    $id    Role primary key
     * @param  array  $data  Updated role data
     * @return Role
     */
    public function update(int $id, array $data)
    {
        $role = $this->find($id);

        // Update Arabic permissions if provided
        if (isset($data['permissions_ar'])) {
            if (is_string($data['permissions_ar'])) {
                $data['permissions_ar'] = explode(',', $data['permissions_ar']);
            }
            $data['permissions_ar'] = json_encode(array_map('trim', $data['permissions_ar']));
        }

        // Update English permissions if provided
        if (isset($data['permissions_en'])) {
            if (is_string($data['permissions_en'])) {
                $data['permissions_en'] = explode(',', $data['permissions_en']);
            }
            $data['permissions_en'] = json_encode(array_map('trim', $data['permissions_en']));
        }

        // Save updates to database
        $role->update($data);

        return $role;
    }

    /**
     * Delete a role by ID.
     *
     * @param  int  $id  Role primary key
     * @return bool|null  True if deleted successfully, null if failed
     */
    public function delete(int $id)
    {
        $role = $this->find($id);

        // Delete the role and return true/false
        return $role->delete();
    }

    /**
     * Get the available permissions list from a config file
     * based on the current application locale.
     *
     * @return array
     */
    public function permissions()
    {
        // Load locale-specific config file (e.g. global_en.php, global_ar.php)
        $permissions = config('global_' . app()->getLocale());

        return $permissions['permissions'] ?? [];
    }
}
