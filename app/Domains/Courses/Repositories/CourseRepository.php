<?php

namespace App\Domains\Courses\Repositories;

use App\Domains\Courses\Contracts\CourseInterface;
use App\Domains\Courses\Models\Course;

/**
 * Repository CourseRepository
 * Implements the contract for Course repository operations.
 */
class CourseRepository implements CourseInterface
{
    /**
     * Retrieve courses in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return Course::paginate($perPage);
    }

    /**
     * Find a course by its ID.
     *
     * @param int $id Course ID
     * @return \App\Domains\Courses\Models\Course|null Returns the course if found, null otherwise
     */
    public function find(int $id)
    {
        return Course::find($id);
    }

    /**
     * Create a new course with the given data.
     *
     * @param array $data Course data (name, description, duration, etc.)
     * @return \App\Domains\Courses\Models\Course The newly created course
     */
    public function create(array $data)
    {
        return Course::create($data);
    }

    /**
     * Update an existing course with new data.
     *
     * @param int $id Course ID to update
     * @param array $data Updated course data
     * @return \App\Domains\Courses\Models\Course|null Returns updated course, or null if not found
     */
    public function update(int $id, array $data)
    {
        $course = Course::find($id);
        if ($course) {
            $course->update($data);
            return $course;
        }
        return null;
    }

    /**
     * Delete a course by its ID.
     *
     * @param int $id Course ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id): bool
    {
        $course = Course::find($id);
        if ($course) {
            return (bool) $course->delete();
        }
        return false;
    }
}