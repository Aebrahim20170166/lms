<?php
namespace App\Domains\Cities\Contracts;

/**
 * Interface CityInterface
 * Defines the contract for City repository operations.
 */
interface CityInterface
{
    /**
     * Retrieve cities in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10);

    /**
     * Find a city by its ID.
     *
     * @param int $id City ID
     * @return \App\Models\City|null Returns the city if found, null otherwise
     */
    public function find(int $id);

    /**
     * Create a new city with the given data.
     *
     * @param array $data City data (name, country_id, etc.)
     * @return \App\Models\City The newly created city
     */
    public function create(array $data);

    /**
     * Update an existing city with new data.
     *
     * @param int $id City ID to update
     * @param array $data Updated city data
     * @return \App\Models\City|null Returns updated city, or null if not found
     */
    public function update(int $id, array $data);

    /**
     * Delete a city by its ID.
     *
     * @param int $id City ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id);
}