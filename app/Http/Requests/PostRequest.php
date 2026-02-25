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
            'type' => 'required|in:service,practice,news,blog,help_desk',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'feature_image_alt' => 'nullable|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'layout' => 'required|in:with_sidebar,fullscreen',
            'orderposition' => 'nullable|integer|min:0',
            'bottom_description' => 'nullable|string',
            'schema_head' => 'nullable|array',
            'schema_head.*' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        json_decode($value);
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            $fail('The ' . $attribute . ' must be a valid JSON string.');
                        }
                    }
                },
            ],
            'schema_body' => 'nullable|array',
            'schema_body.*' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        json_decode($value);
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            $fail('The ' . $attribute . ' must be a valid JSON string.');
                        }
                    }
                },
            ],
        ];

        // Handle slug validation for create and update
        if ($this->isMethod('post')) {
            // Creating new post
            $rules['slug'] = 'nullable|string|max:255|unique:posts,slug';
        } else {
            // Updating existing post
            $post = $this->route('post');
            $postId = is_object($post) ? $post->id : $post; // Handle both object and slug/id
            
            // If we only have the slug/id as string, we might need to find the ID
            if (!is_numeric($postId) && is_string($postId)) {
                $foundPost = \App\Models\Post::where('slug', $postId)->orWhere('id', $postId)->first();
                $postId = $foundPost ? $foundPost->id : null;
            }

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
            'schema_head' => 'Schema (Head)',
            'schema_body' => 'Schema (Body)'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Sanitize repeater arrays
        if ($this->has('schema_head') && is_array($this->schema_head)) {
            $this->merge(['schema_head' => array_values(array_filter($this->schema_head))]);
        }
        if ($this->has('schema_body') && is_array($this->schema_body)) {
            $this->merge(['schema_body' => array_values(array_filter($this->schema_body))]);
        }
    }
}
