<?php
namespace App\Domains\Students\Contracts;

/**
 * Interface StudentInterface
 * Defines the contract for Student repository operations.
 */
interface StudentInterface
{
    /**
     * Retrieve students in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10);

    /**
     * Find a student by its ID.
     *
     * @param int $id Student ID
     * @return \App\Domains\Students\Models\Student|null Returns the student if found, null otherwise
     */
    public function find(int $id);

    /**
     * Create a new student with the given data.
     *
     * @param array $data Student data (name, email, age, etc.)
     * @return \App\Domains\Students\Models\Student The newly created student
     */
    public function create(array $userData, array $studentData);

    /**
     * Update an existing student with new data.
     *
     * @param int $id Student ID to update
     * @param array $data Updated student data
     * @return \App\Domains\Students\Models\Student|null Returns updated student, or null if not found
     */
    public function update(int $id, array $userData, array $studentData);

    /**
     * Delete a student by its ID.
     *
     * @param int $id Student ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id): bool;
}