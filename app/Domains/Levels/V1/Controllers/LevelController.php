<?php

namespace App\Domains\Levels\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Levels\Services\LevelService;
use App\Domains\Levels\V1\Requests\AddLevelRequest;
use App\Domains\Levels\V1\Requests\UpdateLevelRequest;
use App\Domains\Levels\V1\Resources\LevelResource;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    use GeneralTrait;

    /**
     * The LevelService instance.
     *
     * @var LevelService
     */
    protected LevelService $service;

    /**
     * Inject the LevelService dependency.
     *
     * @param LevelService $service
     */
    public function __construct(LevelService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a paginated list of Levels.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // You want "perPage" not "page" → `page` is for page number.
        $perPage = (int) $request->get('per_page', 10);

        $levels = $this->service->paginate($perPage);

        $pagination = [
            'total'         => $levels->total(),
            'per_page'      => $levels->perPage(),
            'current_page'  => $levels->currentPage(),
            'total_pages'   => $levels->lastPage(),
        ];

        return $this->returnData(
            "data",
            [
                'levels'     => LevelResource::collection($levels),
                'pagination' => $pagination,
            ],
            __("api.levels_all")
        );
    }

    /**
     * Display a specific level by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $Level = $this->service->find($id);
        if (!$Level) {
            return $this->returnError(404, __("api.Level_not_found"));
        }
        return $this->returnData("data", ["Level" => new LevelResource($Level)], __("api.Level_found"));
    }

    /**
     * Store a newly created Level.
     *
     * @param AddLevelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddLevelRequest $request)
    {
        $data = $request->validated();
        $Level = $this->service->create($data);
        return $this->returnData("data", ["Level" => new LevelResource($Level)], __("api.Level_created"));
    }

    /**
     * Update the specified Level.
     *
     * @param UpdateLevelRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateLevelRequest $request, int $id)
    {
        $data = $request->validated();
        $Level = $this->service->update($id, $data);
        if (!$Level) {
            return $this->returnError(404, __("api.Level_not_found"));
        }
        return $this->returnData("data", ["Level" => new LevelResource($Level)], __("api.Level_updated"));
    }

    /**
     * Remove the specified Level.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return $this->returnError(404, __("api.Level_not_found"));
        }
        return $this->returnSuccess(__("api.Level_deleted"));
    }
}
