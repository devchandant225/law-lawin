<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FAQRequest extends FormRequest
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
            'question' => 'required|string|max:1000',
            'answer' => 'required|string|max:5000',
            'publication_id' => 'required|exists:publications,id',
            'status' => 'required|in:active,inactive'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'question.required' => 'The FAQ question is required.',
            'question.max' => 'The question may not be greater than 1000 characters.',
            'answer.required' => 'The FAQ answer is required.',
            'answer.max' => 'The answer may not be greater than 5000 characters.',
            'publication_id.required' => 'Please select a publication for this FAQ.',
            'publication_id.exists' => 'The selected publication does not exist.',
            'status.required' => 'Please select a status for the FAQ.',
            'status.in' => 'The selected status is invalid.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'publication_id' => 'publication',
        ];
    }
}
