<?php

namespace App\Domains\Courses\V1\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Locale-aware helpers (falls back to EN if current locale key is missing)
        $locale = app()->getLocale() ?: 'en';
        $titleKey = in_array($locale, ['ar','en']) ? "title_{$locale}" : 'title_en';
        $descKey  = in_array($locale, ['ar','en']) ? "description_{$locale}" : 'description_en';

        return [
            'id'             => $this->id,
            'audience'       => $this->audience,      // 'student' | 'tutor'
            'level_id'       => $this->level_id,
            'level'          => $this->whenLoaded('level', fn () => [
                                    'id'   => $this->level->id,
                                    'name' => $this->level->name ?? null,
                               ]),

            // Raw multilingual fields
            'title_ar'       => $this->title_ar,
            'title_en'       => $this->title_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,

            // Locale-computed convenience fields
            'title'          => $this->{$titleKey} ?? $this->title_en,
            'description'    => $this->{$descKey}  ?? $this->description_en,

            // Cast in model -> boolean
            'is_active'      => (bool) $this->is_active,

            // Timestamps
            'created_at'     => optional($this->created_at)->toIso8601String(),
        ];
    }
}
