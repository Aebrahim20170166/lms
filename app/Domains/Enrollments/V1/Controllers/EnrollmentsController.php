<?php

namespace App\Domains\Enrollments\V1\Controllers;

use App\Domains\Enrollments\Services\EnrollmentService;
use App\Domains\Enrollments\V1\Requests\StoreEnrollmentRequest;
use App\Domains\Enrollments\V1\Resources\EnrollmentResource;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;

class EnrollmentsController extends Controller
{
    use GeneralTrait;
    public function __construct(private EnrollmentService $service) {}

    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 15); // pass 'all' or 0 to get all
        $data = $this->service->paginate($perPage);

        // If it's a paginator, return pagination meta; else return collection
        if (method_exists($data, 'items')) {
            return $this->returnData("data", ["enrollments" => EnrollmentResource::collection($data), 'paginate' => [
                'total'        => $data->total(),
                'per_page'     => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages'  => $data->lastPage(),
            ],], trans('api.fetch_successEnrollment'));
        }

        return $this->returnData("data", ["enrollments" => EnrollmentResource::collection($data)], trans('api.fetch_successEnrollment'));
    }

    public function show(int $id)
    {
        $enrollment = $this->service->find($id);
        return $this->returnData("data", ["enrollments" => EnrollmentResource::make($enrollment)], trans('api.fetch_successEnrollment'));
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $this->service->create($request->validated());
        return $this->returnSuccessMessage(200, trans('api.addEnrollment'));
    }

    public function update(StoreEnrollmentRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());
        return $this->returnSuccessMessage(200, trans('api.updatedEnrollment'));
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return $this->returnSuccessMessage(200, trans('api.deletedEnrollment'));
    }
}
