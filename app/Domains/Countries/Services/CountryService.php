<?php

namespace App\Domains\Countries\Services;

use App\Domains\Countries\Contracts\CountryInterface;

/**
 * Service layer for managing countries.
 * Acts as a middle layer between controllers and the repository.
 */
class CountryService
{
    /**
     * Inject the CountryRepository dependency.
     *
     * @param CountryInterface|null $countryRepository
     */
    public function __construct(private ?CountryInterface $countryRepository = null) {}

    /**
     * Get all countries in paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return $this->countryRepository->paginate($perPage);
    }

    /**
     * Find a specific country by ID.
     *
     * @param int $id Country ID
     * @return \App\Models\Country|null Returns the country if found, null otherwise
     */
    public function find(int $id)
    {
        return $this->countryRepository->find($id);
    }

    /**
     * Create a new country.
     *
     * @param array $data Country data (e.g., name, code)
     * @return \App\Models\Country The newly created country
     */
    public function create(array $data)
    {
        return $this->countryRepository->create($data);
    }

    /**
     * Update an existing country.
     *
     * @param int $id Country ID
     * @param array $data Updated country data
     * @return \App\Models\Country|null Returns updated country or null if not found
     */
    public function update(int $id, array $data)
    {
        return $this->countryRepository->update($id, $data);
    }

    /**
     * Delete a country by ID.
     *
     * @param int $id Country ID
     * @return bool True if deletion was successful, false otherwise
     */
    public function delete(int $id)
    {
        return $this->countryRepository->delete($id);
    }
}