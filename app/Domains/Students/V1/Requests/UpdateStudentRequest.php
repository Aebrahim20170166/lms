<?php

namespace App\Domains\Students\V1\Requests;

use App\Http\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
        $userId = optional($this->route('student')?->user)->id;
        return [
            'first_name'  => ['sometimes','required','string','max:100'],
            'last_name'  => ['sometimes','required','string','max:100'],
            'email'   => ['sometimes','required','email','max:255', Rule::unique('users','email')->ignore($userId)],
            'phone'   => ['sometimes','required','string','max:30', Rule::unique('users','phone')->ignore($userId)],
            'password'=> ['sometimes','nullable','string','min:8'],

            'level_id'       => ['sometimes','required','exists:levels,id'],
            'birthdate'      => ['sometimes','required','date'],
            'school'         => ['sometimes','nullable','string','max:255'],
            'city_id'        => ['sometimes','required','exists:cities,id'],
            'country_id'     => ['sometimes','required','exists:countries,id'],
            'state'          => ['sometimes','required','string','max:255'],
            'parent_contact' => ['sometimes','required','string','max:255'],
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
