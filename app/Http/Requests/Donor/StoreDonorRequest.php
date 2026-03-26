<?php

namespace App\Http\Requests\Donor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreDonorRequest extends FormRequest
{
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
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|regex:/^[0-9]+$/|max:12|min:11',
            'gender' => 'required|in:male,female,other',
            'blood_group' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'city' => 'required|string',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name is invalid.',
            'name.regex' => 'The name may only contain alphabetic characters and spaces.',
            'name.max' => 'The name may not be greater than :max characters.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email may not be greater than :max characters.',

            'phone.required' => 'The phone number field is required.',
            'phone.string' => 'The phone number is invalid.',
            'phone.regex' => 'The phone may only contain numbers.',
            'phone.max' => 'The phone may not be greater than :max digits.',
            'phone.min' => 'The phone may not be less than :min digits.',

            'gender.required' => 'Please select a gender.',
            'gender.in' => 'Invalid gender selection.',

            'blood_group.required' => 'Please select a blood group.',
            'blood_group.in' => 'Invalid blood group selection.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least :min characters.',
        ];
    }
}
