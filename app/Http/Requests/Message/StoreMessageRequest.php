<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
            'id' => 'required|integer|exists:users,id',
            'message' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Select a user to send message.',
            'message.required' => 'Type a message to send',
            'message.string' => 'Invalid message'
        ];
    }
}
