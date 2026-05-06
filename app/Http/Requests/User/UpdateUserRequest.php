<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Admin can update any user, users can update their own profile
        $user = Auth::user();
        $targetUser = $this->route('user');

        if (!$user) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        return $user->id === $targetUser->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'string', 'in:student,teacher,admin'],
            'password' => ['nullable', 'string', 'min:8'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The user name is required.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already in use.',
            'role.required' => 'The user role is required.',
            'role.in' => 'The role must be one of: student, teacher, or admin.',
            'password.min' => 'The password must be at least 8 characters.',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a JPEG, PNG, JPG, or GIF file.',
            'photo.max' => 'The photo may not be greater than 2MB.',
        ];
    }
}
