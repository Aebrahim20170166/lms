<?php

namespace App\Domains\Courses\Contracts;

/**
 * Interface CourseInterface
 * Defines the contract for Course repository operations.
 */
interface CourseInterface
{
    /**
     * Retrieve courses in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10);

    /**
     * Find a course by its ID.
     *
     * @param int $id Course ID
     * @return \App\Domains\Courses\Models\Course|null Returns the course if found, null otherwise
     */
    public function find(int $id);

    /**
     * Create a new course with the given data.
     *
     * @param array $data Course data (name, description, duration, etc.)
     * @return \App\Domains\Courses\Models\Course The newly created course
     */
    public function create(array $data);

    /**
     * Update an existing course with new data.
     *
     * @param int $id Course ID to update
     * @param array $data Updated course data
     * @return \App\Domains\Courses\Models\Course|null Returns updated course, or null if not found
     */
    public function update(int $id, array $data);

    /**
     * Delete a course by its ID.
     *
     * @param int $id Course ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id): bool;
}
