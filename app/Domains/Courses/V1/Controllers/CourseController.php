<?php

namespace App\Domains\Courses\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Courses\Services\CourseService;
use App\Domains\Courses\V1\Requests\AddCourseRequest;
use App\Domains\Courses\V1\Requests\UpdateCourseRequest;
use App\Domains\Courses\V1\Resources\CourseResource;
use App\Http\Traits\GeneralTrait;

/**
 * Controller for handling course-related HTTP requests.
 */
class CourseController extends Controller
{
    use GeneralTrait;

    /**
     * The CourseService instance.
     *
     * @var CourseService
     */
    protected CourseService $service;

    /**
     * Inject the CourseService dependency.
     *
     * @param CourseService $service
     */
    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a paginated list of courses.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        $courses = $this->service->paginate($perPage);
        $pagination = [
            'total'         => $courses->total(),
            'per_page'      => $courses->perPage(),
            'current_page'  => $courses->currentPage(),
            'total_pages'   => $courses->lastPage(),
        ];
        return $this->returnData("data", [
            "courses" => CourseResource::collection($courses),
            "pagination" => $pagination,
        ], __("api.courses_all"));
    }

    /**
     * Display a specific course by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $course = $this->service->find($id);
        if (!$course) {
            return $this->returnError(404, __("api.course_not_found"));
        }
        return $this->returnData("data", ["course" => new CourseResource($course)], __("api.course_found"));
    }

    /**
     * Store a newly created course.
     *
     * @param AddCourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddCourseRequest $request)
    {
        $data = $request->validated();
        $course = $this->service->create($data);
        return $this->returnData("data", ["course" => new CourseResource($course)], __("api.course_created"));
    }

    /**
     * Update the specified course.
     *
     * @param UpdateCourseRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCourseRequest $request, int $id)
    {
        $data = $request->validated();
        $course = $this->service->update($id, $data);
        if (!$course) {
            return $this->returnError(404, __("api.course_not_found"));
        }
        return $this->returnData("data", ["course" => new CourseResource($course)], __("api.course_updated"));
    }

    /**
     * Remove the specified course.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return $this->returnError(404, __("api.course_not_found"));
        }
        return $this->returnSuccess(200, __("api.course_deleted"));
    }
}
