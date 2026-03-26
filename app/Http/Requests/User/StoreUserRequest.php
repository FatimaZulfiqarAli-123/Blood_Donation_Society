<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreUserRequest extends FormRequest
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
        if(User::where('email', $this->input('email'))->where('status', 'rejected')->exists())
        {
            throw ValidationException::withMessages([
                'error' => 'Your account has been deactivated. You cannot register as donor again.',
            ]);
        }

        return [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|string|unique:users,email,NULL,id,role,' . request('role'),
            'phone' => 'required|string|regex:/^[0-9]+$/|max:12|min:11',
            'gender' => 'required|in:male,female,other',
            'password' => 'required|string',
            'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'role' => 'required|in:donor,patient'
        ];
    }
}
