<?php

namespace App\Domains\Roles\V1\Controllers;

use App\Domains\Roles\V1\Requests\RoleRequest;
use App\Domains\Roles\V1\Resources\RoleResource;
use App\Domains\Roles\Services\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use GeneralTrait;

    /**
     * Inject the domain service responsible for roles business logic.
     */
    public function __construct(private RoleService $roles) {}

    /**
     * List roles.
     * Behavior:
     * - If ?paginate is missing → return ALL roles (no pagination).
     * - If ?paginate=all or 0 → return ALL roles (no pagination).
     * - If ?paginate=<int> and > 0 → return paginated.
     *
     * Extras (optional):
     * - ?q=...      → simple "name LIKE %q%" filter (applied server-side in repo/service if you support it)
     * - ?sort=name  → sort by a column (default: id)
     */
    public function index(Request $request)
    {
        // Read controls
        $paginate = $request->query('paginate');         // string|int|null


        // Normalize "no pagination" cases
        $noPagination = is_null($paginate) || $paginate === 'all' || (string)$paginate === '0';

        // If you support search/sort in your repo/service, pass them along;
        // otherwise you can ignore $q/$sort/$dir or implement quickly there.
        if ($noPagination) {
            // Return all roles (no pagination)
            $roles = $this->roles->all(); // consider applying $q/$sort/$dir inside your repo if needed

            return $this->returnData(
                "data",
                ['roles' => RoleResource::collection($roles)],
                __('api.returnData')
            );
        }

        // Paginate when paginate is a positive integer; fallback to 10 if invalid
        $perPage = (int) $paginate > 0 ? (int) $paginate : 10;

        $roles = $this->roles->paginate($perPage); // consider applying $q/$sort/$dir inside your repo if needed

        return $this->returnData(
            "data",
            [
                'roles' => RoleResource::collection($roles),
                'paginate'  => [
                    'total'         => $roles->total(),
                    'per_page'      => $roles->perPage(),
                    'current_page'  => $roles->currentPage(),
                    'total_pages'   => $roles->lastPage(),
                ],
            ],
            __('api.returnData')
        );
    }

    /**
     * Return a single role by ID.
     */
    public function show(int $id)
    {
        $role = $this->roles->find($id);

        return $this->returnData(
            "data",
            ['role' => RoleResource::make($role)],
            __('api.returnData')
        );
    }

    /**
     * Get the available permissions list (localized).
     */
    public function permissions()
    {
        $permissions = $this->roles->permissions();

        return $this->returnData(
            "data",
            ['permissions' => $permissions],
            __('api.returnData')
        );
    }

    /**
     * Create a new role.
     * - Validated by RoleRequest.
     */
    public function store(RoleRequest $request)
    {
        $role = $this->roles->create($request->all());

        // Prefer returning the created resource (helps clients immediately)
        return $this->returnData(
            "data",
            ['role' => RoleResource::make($role)],
            __('api.addRole')
        );
    }

    /**
     * Update an existing role by ID.
     * - Validated by RoleRequest.
     */
    public function update(RoleRequest $request, int $id)
    {
        $role = $this->roles->update($id, $request->all());

        return $this->returnData(
            "data",
            ['role' => RoleResource::make($role)],
            __('api.updateRole')
        );
    }

    /**
     * Delete a role by ID.
     */
    public function destroy(int $id)
    {
        $this->roles->delete($id);

        return $this->returnSuccess(200, __('api.deleteRole'));
    }
}
