@extends('layouts.admin')

@section('title', 'Edit Meta Tag')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-indigo-600 font-semibold text-sm uppercase tracking-wider mb-1">
                <i class="fas fa-edit"></i>
                <span>Editor</span>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Meta Tag</h1>
            <p class="text-gray-500 mt-1">Updating metadata for <span class="font-bold text-indigo-600">{{ ucfirst(str_replace('-', ' ', $metaTag->page_type)) }}</span></p>
        </div>
        <a href="{{ route('admin.meta-tags.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all shadow-sm">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Back to List</span>
        </a>
    </div>

    <form action="{{ route('admin.meta-tags.update', $metaTag) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Basic Info & SEO -->
            <div class="lg:col-span-2 space-y-8">
                <!-- SEO Content Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="font-bold text-gray-900">Search Engine Optimization</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                Meta Title <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="title" id="title" value="{{ old('title', $metaTag->title) }}" maxlength="255" 
                                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-gray-50/30 transition-all" 
                                    placeholder="Enter page title for search results" required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span id="title-count" class="text-xs font-medium text-gray-400">0</span>
                                    <span class="text-xs font-medium text-gray-300 mx-1">/</span>
                                    <span class="text-xs font-medium text-gray-400">60</span>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">The title tag is one of the most important SEO factors. Aim for 50-60 characters.</p>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="desc" class="block text-sm font-semibold text-gray-700 mb-2">
                                Meta Description
                            </label>
                            <div class="relative">
                                <textarea name="desc" id="desc" rows="4" maxlength="500" 
                                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-gray-50/30 transition-all resize-none"
                                    placeholder="Write a compelling summary of the page content...">{{ old('desc', $metaTag->desc) }}</textarea>
                                <div class="absolute bottom-3 right-4 flex items-center pointer-events-none bg-white/80 px-2 py-1 rounded-md backdrop-blur-sm">
                                    <span id="desc-count" class="text-xs font-medium text-gray-400">0</span>
                                    <span class="text-xs font-medium text-gray-300 mx-1">/</span>
                                    <span class="text-xs font-medium text-gray-400">160</span>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Briefly summarize the page content. Aim for 150-160 characters for best results.</p>
                            @error('desc')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keywords -->
                        <div>
                            <label for="keyword" class="block text-sm font-semibold text-gray-700 mb-2">
                                Meta Keywords
                            </label>
                            <input type="text" name="keyword" id="keyword" value="{{ old('keyword', $metaTag->keyword) }}"
                                class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-gray-50/30 transition-all" 
                                placeholder="legal, law firm, consultation (comma separated)">
                            <p class="mt-2 text-xs text-gray-500">Keywords are less important now but can still be helpful for some search engines.</p>
                            @error('keyword')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Structured Data Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3 class="font-bold text-gray-900">Structured Data (JSON-LD)</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <x-schema-repeater name="schema_head" label="Header Schema" :data="$metaTag->schema_head" />
                        <x-schema-repeater name="schema_body" label="Body Schema" :data="$metaTag->schema_body" />
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings & Image -->
            <div class="space-y-8">
                <!-- Page Configuration Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h3 class="font-bold text-gray-900">Configuration</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Page Type -->
                        <div>
                            <label for="page_type" class="block text-sm font-semibold text-gray-700 mb-2">
                                Page Type <span class="text-red-500">*</span>
                            </label>
                            <select name="page_type" id="page_type" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-gray-50/30 transition-all" required>
                                <option value="">Select Page Type</option>
                                @foreach($pageTypes as $value => $label)
                                    <option value="{{ $value }}" {{ old('page_type', $metaTag->page_type) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('page_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-gray-900">Active Status</span>
                                <span class="text-xs text-gray-500">Enable or disable these tags</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $metaTag->is_active) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Social Media Image Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600">
                            <i class="fas fa-image"></i>
                        </div>
                        <h3 class="font-bold text-gray-900">Social Share Image</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="relative group">
                            <div id="image-preview" class="w-full aspect-video rounded-xl {{ $metaTag->image ? 'border-solid border-indigo-500' : 'bg-gray-100 border-2 border-dashed border-gray-300' }} flex flex-col items-center justify-center overflow-hidden transition-all group-hover:border-indigo-400">
                                @if($metaTag->image)
                                    <div id="preview-placeholder" class="text-center p-4 hidden">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-500">Click to upload or drag and drop</p>
                                    </div>
                                    <img id="preview-img" src="{{ Storage::url($metaTag->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div id="preview-placeholder" class="text-center p-4">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-500">Click to upload or drag and drop</p>
                                        <p class="text-xs text-gray-400 mt-1">Recommended: 1200x630px</p>
                                    </div>
                                    <img id="preview-img" class="hidden w-full h-full object-cover">
                                @endif
                            </div>
                            <input type="file" name="image" id="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                        <p class="text-xs text-gray-400 text-center">Leave empty to keep the current image</p>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition-all shadow-lg shadow-indigo-200 active:scale-[0.98]">
                        Update Meta Tag
                    </button>
                    <a href="{{ route('admin.meta-tags.index') }}" class="w-full py-3 bg-white text-center text-gray-600 border border-gray-200 rounded-2xl font-semibold hover:bg-gray-50 transition-all">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Character counters
    function updateCounter(inputId, counterId, limit) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);
        if (input && counter) {
            const length = input.value.length;
            counter.textContent = length;
            
            if (length > limit) {
                counter.classList.add('text-red-500');
            } else if (length > limit * 0.8) {
                counter.classList.add('text-amber-500');
            } else {
                counter.classList.remove('text-red-500', 'text-amber-500');
            }
        }
    }

    document.getElementById('title').addEventListener('input', () => updateCounter('title', 'title-count', 60));
    document.getElementById('desc').addEventListener('input', () => updateCounter('desc', 'desc-count', 160));

    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            const previewImg = document.getElementById('preview-img');
            const placeholder = document.getElementById('preview-placeholder');
            const previewContainer = document.getElementById('image-preview');

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                placeholder.classList.add('hidden');
                previewContainer.classList.remove('bg-gray-100', 'border-dashed');
                previewContainer.classList.add('border-solid', 'border-indigo-500');
            }
            reader.readAsDataURL(file);
        }
    });

    // Initialize counters
    updateCounter('title', 'title-count', 60);
    updateCounter('desc', 'desc-count', 160);
</script>
@endpush
@endsection
