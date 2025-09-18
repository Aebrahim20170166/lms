<?php

namespace App\Domains\Countries\Repositories;

use App\Domains\Countries\Contracts\CountryInterface;
use App\Domains\Countries\Models\Country;

/**
 * Repository for CountryRepositoryInterface
 * Defines the contract for Country repository operations.
 */
class CountryRepository implements CountryInterface
{
    // Implement the methods defined in the interface
    /**
     * Retrieve countries in a paginated format.
     *
     * @param int $perPage Number of records per page (default = 10)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        // Ensure we always return a paginator, even if there are no countries
        return Country::query()->latest()->paginate($perPage);
    }

    /**
     * Find a country by its ID.
     *
     * @param int $id Country ID
     * @return \App\Models\Country|null Returns the country if found, null otherwise
     */
    public function find(int $id)
    {
        // Implementation here
        return Country::find($id);
    }

    /**
     * Create a new country with the given data.
     *
     * @param array $data Country data (name, code, etc.)
     * @return \App\Models\Country The newly created country
     */
    public function create(array $data)
    {
        return Country::create($data);
    }

    /**
     * Update an existing country with new data.
     *
     * @param int $id Country ID to update
     * @param array $data Updated country data
     * @return \App\Models\Country|null Returns updated country, or null if not found
     */
    public function update(int $id, array $data)
    {
        // Implementation here
        $country = $this->find($id);
        if ($country) {
            $country->update($data);
            return $country;
        }
    }

    /**
     * Delete a country by its ID.
     *
     * @param int $id Country ID
     * @return bool True if deleted successfully, false otherwise
     */
    public function delete(int $id): bool
    {
        // Implementation here
        $country = $this->find($id);
        if ($country) {
            return $country->delete();
        }
        return false;
    }
}