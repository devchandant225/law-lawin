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
            'post_type' => 'required|in:publication,more-publication,service-location,language,study-abroad,learning-center',
            'orderlist' => 'nullable|integer|min:0|max:9999',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'google_schema' => 'nullable|string',
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
            'google_schema' => 'Google Schema',
            'orderlist' => 'order list',
            'post_type' => 'post type',
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

        // Set default orderlist if not provided
        if (!$this->has('orderlist') || $this->orderlist === '') {
            $this->merge(['orderlist' => 0]);
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
