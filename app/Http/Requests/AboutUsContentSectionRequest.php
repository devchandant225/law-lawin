<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AboutUsContentSection;

class AboutUsContentSectionRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'desc_1' => 'nullable|string',
            'desc_2' => 'nullable|string',
            'image1_alt' => 'nullable|string|max:255',
            'image2_alt' => 'nullable|string|max:255',
            'page_type' => 'required|in:' . implode(',', array_keys(AboutUsContentSection::getPageTypeOptions())),
            'status' => 'required|in:' . implode(',', array_keys(AboutUsContentSection::getStatusOptions())),
            'order_list' => 'nullable|integer|min:0'
        ];

        // Image validation rules
        if ($this->isMethod('post')) {
            // Creating new record - images are optional
            $rules['image1'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            $rules['image2'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        } else {
            // Updating existing record - images are optional
            $rules['image1'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            $rules['image2'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'page_type.required' => 'Page type is required.',
            'page_type.in' => 'Please select a valid page type.',
            'status.required' => 'Status is required.',
            'status.in' => 'Please select a valid status.',
            'order_list.integer' => 'Order must be a number.',
            'order_list.min' => 'Order must be at least 0.',
            'image1.image' => 'Image 1 must be a valid image file.',
            'image1.mimes' => 'Image 1 must be a file of type: jpeg, png, jpg, gif, webp.',
            'image1.max' => 'Image 1 may not be greater than 2MB.',
            'image2.image' => 'Image 2 must be a valid image file.',
            'image2.mimes' => 'Image 2 must be a file of type: jpeg, png, jpg, gif, webp.',
            'image2.max' => 'Image 2 may not be greater than 2MB.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'desc_1' => 'description 1',
            'desc_2' => 'description 2',
            'image1' => 'image 1',
            'image2' => 'image 2',
            'page_type' => 'page type',
            'order_list' => 'order',
        ];
    }
}
