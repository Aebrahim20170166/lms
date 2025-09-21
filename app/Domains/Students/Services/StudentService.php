<?php

namespace App\Domains\Students\Services;
use App\Domains\Students\Contracts\StudentInterface;
use App\Domains\Students\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
/**
 * Service StudentService
 * Handles business logic for Student operations.
 */
class StudentService
{
    
    /**
     * Inject the StudentRepository dependency.
     *
     * @param StudentInterface|null $studentRepository
     */
    public function __construct(private ?StudentInterface $studentRepository = null) {}

    /**
     * Get all students in paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return $this->studentRepository->paginate($perPage);
    }

    /**
     * Find a specific student by ID.
     *
     * @param int $id Student ID
     * @return \App\Domains\Students\Models\Student|null Returns the student if found, null otherwise
     */
    public function find(int $id)
    {
        return $this->studentRepository->find($id);
    }

    /**
     * Create a new student.
     *
     * @param array $data Student data (e.g., name, email, course_id)
     * @return \App\Domains\Students\Models\Student The newly created student
     */
    public function create(array $data)
    {
        [$userData, $studentData] = $this->splitPayload($data);

        return $this->studentRepository->create($userData, $studentData);
    }

    /**
     * Update an existing student.
     *
     * @param int $id Student ID
     * @param array $data Updated student data
     * @return \App\Domains\Students\Models\Student|null Returns updated student or null if not found
     */
    public function update(int $id, array $data)
    {
        [$userData, $studentData] = $this->splitPayload($data);

        return $this->studentRepository->update($id, $userData, $studentData);
    }
    /**
     * Split the payload into user and student data.
     *
     * @param array $payload The complete data payload
     * @return array An array containing two elements: user data and student data
     */
    private function splitPayload(array $payload): array
    {
        $userKeys = ['first_name','last_name','email','password','phone','status'];
        $userData = array_intersect_key($payload, array_flip($userKeys));
        $studentData = array_diff_key($payload, $userData);
        return [$userData, $studentData];
    }

    /**
     * Delete a student by ID.
     *
     * @param int $id Student ID
     * @return bool True if deletion was successful, false otherwise
     */
    public function delete(int $id)
    {
        return $this->studentRepository->delete($id);
    }
}