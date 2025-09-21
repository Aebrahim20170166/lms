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
        $perPage = (int) $request->get('per_page', 10);
        $cities = $this->service->paginate($perPage);

        $pagination = [
            'total'         => $cities->total(),
            'per_page'      => $cities->perPage(),
            'current_page'  => $cities->currentPage(),
            'total_pages'   => $cities->lastPage(),
        ];

        return $this->returnData("data", [
            "cities" => CityResource::collection($cities),
            "pagination" => $pagination,
        ], __("api.all_cities"));
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
        return $this->returnSuccess(200, __("api.city_deleted"));
    }
}
