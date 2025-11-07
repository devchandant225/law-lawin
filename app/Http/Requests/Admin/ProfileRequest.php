<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'logo' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif,svg|max:2048',
            'email' => 'required|email|max:255',
            'phone1' => 'nullable|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'viber' => 'nullable|string|max:20',
            'wechat_link' => 'nullable|string|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:1000',
            'google_map_link' => 'nullable|url|max:500',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get custom attribute names
     */
    public function attributes(): array
    {
        return [
            'logo' => 'Organization Logo',
            'email' => 'Email Address',
            'phone1' => 'Primary Phone',
            'phone2' => 'Secondary Phone',
            'whatsapp' => 'WhatsApp Number',
            'viber' => 'Viber Number',
            'wechat_link' => 'WeChat Profile',
            'facebook_link' => 'Facebook Link',
            'instagram_link' => 'Instagram Link',
            'twitter_link' => 'Twitter Link',
            'linkedin_link' => 'LinkedIn Link',
            'youtube_link' => 'YouTube Link',
            'address' => 'Address',
            'google_map_link' => 'Google Map Link',
            'description' => 'Description',
        ];
    }
}
