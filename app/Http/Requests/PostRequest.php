<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'excerpt' => 'nullable|string|max:1000',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:1000',
            'status' => 'required|in:active,inactive,draft',
            'type' => 'required|in:service,practice,news,blog',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'google_schema' => 'nullable|string'
        ];

        // Handle slug validation for create and update
        if ($this->isMethod('post')) {
            // Creating new post
            $rules['slug'] = 'nullable|string|max:255|unique:posts,slug';
        } else {
            // Updating existing post
            $postId = $this->route('post') ? $this->route('post')->id : null;
            $rules['slug'] = ['nullable', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($postId)];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The post title is required.',
            'title.max' => 'The post title may not be greater than 255 characters.',
            'description.required' => 'The post description is required.',
            'slug.unique' => 'This slug is already taken. Please choose a different one.',
            'status.required' => 'Please select a status for the post.',
            'status.in' => 'The selected status is invalid.',
            'type.required' => 'Please select a type for the post.',
            'type.in' => 'The selected type is invalid.',
            'feature_image.image' => 'The feature image must be an image file.',
            'feature_image.mimes' => 'The feature image must be a file of type: jpeg, png, jpg, gif, webp.',
            'feature_image.max' => 'The feature image may not be greater than 2MB.',
            'meta_title.max' => 'The meta title may not be greater than 255 characters.',
            'meta_description.max' => 'The meta description may not be greater than 500 characters.',
            'meta_keywords.max' => 'The meta keywords may not be greater than 1000 characters.',
            'excerpt.max' => 'The excerpt may not be greater than 1000 characters.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'meta_title' => 'meta title',
            'meta_description' => 'meta description',
            'meta_keywords' => 'meta keywords',
            'feature_image' => 'feature image',
            'google_schema' => 'Google Schema'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Remove empty google_schema to avoid validation issues
        if ($this->has('google_schema') && empty(trim($this->google_schema))) {
            $this->merge(['google_schema' => null]);
        }

        // Validate JSON format if google_schema is provided
        if ($this->filled('google_schema')) {
            $decoded = json_decode($this->google_schema, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->merge(['google_schema' => 'invalid_json']);
            }
        }
    }
}
