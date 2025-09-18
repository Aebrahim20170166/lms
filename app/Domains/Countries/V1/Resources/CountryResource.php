<?php

namespace App\Domains\Countries\V1\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name_ar" => $this->name_ar,
            "name_en" => $this->name_en,
            "code" => $this->code,
            "created_at" => $this->created_at,
        ];
    }
}
