<?php

namespace App\Domains\Lessons\Repositories;

use App\Domains\Lessons\Contracts\LessonInterface;
use App\Domains\Lessons\Models\Lesson;

/**
 * Repository LessonRepository
 * Implements the contract for Lesson repository operations.
 */
class LessonRepository implements LessonInterface
{
    /**
     * Retrieve lessons in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return Lesson::paginate($perPage);
    }

    /**
     * Find a lesson by its ID.
     *
     * @param int $id Lesson ID
     * @return \App\Domains\Lessons\Models\Lesson|null Returns the lesson if found, null otherwise
     */
    public function find(int $id)
    {
        return Lesson::find($id);
    }

    /**
     * Create a new lesson with the given data.
     *
     * @param array $data Lesson data (name, description, duration, etc.)
     * @return \App\Domains\Lessons\Models\Lesson The newly created lesson
     */
    public function create(array $data)
    {
        return Lesson::create($data);
    }

    /**
     * Update an existing lesson with new data.
     *
     * @param int $id Lesson ID to update
     * @param array $data Updated lesson data
     * @return \App\Domains\Lessons\Models\Lesson|null Returns updated lesson, or null if not found
     */
    public function update(int $id, array $data)
    {
        $lesson = Lesson::find($id);
        if ($lesson) {
            $lesson->update($data);
            return $lesson;
        }
        return null;
    }

    /**
     * Delete a lesson by its ID.
     *
     * @param int $id Lesson ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id): bool
    {
        $lesson = Lesson::find($id);
        if ($lesson) {
            return (bool) $lesson->delete();
        }
        return false;
    }
}