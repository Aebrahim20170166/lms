<?php

namespace App\Domains\Enrollments\V1\Requests;

use App\Http\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEnrollmentRequest extends FormRequest
{
    use GeneralTrait;
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'lesson_id'             => ['required', 'integer', 'exists:lessons,id'],
            'student_id'            => ['required', 'integer', 'exists:users,id'],
            'tutor_id'              => ['required', 'integer', 'exists:users,id'],
            'status'                => ['required', 'string', 'in:incoming,waiting,finished,missed,rescheduled,late'],
            'enrollment_date_time'  => ['required', 'date'],
            'notes'                 => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function attributes(): array
    {
        return trans('enrollments.attributes');
    }

    /**
     * Handle failed validation attempts.
     *
     * Uses GeneralTrait helpers to return a standardized JSON error response.
     * 
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $code = $this->returnCodeAccordingToInput($validator);

        throw new HttpResponseException(
            $this->returnValidationError($code, $validator)
        );
    }
}
