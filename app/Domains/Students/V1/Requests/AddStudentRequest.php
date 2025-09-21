<?php

namespace App\Domains\Students\V1\Requests;

use App\Http\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddStudentRequest extends FormRequest
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
            // user fields
            'first_name'  => ['required','string','max:100'],
            'last_name'  => ['required','string','max:100'],
            'email'   => ['required','email','max:255','unique:users,email'],
            'phone'   => ['required','string','max:30','unique:users,phone'],
            'password'=> ['required','string','min:8'],
            'status'  => ['required','in:active,inactive,suspended'], // or boolean/int per your schema

            // student fields
            'level_id'       => ['required','exists:levels,id'],
            'birthdate'      => ['required','date'],
            'school'         => ['nullable','string','max:255'],
            'city_id'        => ['required','exists:cities,id'],
            'country_id'     => ['required','exists:countries,id'],
            'state'          => ['required','string','max:255'],
            'parent_contact' => ['required','string','max:255'],
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
