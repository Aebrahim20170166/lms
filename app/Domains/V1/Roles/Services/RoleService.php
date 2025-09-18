<?php

namespace App\Domains\V1\Roles\Services;

use App\Domains\V1\Roles\Contracts\RoleRepositoryInterface;

/**
 * Service layer for managing roles.
 * Acts as a middle layer between controllers and the repository.
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
        return $this->repo->paginate($perPage);
    }

    /**
     * Find a specific role by ID.
     *
     * @param int $id Role ID
     * @return \App\Models\Role|null Returns the role if found, null otherwise
     */
    public function find(int $id)
    {
        return $this->repo->find($id);
    }

    /**
     * Create a new role.
     *
     * @param array $data Role data (e.g., name, permissions)
     * @return \App\Models\Role The newly created role
     */
    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    /**
     * Update an existing role.
     *
     * @param int $id Role ID
     * @param array $data Updated role data
     * @return \App\Models\Role|null Returns updated role or null if not found
     */
    public function update(int $id, array $data)
    {
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
        return $this->repo->delete($id);
    }
}
