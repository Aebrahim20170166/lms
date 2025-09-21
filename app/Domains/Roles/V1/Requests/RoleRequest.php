<?php

namespace App\Domains\Roles\V1\Requests;

use App\Http\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoleRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the user is authorized to make this request.
     * 
     * Always returns true for now (all users can send this request).
     * You can later add role-based authorization logic here.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define validation rules for the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'           => 'required|string', // role name is required and must be a string
            'permissions_ar' => 'required|string', // permissions in Arabic, stored as string (comma-separated)
            'permissions_en' => 'required|string', // permissions in English, stored as string (comma-separated)
        ];
    }

    /**
     * Custom error messages for validation rules.
     *
     * These messages are linked to the /lang/{locale}/validation.php keys.
     */
    public function messages(): array
    {
        return [
            'name.required'           => __('validation.name_required'),
            'name.string'             => __('validation.name_string'),

            'permissions_ar.required' => __('validation.permissions_ar_required'),
            'permissions_ar.string'   => __('validation.permissions_ar_string'),

            'permissions_en.required' => __('validation.permissions_en_required'),
            'permissions_en.string'   => __('validation.permissions_en_string'),
        ];
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
