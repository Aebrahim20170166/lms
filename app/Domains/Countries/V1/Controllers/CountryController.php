<?php

namespace App\Domains\Countries\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Countries\Services\CountryService;
use App\Domains\Countries\V1\Requests\AddCountryRequest;
use App\Domains\Countries\V1\Requests\UpdateCountryRequest;
use App\Domains\Countries\V1\Resources\CountryResource;
use App\Http\Traits\GeneralTrait;

/**
 * Controller for handling country-related HTTP requests.
 */
class CountryController extends Controller
{
    use GeneralTrait;
    /**
     * The CountryService instance.
     *
     * @var CountryService
     */
    protected CountryService $service;

    /**
     * Inject the CountryService dependency.
     *
     * @param CountryService $service
     */
    public function __construct(CountryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a paginated list of countries.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = $request->get('page', 10);
        $countries = $this->service->paginate($perPage);
        return $this->returnData("data", ["countries" => CountryResource::collection($countries)], __("api.countries_all"));
    }

    /**
     * Display a specific country by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $country = $this->service->find($id);
        if (!$country) {
            return $this->returnError(404, __("api.country_not_found"));
        }
        return $this->returnData("data", ["country" => new CountryResource($country)], __("api.country_found"));
    }

    /**
     * Store a newly created country.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddCountryRequest $request)
    {
        $data = $request->validated();
        $country = $this->service->create($data);
        return $this->returnData("data", ["country" => new CountryResource($country)], __("api.country_created"));
    }

    /**
     * Update the specified country.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCountryRequest $request, int $id)
    {
        $data = $request->validated();
        $country = $this->service->update($id, $data);
        if (!$country) {
            return $this->returnError(404, __("api.country_not_found"));
        }
        return $this->returnData("data", ["country" => new CountryResource($country)], __("api.country_updated"));
    }

    /**
     * Remove the specified country.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return $this->returnError(404, __("api.country_not_found"));
        }
        return $this->returnSuccess(__("api.country_deleted"));
    }
}
