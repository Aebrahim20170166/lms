<?php

namespace App\Domains\Countries\Contracts;

/**
 * Interface CountryRepositoryInterface
 * Defines the contract for Country repository operations.
 */
interface CountryInterface
{
    /**
     * Retrieve countries in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10);

    /**
     * Find a country by its ID.
     *
     * @param int $id Country ID
     * @return \App\Models\Country|null Returns the country if found, null otherwise
     */
    public function find(int $id);

    /**
     * Create a new country with the given data.
     *
     * @param array $data Country data (name, code, etc.)
     * @return \App\Models\Country The newly created country
     */
    public function create(array $data);

    /**
     * Update an existing country with new data.
     *
     * @param int $id Country ID to update
     * @param array $data Updated country data
     * @return \App\Models\Country|null Returns updated country, or null if not found
     */
    public function update(int $id, array $data);

    /**
     * Delete a country by its ID.
     *
     * @param int $id Country ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id): bool;
}
