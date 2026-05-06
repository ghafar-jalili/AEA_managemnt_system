<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only admin or teacher can create courses
        $user = Auth::user();
        return $user && ($user->isAdmin() || $user->isTeacher());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'course_time' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'teacher_name' => ['required', 'string', 'max:255'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'status' => ['required', 'string', 'in:active,inactive,will_start_soon'],
            'youtube_playlist_id' => ['nullable', 'string', 'max:255'],
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
            'title.required' => 'The course title is required.',
            'course_time.required' => 'The course time is required.',
            'price.required' => 'The course price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price cannot be negative.',
            'teacher_name.required' => 'The teacher name is required.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.mimes' => 'The thumbnail must be a JPEG, PNG, JPG, or GIF file.',
            'thumbnail.max' => 'The thumbnail may not be greater than 2MB.',
            'status.required' => 'The course status is required.',
            'status.in' => 'The status must be one of: active, inactive, or will_start_soon.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Set default teacher_id to current user if not admin
        if (!Auth::user()->isAdmin()) {
            $this->merge([
                'teacher_id' => Auth::id(),
            ]);
        }
    }
}
