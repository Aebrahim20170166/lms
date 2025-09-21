<?php

namespace App\Domains\Enrollments\Repositories;

use App\Domains\Enrollments\Contracts\EnrollmentRepositoryInterface;
use App\Domains\Enrollments\Models\Enrollment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentEnrollmentRepository implements EnrollmentRepositoryInterface
{
    public function __construct(private Enrollment $model) {}

    public function paginate(int|string|null $perPage = 15): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()->latest('id');

        // If perPage is null/'all'/0 → return all without pagination
        if ($perPage === null || $perPage === 'all' || (is_numeric($perPage) && (int)$perPage === 0)) {
            return $query->get();
        }

        return $query->paginate((int) $perPage);
    }

    public function find(int $id)
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->newQuery()->create($data);
    }

    public function update(int $id, array $data)
    {
        $enrollment = $this->find($id);
        $enrollment->update($data);
        return $enrollment;
    }

    public function delete(int $id): bool
    {
        $enrollment = $this->find($id);
        return (bool) $enrollment->delete();
    }
}
