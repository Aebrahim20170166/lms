<?php

namespace App\Domains\Roles\Contracts;

/**
 * Interface RoleRepositoryInterface
 * Defines the contract for Role repository operations.
 */
interface RoleRepositoryInterface
{
    /**
     * Retrieve roles in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10);

    /**
     * Find a role by its ID.
     *
     * @param int $id Role ID
     * @return \App\Models\Role|null Returns the role if found, null otherwise
     */
    public function find(int $id);

    /**
     * Create a new role with the given data.
     *
     * @param array $data Role data (name, permissions, etc.)
     * @return \App\Models\Role The newly created role
     */
    public function create(array $data);

    /**
     * Update an existing role with new data.
     *
     * @param int $id Role ID to update
     * @param array $data Updated role data
     * @return \App\Models\Role|null Returns updated role, or null if not found
     */
    public function update(int $id, array $data);

    /**
     * Delete a role by its ID.
     *
     * @param int $id Role ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id);
}
