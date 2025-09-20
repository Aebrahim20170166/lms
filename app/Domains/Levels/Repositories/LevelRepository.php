<?php

namespace App\Domains\Levels\Repositories;

use App\Domains\Levels\Contracts\LevelInterface;
use App\Domains\Levels\Models\Level;

/**
 * Repository LevelRepository
 * Implements the contract for Level repository operations.
 */
class LevelRepository implements LevelInterface
{
    /**
     * Retrieve levels in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return Level::paginate($perPage);
    }

    /**
     * Find a level by its ID.
     *
     * @param int $id Level ID
     * @return \App\Domains\Levels\Models\Level|null Returns the level if found, null otherwise
     */
    public function find(int $id)
    {
        return Level::find($id);
    }

    /**
     * Create a new level with the given data.
     *
     * @param array $data Level data (name, description, etc.)
     * @return \App\Domains\Levels\Models\Level The newly created level
     */
    public function create(array $data)
    {
        return Level::create($data);
    }

    /**
     * Update an existing level with new data.
     *
     * @param int $id Level ID to update
     * @param array $data Updated level data
     * @return \App\Domains\Levels\Models\Level|null Returns updated level, or null if not found
     */
    public function update(int $id, array $data)
    {
        $level = Level::find($id);
        if ($level) {
            $level->update($data);
            return $level;
        }
        return null;
    }

    /**
     * Delete a level by its ID.
     *
     * @param int $id Level ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id): bool
    {
        $level = Level::find($id);
        if ($level) {
            return (bool) $level->delete();
        }
        return false;
    }
}