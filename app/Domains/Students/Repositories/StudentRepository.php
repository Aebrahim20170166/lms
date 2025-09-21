<?php

namespace App\Domains\Students\Repositories;

use App\Domains\Students\Contracts\StudentInterface;
use App\Domains\Students\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Repository StudentRepository
 * Implements the contract for Student repository operations.
 */
class StudentRepository implements StudentInterface
{
    /**
     * Retrieve students in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return Student::with(['user', 'level', 'city', 'country'])->paginate($perPage);
    }

    /**
     * Find a student by its ID.
     *
     * @param int $id Student ID
     * @return \App\Domains\Students\Models\Student|null Returns the student if found, null otherwise
     */
    public function find(int $id)
    {
        return Student::find($id);
    }

    /**
     * Create a new student with the given data.
     *
     * @param array $data Student data (name, email, age, etc.)
     * @return \App\Domains\Students\Models\Student The newly created student
     */
    public function create(array $userData, array $studentData)
    {
        return DB::transaction(function () use ($userData, $studentData) {
            $userData['password'] = Hash::make($userData['password']);
            $userData['role_id']  = 4; // Student role
            $user = User::create($userData);

            $studentData['user_id'] = $user->id;
            return Student::create($studentData)->load(['user','level','city','country']);
        });
    }

    /**
     * Update an existing student with new data.
     *
     * @param int $id Student ID to update
     * @param array $data Updated student data
     * @return \App\Domains\Students\Models\Student|null Returns updated student, or null if not found
     */
    public function update(int $id, array $userData, array $studentData)
    {
        $student = Student::find($id);
        return DB::transaction(function () use ($student, $userData, $studentData) {
            if (!empty($userData)) {
                if (!empty($userData['password'])) {
                    $userData['password'] = Hash::make($userData['password']);
                } else {
                    unset($userData['password']);
                }
                $student->user->update($userData);
            }

            if (!empty($studentData)) {
                $student->update($studentData);
            }

            return $student->load(['user','level','city','country']);
        });
    }

    /**
     * Delete a student by its ID.
     *
     * @param int $id Student ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id): bool
    {
        $student = Student::find($id);
        if ($student) {
            return (bool) $student->delete();
        }
        return false;
    }
}