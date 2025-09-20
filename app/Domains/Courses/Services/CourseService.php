<?php

namespace App\Domains\Courses\Services;

use App\Domains\Courses\Contracts\CourseInterface;

/**
 * Service layer for managing courses.
 * Acts as a middle layer between controllers and the repository.
 */
class CourseService
{
    /**
     * Inject the CourseRepository dependency.
     *
     * @param CourseInterface|null $courseRepository
     */
    public function __construct(private ?CourseInterface $courseRepository = null) {}

    /**
     * Get all courses in paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return $this->courseRepository->paginate($perPage);
    }

    /**
     * Find a specific course by ID.
     *
     * @param int $id Course ID
     * @return \App\Domains\Courses\Models\Course|null Returns the course if found, null otherwise
     */
    public function find(int $id)
    {
        return $this->courseRepository->find($id);
    }

    /**
     * Create a new course.
     *
     * @param array $data Course data (e.g., name, description, duration)
     * @return \App\Domains\Courses\Models\Course The newly created course
     */
    public function create(array $data)
    {
        return $this->courseRepository->create($data);
    }

    /**
     * Update an existing course.
     *
     * @param int $id Course ID
     * @param array $data Updated course data
     * @return \App\Domains\Courses\Models\Course|null Returns updated course or null if not found
     */
    public function update(int $id, array $data)
    {
        return $this->courseRepository->update($id, $data);
    }

    /**
     * Delete a course by ID.
     *
     * @param int $id Course ID
     * @return bool True if deletion was successful, false otherwise
     */
    public function delete(int $id)
    {
        return $this->courseRepository->delete($id);
    }
}
