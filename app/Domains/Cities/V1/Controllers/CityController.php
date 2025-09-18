<?php

namespace App\Domains\Cities\V1\Controllers;

use App\Domains\Cities\Services\CityService;
use App\Http\Controllers\Controller;
use App\Domains\Cities\V1\Requests\addCityRequest;
use App\Domains\Cities\V1\Requests\updateCityRequest;
use App\Domains\Cities\V1\Resources\CityResource;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use GeneralTrait;
    protected CityService $service;

    public function __construct(CityService $service)
    {
        $this->service = $service;
    }
    public function index(Request $request)
    {
        $perPage = $request->get('page', 10);
        $cities = $this->service->paginate($perPage);
        return $this->returnData("data", ["cities" => CityResource::collection($cities)], __("api.all_cities"));
    }

    public function show(int $id)
    {
        $city = $this->service->find($id);
        if (!$city) {
            return $this->returnError(404, "City not found");
        }
        return $this->returnData("data", ["city" => CityResource::make($city)], __("api.city_found"));
    }

    public function store(addCityRequest $request)
    {
        $data = $request->validated();
        $city = $this->service->create($data);
        return $this->returnData("data", ["city" => CityResource::make($city)], __("api.city_created"));
    }

    public function update(updateCityRequest $request, int $id)
    {
        $data = $request->validated();
        $city = $this->service->update($id, $data);
        if (!$city) {
            return $this->returnError(404, "City not found");
        }
        return $this->returnData("data", ["city" => CityResource::make($city)], __("api.city_updated"));
    }

    public function destroy(int $id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return $this->returnError(404, __("api.city_not_found"));
        }
        return $this->returnSuccess(__("api.city_deleted"));
    }
}
