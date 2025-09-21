<?php

namespace App\Domains\Enrollments\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface EnrollmentRepositoryInterface
{
    /** Get paginated enrollments (pass null or 'all' for all rows). */
    public function paginate(int|string|null $perPage = 15): LengthAwarePaginator|Collection;

    /** Find one by id or fail. */
    public function find(int $id);

    /** Create a new enrollment. */
    public function create(array $data);

    /** Update an existing enrollment. */
    public function update(int $id, array $data);

    /** Delete by id. */
    public function delete(int $id): bool;
}
