<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:255',
            'orderlist' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
            'tagline' => 'nullable|string|max:500',
            'experience' => 'nullable|string',
            'qualification' => 'nullable|string',
            'additional_details' => 'nullable|string',
            'metatitle' => 'nullable|string|max:255',
            'metadescription' => 'nullable|string|max:500',
            'metakeywords' => 'nullable|string|max:1000',
            'googleschema' => 'nullable|string',
            'facebooklink' => 'nullable|url|max:255',
            'linkedinlink' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive,draft'
        ];

        // Handle slug validation for create and update
        if ($this->isMethod('post')) {
            // Creating new team member
            $rules['slug'] = 'nullable|string|max:255|unique:teams,slug';
        } else {
            // Updating existing team member
            $teamId = $this->route('team') ? $this->route('team')->id : null;
            $rules['slug'] = ['nullable', 'string', 'max:255', Rule::unique('teams', 'slug')->ignore($teamId)];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The team member name is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'phone.max' => 'The phone number may not be greater than 20 characters.',
            'designation.max' => 'The designation may not be greater than 255 characters.',
            'orderlist.integer' => 'The order list must be a number.',
            'orderlist.min' => 'The order list must be at least 0.',
            'slug.unique' => 'This slug is already taken. Please choose a different one.',
            'status.required' => 'Please select a status.',
            'status.in' => 'The selected status is invalid.',
            'image.image' => 'The image must be an image file.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
            'image.max' => 'The image may not be greater than 2MB.',
            'tagline.max' => 'The tagline may not be greater than 500 characters.',
            'metatitle.max' => 'The meta title may not be greater than 255 characters.',
            'metadescription.max' => 'The meta description may not be greater than 500 characters.',
            'metakeywords.max' => 'The meta keywords may not be greater than 1000 characters.',
            'facebooklink.url' => 'Please enter a valid Facebook URL.',
            'facebooklink.max' => 'The Facebook link may not be greater than 255 characters.',
            'linkedinlink.url' => 'Please enter a valid LinkedIn URL.',
            'linkedinlink.max' => 'The LinkedIn link may not be greater than 255 characters.',
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
            'googleschema' => 'Google Schema',
            'facebooklink' => 'Facebook link',
            'linkedinlink' => 'LinkedIn link',
            'orderlist' => 'order list'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Remove empty googleschema to avoid validation issues
        if ($this->has('googleschema') && empty(trim($this->googleschema))) {
            $this->merge(['googleschema' => null]);
        }

        // Validate JSON format if googleschema is provided
        if ($this->filled('googleschema')) {
            $decoded = json_decode($this->googleschema, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->merge(['googleschema' => 'invalid_json']);
            }
        }

        // Set default orderlist if not provided
        if (!$this->filled('orderlist')) {
            $this->merge(['orderlist' => 0]);
        }
    }
}
