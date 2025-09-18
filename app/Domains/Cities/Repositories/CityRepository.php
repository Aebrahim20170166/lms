<?php

namespace App\Domains\Cities\Repositories;

use App\Domains\Cities\Contracts\CityInterface;
use App\Domains\Cities\Models\City;

/**
 * Repository CityRepository
 * Implements the contract for City repository operations.
 */
class CityRepository implements CityInterface
{
    /**
     * Retrieve cities in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return City::paginate($perPage);
    }

    /**
     * Find a city by its ID.
     *
     * @param int $id City ID
     * @return \App\Domains\Cities\Models\City|null Returns the city if found, null otherwise
     */
    public function find(int $id)
    {
        return City::find($id);
    }

    /**
     * Create a new city with the given data.
     *
     * @param array $data City data (name, country_id, etc.)
     * @return \App\Domains\Cities\Models\City The newly created city
     */
    public function create(array $data)
    {
        return City::create($data);
    }

    /**
     * Update an existing city with new data.
     *
     * @param int $id City ID to update
     * @param array $data Updated city data
     * @return \App\Domains\Cities\Models\City|null Returns updated city, or null if not found
     */
    public function update(int $id, array $data)
    {
        $city = City::find($id);
        if ($city) {
            $city->update($data);
            return $city;
        }
        return null;
    }

    /**
     * Delete a city by its ID.
     *
     * @param int $id City ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id)
    {
        $city = City::find($id);
        if ($city) {
            return $city->delete();
        }
        return false;
    }
}