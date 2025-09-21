<?php

namespace App\Domains\Lessons\Services;

use App\Domains\Lessons\Contracts\LessonInterface;

/**
 * Service layer for managing lessons.
 * Acts as a middle layer between controllers and the repository.
 */
class LessonService
{
    /**
     * Inject the LessonRepository dependency.
     *
     * @param LessonInterface|null $lessonRepository
     */
    public function __construct(private ?LessonInterface $lessonRepository = null) {}

    /**
     * Get all lessons in paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return $this->lessonRepository->paginate($perPage);
    }

    /**
     * Find a specific lesson by ID.
     *
     * @param int $id Lesson ID
     * @return \App\Domains\Lessons\Models\Lesson|null Returns the lesson if found, null otherwise
     */
    public function find(int $id)
    {
        return $this->lessonRepository->find($id);
    }

    /**
     * Create a new lesson.
     *
     * @param array $data Lesson data (e.g., title, content, course_id)
     * @return \App\Domains\Lessons\Models\Lesson The newly created lesson
     */
    public function create(array $data)
    {
        return $this->lessonRepository->create($data);
    }

    /**
     * Update an existing lesson.
     *
     * @param int $id Lesson ID
     * @param array $data Updated lesson data
     * @return \App\Domains\Lessons\Models\Lesson|null Returns updated lesson or null if not found
     */
    public function update(int $id, array $data)
    {
        return $this->lessonRepository->update($id, $data);
    }

    /**
     * Delete a lesson by ID.
     *
     * @param int $id Lesson ID
     * @return bool True if deletion was successful, false otherwise
     */
    public function delete(int $id)
    {
        return $this->lessonRepository->delete($id);
    }
}
