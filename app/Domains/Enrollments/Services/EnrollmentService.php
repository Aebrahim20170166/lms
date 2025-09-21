<?php

namespace App\Domains\Enrollments\Services;

use App\Domains\Enrollments\Contracts\EnrollmentRepositoryInterface;

class EnrollmentService
{
    public function __construct(private EnrollmentRepositoryInterface $repo) {}

    public function paginate(int|string|null $perPage = 15)
    {
        return $this->repo->paginate($perPage);
    }

    public function find(int $id)
    {
        return $this->repo->find($id);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
