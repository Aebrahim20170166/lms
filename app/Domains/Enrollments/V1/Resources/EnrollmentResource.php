<?php

namespace App\Domains\Enrollments\V1\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'lesson_id'             => $this->lesson_id,
            'student_id'            => $this->student_id,
            'tutor_id'              => $this->tutor_id,
            'status'                => $this->status,
            'enrollment_date_time'  => optional($this->enrollment_date_time)->toIso8601String(),
            'notes'                 => $this->notes,
            // Optionally include related entities:
            // 'lesson'  => new LessonResource($this->whenLoaded('lesson')),
            // 'student' => new StudentResource($this->whenLoaded('student')),
            // 'tutor'   => new TutorResource($this->whenLoaded('tutor')),
        ];
    }
}
