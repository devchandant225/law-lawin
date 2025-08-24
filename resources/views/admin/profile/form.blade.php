@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ $profile ? 'Edit' : 'Create' }} Firm Profile
                </h1>
                <p class="text-gray-600 mt-2">
                    {{ $profile ? 'Update your law firm information and settings.' : 'Set up your law firm profile to get started.' }}
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.profile.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Profile
                </a>
            </div>
        </div>
    </div>

    @if(!$profile)
        <!-- Setup Notice -->
        <div class="mb-8">
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-blue-800">Complete Firm Profile Setup</p>
                        <p class="text-sm text-blue-700 mt-1">Fill in the information below to create your law firm profile. You can always edit this information later.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ $profile ? route('admin.profile.update') : route('admin.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @if($profile)
            @method('PUT')
        @endif

        <!-- Logo Upload -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Law Firm Logo</h2>
                <p class="text-sm text-gray-600 mt-1">Upload your law firm's logo (optional)</p>
            </div>
            <div class="p-6">
                <div class="flex items-center space-x-6">
                    <!-- Current Logo Display -->
                    @if($profile && $profile->logo)
                        <div class="flex-shrink-0">
                            <img class="h-20 w-20 rounded-lg object-cover" src="{{ asset('storage/' . $profile->logo) }}" alt="Current logo">
                        </div>
                    @else
                        <div class="flex-shrink-0">
                            <div class="h-20 w-20 rounded-lg bg-gray-200 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    @endif

                    <!-- Upload Controls -->
                    <div class="flex-1">
                        <input type="file" name="logo" id="logo" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        <p class="mt-2 text-xs text-gray-500">PNG, JPG, GIF up to 2MB. Recommended size: 200x200px</p>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @if($profile && $profile->logo)
                            <div class="mt-3">
                                <a href="{{ route('admin.profile.remove-logo') }}" 
                                   onclick="return confirm('Are you sure you want to remove the current logo?')"
                                   class="text-sm text-red-600 hover:text-red-800">
                                    Remove current logo
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Organization Description -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Firm Description</h2>
                <p class="text-sm text-gray-600 mt-1">Describe your law firm and its practice areas</p>
            </div>
            <div class="p-6">
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                    <textarea name="description" id="description" rows="8" 
                              placeholder="Provide a detailed description of your law firm, its history, expertise, and practice areas..."
                              required
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">{{ old('description', $profile->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Contact Information</h2>
                <p class="text-sm text-gray-600 mt-1">How clients can reach your law firm</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email', $profile->email ?? '') }}" 
                               placeholder="info@lawinpartners.com"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone1" class="block text-sm font-medium text-gray-700 mb-2">Primary Phone</label>
                        <input type="tel" name="phone1" id="phone1" 
                               value="{{ old('phone1', $profile->phone1 ?? '') }}" 
                               placeholder="+1 (555) 123-4567"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('phone1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone2" class="block text-sm font-medium text-gray-700 mb-2">Secondary Phone</label>
                        <input type="tel" name="phone2" id="phone2" 
                               value="{{ old('phone2', $profile->phone2 ?? '') }}" 
                               placeholder="+1 (555) 987-6543"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('phone2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number</label>
                        <input type="tel" name="whatsapp" id="whatsapp" 
                               value="{{ old('whatsapp', $profile->whatsapp ?? '') }}" 
                               placeholder="+1 (555) 123-4567"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('whatsapp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="viber" class="block text-sm font-medium text-gray-700 mb-2">Viber Number</label>
                        <input type="tel" name="viber" id="viber" 
                               value="{{ old('viber', $profile->viber ?? '') }}" 
                               placeholder="+1 (555) 123-4567"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('viber')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="wechat_link" class="block text-sm font-medium text-gray-700 mb-2">WeChat Profile URL</label>
                        <input type="url" name="wechat_link" id="wechat_link" 
                               value="{{ old('wechat_link', $profile->wechat_link ?? '') }}" 
                               placeholder="https://wechat.com/yourprofile"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('wechat_link')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea name="address" id="address" rows="3" 
                              placeholder="Full address including street, city, state/province, postal code, country"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">{{ old('address', $profile->address ?? '') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Social Media Links</h2>
                <p class="text-sm text-gray-600 mt-1">Connect your law firm's social media profiles</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="facebook_link" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M20 10C20 4.477 15.523 0 10 0S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd"/>
                                </svg>
                                Facebook
                            </span>
                        </label>
                        <input type="url" name="facebook_link" id="facebook_link" 
                               value="{{ old('facebook_link', $profile->facebook_link ?? '') }}" 
                               placeholder="https://facebook.com/lawinpartners"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('facebook_link')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="twitter_link" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                                Twitter
                            </span>
                        </label>
                        <input type="url" name="twitter_link" id="twitter_link" 
                               value="{{ old('twitter_link', $profile->twitter_link ?? '') }}" 
                               placeholder="https://twitter.com/lawinpartners"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('twitter_link')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="instagram_link" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm5 5v1h-1V5h1zm-4 2.5A2.5 2.5 0 007.5 10 2.5 2.5 0 0010 12.5 2.5 2.5 0 0012.5 10 2.5 2.5 0 0010 7.5zm0 1a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" clip-rule="evenodd"/>
                                </svg>
                                Instagram
                            </span>
                        </label>
                        <input type="url" name="instagram_link" id="instagram_link" 
                               value="{{ old('instagram_link', $profile->instagram_link ?? '') }}" 
                               placeholder="https://instagram.com/lawinpartners"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('instagram_link')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="linkedin_link" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z"/>
                                </svg>
                                LinkedIn
                            </span>
                        </label>
                        <input type="url" name="linkedin_link" id="linkedin_link" 
                               value="{{ old('linkedin_link', $profile->linkedin_link ?? '') }}" 
                               placeholder="https://linkedin.com/company/lawinpartners"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('linkedin_link')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="youtube_link" class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                YouTube
                            </span>
                        </label>
                        <input type="url" name="youtube_link" id="youtube_link" 
                               value="{{ old('youtube_link', $profile->youtube_link ?? '') }}" 
                               placeholder="https://youtube.com/c/lawinpartners"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200">
                        @error('youtube_link')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end gap-4 pt-6">
            <a href="{{ route('admin.profile.index') }}" 
               class="px-6 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                Cancel
            </a>
                    <button type="submit" 
                    class="px-6 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors duration-200">
                {{ $profile ? 'Save Changes' : 'Create Profile' }}
            </button>
        </div>
    </form>
</div>
@endsection
