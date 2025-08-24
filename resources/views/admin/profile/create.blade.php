@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Create Organization Profile</h1>
                <p class="text-gray-600 mt-2">Set up your plant breeding organization profile to get started.</p>
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
                    <p class="text-sm font-medium text-blue-800">Complete Profile Setup</p>
                    <p class="text-sm text-blue-700 mt-1">Fill in the information below to create your organization profile. You can always edit this information later.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Form -->
    <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Basic Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Basic Information</h2>
                <p class="text-sm text-gray-600 mt-1">Provide basic details about your organization</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Organization Name *</label>
                        <input type="text" name="name" id="name" 
                               value="{{ old('name', config('app.name', 'Plant Breeding Organization')) }}" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="established" class="block text-sm font-medium text-gray-700 mb-2">Established Year</label>
                        <input type="number" name="established" id="established" 
                               value="{{ old('established', date('Y')) }}" 
                               min="1800" max="{{ date('Y') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        @error('established')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Organization Type *</label>
                        <select name="type" id="type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <option value="">Select organization type</option>
                            <option value="Research Institute" {{ old('type') == 'Research Institute' ? 'selected' : '' }}>Research Institute</option>
                            <option value="University" {{ old('type') == 'University' ? 'selected' : '' }}>University</option>
                            <option value="Government Agency" {{ old('type') == 'Government Agency' ? 'selected' : '' }}>Government Agency</option>
                            <option value="Private Company" {{ old('type') == 'Private Company' ? 'selected' : '' }}>Private Company</option>
                            <option value="Non-Profit Organization" {{ old('type') == 'Non-Profit Organization' ? 'selected' : '' }}>Non-Profit Organization</option>
                            <option value="International Organization" {{ old('type') == 'International Organization' ? 'selected' : '' }}>International Organization</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" id="location" 
                               value="{{ old('location') }}" 
                               placeholder="City, Country"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="mission" class="block text-sm font-medium text-gray-700 mb-2">Mission Statement</label>
                    <textarea name="mission" id="mission" rows="4" 
                              placeholder="Describe your organization's mission and goals..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">{{ old('mission') }}</textarea>
                    @error('mission')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Contact Information</h2>
                <p class="text-sm text-gray-600 mt-1">How people can reach your organization</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email') }}" 
                               placeholder="contact@example.com"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone1" class="block text-sm font-medium text-gray-700 mb-2">Primary Phone Number</label>
                        <input type="tel" name="phone1" id="phone1" 
                               value="{{ old('phone1', $profile->phone1 ?? '') }}" 
                               placeholder="+1 (555) 123-4567"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        @error('phone1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone2" class="block text-sm font-medium text-gray-700 mb-2">Secondary Phone Number</label>
                        <input type="tel" name="phone2" id="phone2" 
                               value="{{ old('phone2', $profile->phone2 ?? '') }}" 
                               placeholder="+1 (555) 987-6543"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        @error('phone2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number</label>
                        <input type="tel" name="whatsapp" id="whatsapp" 
                               value="{{ old('whatsapp', $profile->whatsapp ?? '') }}" 
                               placeholder="+1 (555) 123-4567"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        @error('whatsapp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="viber" class="block text-sm font-medium text-gray-700 mb-2">Viber Number</label>
                        <input type="tel" name="viber" id="viber" 
                               value="{{ old('viber', $profile->viber ?? '') }}" 
                               placeholder="+1 (555) 123-4567"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
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
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        @error('wechat_link')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea name="address" id="address" rows="3" 
                              placeholder="Full address including street, city, state/province, postal code, country"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website URL</label>
                    <input type="url" name="website" id="website" 
                           value="{{ old('website') }}" 
                           placeholder="https://example.com"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Research Focus -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Research Focus Areas</h2>
                <p class="text-sm text-gray-600 mt-1">Select the areas your organization focuses on</p>
            </div>
            <div class="p-6">
                @php
                    $focus_options = [
                        'Crop Improvement', 'Disease Resistance', 'Pest Resistance', 'Yield Enhancement',
                        'Climate Adaptation', 'Drought Tolerance', 'Salt Tolerance', 'Nutritional Enhancement',
                        'Seed Technology', 'Biotechnology', 'Molecular Breeding', 'Traditional Breeding',
                        'Conservation', 'Genetic Diversity', 'Sustainable Agriculture', 'Food Security'
                    ];
                    $selected_areas = old('focus_areas', ['Crop Improvement', 'Disease Resistance']);
                @endphp
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($focus_options as $option)
                        <label class="flex items-center">
                            <input type="checkbox" name="focus_areas[]" value="{{ $option }}" 
                                   {{ in_array($option, $selected_areas) ? 'checked' : '' }}
                                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">{{ $option }}</span>
                        </label>
                    @endforeach
                </div>
                @error('focus_areas')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end gap-4 pt-6">
            <a href="{{ route('admin.profile.index') }}" 
               class="px-6 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                Create Profile
            </button>
        </div>
    </form>
</div>
@endsection
