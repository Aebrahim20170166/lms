<?php

namespace App\Domains\Students\V1\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            // user core (only when relation is loaded)
            'user' => $this->when($this->relationLoaded('user'), function () {
                $u = $this->user;
                return [
                    'id'         => $u->id,
                    'first_name' => $u->first_name,
                    'last_name'  => $u->last_name,
                    'email'      => $u->email,
                    'phone'      => $u->phone,
                    'status'     => $u->status,
                    'role_id'    => $u->role_id,
                ];
            }),

            // student profile
            'level_id'       => $this->level_id,
            'birthdate'      => $this->birthdate,
            'school'         => $this->school,
            'city_id'        => $this->city_id,
            'country_id'     => $this->country_id,
            'state'          => $this->state,
            'parent_contact' => $this->parent_contact,

            // optional expanded relations (safe: closure only runs if loaded)
            'level' => $this->whenLoaded('level', function () {
                return ['id' => $this->level->id, 'name' => $this->level->name];
            }),
            'city' => $this->whenLoaded('city', function () {
                return ['id' => $this->city->id, 'name' => $this->city->name];
            }),
            'country' => $this->whenLoaded('country', function () {
                return ['id' => $this->country->id, 'name' => $this->country->name];
            }),

            'created_at' => $this->created_at,
        ];
    }
}
