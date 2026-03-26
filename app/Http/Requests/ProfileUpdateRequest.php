<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $userId = auth()->id();
        return [
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg',
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone' => 'required|string|regex:/^[0-9]+$/|max:12|min:11',
            'date_of_birth' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|in:male,female,other',
            // 'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-'
        ];
    }

    public function messages(): array
    {
        return [
            'profile_picture.image' => '',
            'profile_picture.mimes' => 'The profile picture must be one of these types: jpg, jpeg, png',

            'name.required' => 'The name field is required.',
            'name.string' => 'The name is invalid.',
            'name.regex' => 'The name may only contain alphabetic characters and spaces.',
            'name.max' => 'The name may not be greater than :max characters.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',
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
        ];
    }
}
