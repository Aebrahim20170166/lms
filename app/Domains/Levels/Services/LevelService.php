<?php

namespace App\Domains\Levels\Services;

use App\Domains\Levels\Contracts\LevelInterface;

/**
 * Service layer for managing levels.
 * Acts as a middle layer between controllers and the repository.
 */
class LevelService
{
    /**
     * Inject the LevelRepository dependency.
     *
     * @param LevelInterface|null $levelRepository
     */
    public function __construct(private ?LevelInterface $levelRepository = null) {}

    /**
     * Get all levels in paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return $this->levelRepository->paginate($perPage);
    }

    /**
     * Find a specific level by ID.
     *
     * @param int $id Level ID
     * @return \App\Domains\Levels\Models\Level|null Returns the level if found, null otherwise
     */
    public function find(int $id)
    {
        return $this->levelRepository->find($id);
    }

    /**
     * Create a new level.
     *
     * @param array $data Level data (e.g., name, description)
     * @return \App\Domains\Levels\Models\Level The newly created level
     */
    public function create(array $data)
    {
        return $this->levelRepository->create($data);
    }

    /**
     * Update an existing level.
     *
     * @param int $id Level ID
     * @param array $data Updated level data
     * @return \App\Domains\Levels\Models\Level|null Returns updated level or null if not found
     */
    public function update(int $id, array $data)
    {
        return $this->levelRepository->update($id, $data);
    }

    /**
     * Delete a level by ID.
     *
     * @param int $id Level ID
     * @return bool True if deletion was successful, false otherwise
     */
    public function delete(int $id)
    {
        return $this->levelRepository->delete($id);
    }
}
