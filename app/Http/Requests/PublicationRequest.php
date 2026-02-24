<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PublicationRequest extends FormRequest
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
            'excerpt' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'metatitle' => 'nullable|string|max:255',
            'metadescription' => 'nullable|string|max:500',
            'metakeywords' => 'nullable|string|max:1000',
            'status' => 'required|in:active,inactive,draft',
            'post_type' => ['required', 'string', Rule::in(['publication', 'more-publication', 'terms-condition', 'privacy-policy', 'cookies-policy'])],
            'orderlist' => 'nullable|integer|min:0|max:9999',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'feature_image_alt' => 'nullable|string|max:255',
            'schema_head' => 'nullable|array',
            'schema_head.*' => 'nullable|string',
            'schema_body' => 'nullable|array',
            'schema_body.*' => 'nullable|string',
        ];

        // Handle slug validation for create and update
        if ($this->isMethod('post')) {
            // Creating new publication
            $rules['slug'] = 'nullable|string|max:255|unique:publications,slug';
        } else {
            // Updating existing publication
            $publicationId = $this->route('publication') ? $this->route('publication')->id : null;
            $rules['slug'] = ['nullable', 'string', 'max:255', Rule::unique('publications', 'slug')->ignore($publicationId)];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The publication title is required.',
            'title.max' => 'The publication title may not be greater than 255 characters.',
            'slug.unique' => 'This slug is already taken. Please choose a different one.',
            'status.required' => 'Please select a status for the publication.',
            'status.in' => 'The selected status is invalid.',
            'post_type.required' => 'Please select a post type for the publication.',
            'post_type.in' => 'The selected post type is invalid.',
            'orderlist.integer' => 'The order list must be a number.',
            'orderlist.min' => 'The order list must be at least 0.',
            'orderlist.max' => 'The order list may not be greater than 9999.',
            'feature_image.image' => 'The feature image must be an image file.',
            'feature_image.mimes' => 'The feature image must be a file of type: jpeg, png, jpg, gif, webp.',
            'feature_image.max' => 'The feature image may not be greater than 2MB.',
            'metatitle.max' => 'The meta title may not be greater than 255 characters.',
            'metadescription.max' => 'The meta description may not be greater than 500 characters.',
            'metakeywords.max' => 'The meta keywords may not be greater than 1000 characters.',
            'excerpt.max' => 'The excerpt may not be greater than 1000 characters.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'metatitle' => 'meta title',
            'metadescription' => 'meta description',
            'metakeywords' => 'meta keywords',
            'feature_image' => 'feature image',
            'schema_head' => 'Schema (Head)',
            'schema_body' => 'Schema (Body)',
            'orderlist' => 'order list',
            'post_type' => 'post type',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Sanitize repeater arrays
        if ($this->has('schema_head') && is_array($this->schema_head)) {
            $this->merge(['schema_head' => array_filter($this->schema_head)]);
        }
        if ($this->has('schema_body') && is_array($this->schema_body)) {
            $this->merge(['schema_body' => array_filter($this->schema_body)]);
        }

        // Set default orderlist if not provided
        if (!$this->has('orderlist') || $this->orderlist === '') {
            $this->merge(['orderlist' => 0]);
        }

        // Ensure post_type is properly sanitized as string
        if ($this->has('post_type')) {
            $this->merge(['post_type' => (string) trim($this->post_type)]);
        }

        // Validate JSON format for each item in schema_head
        if ($this->filled('schema_head') && is_array($this->schema_head)) {
            foreach ($this->schema_head as $index => $json) {
                if (!empty($json)) {
                    json_decode($json);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $this->merge(["schema_head.{$index}" => 'invalid_json']);
                    }
                }
            }
        }

        // Validate JSON format for each item in schema_body
        if ($this->filled('schema_body') && is_array($this->schema_body)) {
            foreach ($this->schema_body as $index => $json) {
                if (!empty($json)) {
                    json_decode($json);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $this->merge(["schema_body.{$index}" => 'invalid_json']);
                    }
                }
            }
        }
    }
}
