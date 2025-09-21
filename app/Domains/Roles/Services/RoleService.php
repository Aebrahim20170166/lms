<?php

namespace App\Domains\Roles\Services;

use App\Domains\Roles\Contracts\RoleRepositoryInterface;

/**
 * Service layer for managing roles.
 * Works as a middle layer between controllers and the repository.
 */
class RoleService
{
    /**
     * Inject the RoleRepository dependency.
     *
     * @param RoleRepositoryInterface|null $repo
     */
    public function __construct(private ?RoleRepositoryInterface $repo = null) {}

    /**
     * Get all roles in paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        // Return roles with pagination
        return $this->repo->paginate($perPage);
    }

    /**
     * Get all roles without pagination.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        // Return all roles without pagination
        return $this->repo->all();
    }

    /**
     * Find a specific role by ID.
     *
     * @param int $id Role ID
     * @return \App\Models\Role|null
     */
    public function find(int $id)
    {
        // Find a role by its ID
        return $this->repo->find($id);
    }

    /**
     * Create a new role.
     *
     * @param array $data Role data (e.g., name, permissions)
     * @return \App\Models\Role
     */
    public function create(array $data)
    {
        // Create a new role with given data
        return $this->repo->create($data);
    }

    /**
     * Update an existing role.
     *
     * @param int $id Role ID
     * @param array $data Updated role data
     * @return \App\Models\Role|null
     */
    public function update(int $id, array $data)
    {
        // Update role data by its ID
        return $this->repo->update($id, $data);
    }

    /**
     * Delete a role by ID.
     *
     * @param int $id Role ID
     * @return bool True if deletion was successful, false otherwise
     */
    public function delete(int $id)
    {
        // Delete role by its ID
        return $this->repo->delete($id);
    }

    /**
     * Get all available permissions.
     *
     * @return \Illuminate\Support\Collection
     */
    public function permissions()
    {
        // Return all permissions
        return $this->repo->permissions();
    }
}
