<?php

namespace App\Domains\Lessons\V1\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'order_no' => $this->order_no,
            'duration' => $this->duration,
            'is_active' => $this->is_active,
            'course_id' => $this->course_id,
            // we have title_ar as field and title_en as field in course table
            // so we can return course name based on app locale
            'course_name' => $this->course ? ($request->header('Accept-Language') == 'ar' ? $this->course->title_ar : $this->course->title_en) : null,
            'created_at' => $this->created_at,
        ];
    }
}
