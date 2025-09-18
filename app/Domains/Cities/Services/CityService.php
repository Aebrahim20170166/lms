<?php

namespace App\Domains\Cities\Services;

use App\Domains\Cities\Repositories\CityRepository;

/**
 * Service layer for managing cities.
 * Acts as a middle layer between controllers and the repository.
 */
class CityService
{
    /**
     * The City repository instance.
     *
     * @var mixed
     */
    protected CityRepository $repository;

    /**
     * Inject the CityRepository dependency.
     *
     * @param mixed $repository
     */
    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all cities in paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Find a specific city by ID.
     *
     * @param int $id City ID
     * @return \App\Domains\Cities\Models\City|null Returns the city if found, null otherwise
     */
    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * Create a new city.
     *
     * @param array $data City data (e.g., name, country_id)
     * @return \App\Domains\Cities\Models\City The newly created city
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Update an existing city.
     *
     * @param int $id City ID
     * @param array $data Updated city data
     * @return \App\Domains\Cities\Models\City|null Returns updated city or null if not found
     */
    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Delete a city by ID.
     *
     * @param int $id City ID
     * @return bool True if deletion was successful, false otherwise
     */
    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}