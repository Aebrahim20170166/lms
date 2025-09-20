<?php

namespace App\Domains\Courses\V1\Requests;

use App\Http\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateCourseRequest extends FormRequest
{
    use GeneralTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'audience'        => ['sometimes', 'required', Rule::in(['student', 'tutor'])],
            'level_id'        => ['sometimes', 'required', 'integer', 'exists:levels,id'],
            'title_ar'        => ['sometimes', 'required', 'string', 'max:255'],
            'title_en'        => ['sometimes', 'required', 'string', 'max:255'],
            'description_ar'  => ['sometimes', 'nullable', 'string'],
            'description_en'  => ['sometimes', 'nullable', 'string'],
            'is_active'       => ['sometimes', 'required', 'boolean'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $code = $this->returnCodeAccordingToInput($validator);
        throw new HttpResponseException($this->returnValidationError($code, $validator));
    }
}
