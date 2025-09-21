<?php
namespace App\Domains\Lessons\Contracts;

/**
 * Interface LessonInterface
 * Defines the contract for Lesson repository operations.
 */
interface LessonInterface
{
    /**
     * Retrieve lessons in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10);

    /**
     * Find a lesson by its ID.
     *
     * @param int $id Lesson ID
     * @return \App\Domains\Lessons\Models\Lesson|null Returns the lesson if found, null otherwise
     */
    public function find(int $id);

    /**
     * Create a new lesson with the given data.
     *
     * @param array $data Lesson data (name, description, duration, etc.)
     * @return \App\Domains\Lessons\Models\Lesson The newly created lesson
     */
    public function create(array $data);

    /**
     * Update an existing lesson with new data.
     *
     * @param int $id Lesson ID to update
     * @param array $data Updated lesson data
     * @return \App\Domains\Lessons\Models\Lesson|null Returns updated lesson, or null if not found
     */
    public function update(int $id, array $data);

    /**
     * Delete a lesson by its ID.
     *
     * @param int $id Lesson ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id): bool;
}