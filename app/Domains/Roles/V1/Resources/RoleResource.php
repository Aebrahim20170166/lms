<?php

namespace App\Domains\Roles\V1\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the Role model into an array for API responses.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'permissions_ar' => $this->formatPermissions($this->permissions_ar),
            'permissions_en' => $this->formatPermissions($this->permissions_en),
        ];
    }
}
