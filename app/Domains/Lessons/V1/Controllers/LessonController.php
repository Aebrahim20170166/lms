<?php

namespace App\Domains\Lessons\V1\Controllers;

use App\Domains\Lessons\Services\LessonService;
use App\Domains\Lessons\V1\Requests\AddLessonRequest;
use App\Domains\Lessons\V1\Requests\UpdateLessonRequest;
use App\Domains\Lessons\V1\Resources\LessonResource;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    use GeneralTrait;

    /**
     * The LessonsService instance.
     *
     * @var LessonsService
     */
    protected LessonService $service;

    /**
     * Inject the LessonService dependency.
     *
     * @param LessonService $service
     */
    public function __construct(LessonService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a paginated list of lessons.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        $lessons = $this->service->paginate($perPage);
        $pagination = [
            'total'         => $lessons->total(),
            'per_page'      => $lessons->perPage(),
            'current_page'  => $lessons->currentPage(),
            'total_pages'   => $lessons->lastPage(),
        ];
        return $this->returnData("data", [
            "lessons" => LessonResource::collection($lessons),
            "pagination" => $pagination,
        ], __("api.lessons_all"));
    }

    /**
     * Display a specific lesson by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $lesson = $this->service->find($id);
        if (!$lesson) {
            return $this->returnError(404, __("api.lesson_not_found"));
        }
        return $this->returnData("data", ["lesson" => new LessonResource($lesson)], __("api.lesson_found"));
    }

    /**
     * Store a newly created lesson.
     *
     * @param AddLessonRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddLessonRequest $request)
    {
        $data = $request->validated();
        $lesson = $this->service->create($data);
        return $this->returnData("data", ["lesson" => new LessonResource($lesson)], __("api.lesson_created"));
    }

    /**
     * Update the specified lesson.
     *
     * @param UpdateLessonRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateLessonRequest $request, int $id)
    {
        $data = $request->validated();
        $lesson = $this->service->update($id, $data);
        if (!$lesson) {
            return $this->returnError(404, __("api.lesson_not_found"));
        }
        return $this->returnData("data", ["lesson" => new LessonResource($lesson)], __("api.lesson_updated"));
    }

    /**
     * Remove the specified lesson.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return $this->returnError(404, __("api.lesson_not_found"));
        }
        return $this->returnSuccess(200, __("api.lesson_deleted"));
    }
}
