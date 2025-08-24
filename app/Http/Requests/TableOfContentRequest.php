<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableOfContentRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $rules = [];

        // Single TOC item validation (for edit)
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules = [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'boolean'
            ];
        }
        // Bulk TOC items validation (for create with repeater)
        else {
            $rules = [
                'toc_items' => 'required|array|min:1',
                'toc_items.*.title' => 'required|string|max:255',
                'toc_items.*.description' => 'nullable|string',
                'toc_items.*.status' => 'boolean'
            ];
        }

        return $rules;
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'toc_items.required' => 'At least one table of contents item is required.',
            'toc_items.min' => 'At least one table of contents item is required.',
            'toc_items.*.title.required' => 'Each table of contents item must have a title.',
            'toc_items.*.title.max' => 'Each title may not be greater than 255 characters.'
        ];
    }

    /**
     * Get custom attribute names.
     */
    public function attributes(): array
    {
        $attributes = [];

        // Generate attribute names for repeater fields
        if ($this->has('toc_items') && is_array($this->toc_items)) {
            foreach ($this->toc_items as $index => $item) {
                $attributes["toc_items.{$index}.title"] = "Item #" . ($index + 1) . " title";
                $attributes["toc_items.{$index}.description"] = "Item #" . ($index + 1) . " description";
            }
        }

        return $attributes;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Clean up empty TOC items from repeater
        if ($this->has('toc_items') && is_array($this->toc_items)) {
            $cleanedItems = array_filter($this->toc_items, function ($item) {
                return !empty($item['title']) || !empty($item['description']);
            });

            // Re-index the array to avoid gaps
            $this->merge([
                'toc_items' => array_values($cleanedItems)
            ]);
        }

        // Set default status if not provided
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            if (!$this->has('status')) {
                $this->merge(['status' => true]);
            }
        } else {
            if ($this->has('toc_items')) {
                $items = $this->toc_items;
                foreach ($items as $index => $item) {
                    if (!isset($item['status'])) {
                        $items[$index]['status'] = true;
                    }
                }
                $this->merge(['toc_items' => $items]);
            }
        }
    }
}
