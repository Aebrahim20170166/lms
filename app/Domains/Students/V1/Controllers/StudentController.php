<?php

namespace App\Domains\Students\V1\Controllers;

use App\Domains\Students\Models\Student;
use App\Domains\Students\Services\StudentService;
use App\Domains\Students\V1\Requests\AddStudentRequest;
use App\Domains\Students\V1\Requests\UpdateStudentRequest;
use App\Domains\Students\V1\Resources\StudentResource;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use GeneralTrait;

    /**
     * The LessonsService instance.
     *
     * @var StudentService
     */
    protected StudentService $service;

    /**
     * Inject the StudentService dependency.
     *
     * @param StudentService $service
     */
    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a paginated list of students.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        $students = $this->service->paginate($perPage);
        $pagination = [
            'total'         => $students->total(),
            'per_page'      => $students->perPage(),
            'current_page'  => $students->currentPage(),
            'total_pages'   => $students->lastPage(),
        ];
        return $this->returnData("data", [
            "students" => StudentResource::collection($students),
            "pagination" => $pagination,
        ], __("api.students_all"));
    }

    /**
     * Display a specific student by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $student = $this->service->find($id);
        if (!$student) {
            return $this->returnError(404, __("api.student_not_found"));
        }
        return $this->returnData("data", ["student" => new StudentResource($student)], __("api.student_found"));
    }

    /**
     * Store a newly created student.
     *
     * @param AddStudentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddStudentRequest $request)
    {
        $data = $request->validated();
        $student = $this->service->create($data);
        return $this->returnData("data", ["student" => new StudentResource($student)], __("api.student_created"));
    }

    /**
     * Update the specified lesson.
     *
     * @param UpdateLessonRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();
        $student = $this->service->update($student->id, $data);
        if (!$student) {
            return $this->returnError(404, __("api.student_not_found"));
        }
        return $this->returnData("data", ["student" => new StudentResource($student)], __("api.student_updated"));
    }

    /**
     * Remove the specified student.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return $this->returnError(404, __("api.student_not_found"));
        }
        return $this->returnSuccess(200, __("api.student_deleted"));
    }
}
