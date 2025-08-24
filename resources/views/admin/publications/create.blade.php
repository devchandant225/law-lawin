@extends('layouts.admin')

@section('title', 'Create New Publication')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Create New Publication</h1>
            <a href="{{ route('admin.publications.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Publications</span>
            </a>
        </div>

        <form action="{{ route('admin.publications.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Basic Information -->
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Basic Information</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <!-- Title & Slug -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-600">*</span></label>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}" required onkeyup="generateSlug()"
                                           placeholder="Enter publication title"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Auto-generated from title"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('slug') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('slug')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Used in the URL. Leave empty to auto-generate.</p>
                                </div>
                            </div>

                            <!-- Excerpt -->
                            <div>
                                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                                <textarea id="excerpt" name="excerpt" rows="3" placeholder="Short summary of the publication"
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('excerpt') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('excerpt') }}</textarea>
                                @error('excerpt')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Brief summary that appears in publication listings</p>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">SEO Settings</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <!-- Meta Title -->
                            <div>
                                <label for="metatitle" class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                                <input type="text" id="metatitle" name="metatitle" value="{{ old('metatitle') }}" maxlength="255" placeholder="Up to 60 characters recommended"
                                       class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('metatitle') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                @error('metatitle')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters</p>
                            </div>

                            <!-- Meta Description -->
                            <div>
                                <label for="metadescription" class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                                <textarea id="metadescription" name="metadescription" rows="3" maxlength="500" placeholder="Up to 160 characters recommended"
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('metadescription') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('metadescription') }}</textarea>
                                @error('metadescription')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters</p>
                            </div>

                            <!-- Meta Keywords -->
                            <div>
                                <label for="metakeywords" class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                                <input type="text" id="metakeywords" name="metakeywords" value="{{ old('metakeywords') }}" placeholder="keyword1, keyword2, keyword3"
                                       class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('metakeywords') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                @error('metakeywords')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Comma-separated keywords</p>
                            </div>
                        </div>
                    </div>

                    <!-- Google Schema -->
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Google Schema (JSON-LD)</h5>
                        </div>
                        <div class="p-4">
                            <div>
                                <label for="google_schema" class="block text-sm font-medium text-gray-700 mb-1">Schema JSON</label>
                                <textarea id="google_schema" name="google_schema" rows="8" placeholder="Enter valid JSON-LD schema"
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('google_schema') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('google_schema') }}</textarea>
                                @error('google_schema')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate based on publication data. <a href="#" onclick="generateSchema()" class="text-indigo-600 hover:underline">Generate Sample Schema</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-4 space-y-6">
                        <!-- Publication Settings -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Publication Settings</h5>
                            </div>
                            <div class="p-4 space-y-4">
                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-600">*</span></label>
                                    <select id="status" name="status" required
                                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Order List -->
                                <div>
                                    <label for="orderlist" class="block text-sm font-medium text-gray-700 mb-1">Order List</label>
                                    <input type="number" id="orderlist" name="orderlist" value="{{ old('orderlist', 0) }}" min="0" max="9999"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('orderlist') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('orderlist')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Lower numbers appear first in lists</p>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Featured Image</h5>
                            </div>
                            <div class="p-4 space-y-4">
                                <div class="mb-3">
                                    <label for="feature_image" class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                                    <input type="file" id="feature_image" name="feature_image" accept="image/*" onchange="previewImage(this)"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('feature_image') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('feature_image')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Supported formats: JPEG, PNG, JPG, GIF, WebP (Max: 2MB)</p>
                                </div>
                                
                                <!-- Image Preview -->
                                <div id="image-preview" style="display: none;">
                                    <img id="preview" src="" alt="Preview" class="rounded border border-gray-200 max-h-52">
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="p-4">
                                <div class="grid gap-2">
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                        <i class="fas fa-save"></i>
                                        <span>Create Publication</span>
                                    </button>
                                    <a href="{{ route('admin.publications.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Generate slug from title
function generateSlug() {
    const title = document.getElementById('title').value;
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
}

// Preview uploaded image
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Generate sample schema
function generateSchema() {
    const title = document.getElementById('title').value || 'Your Publication Title';
    const description = document.getElementById('excerpt').value || 'Your publication excerpt';
    
    const schema = {
        "@context": "https://schema.org",
        "@type": "Article",
        "name": title,
        "description": description,
        "url": window.location.origin + "/publications/your-slug",
        "datePublished": new Date().toISOString(),
        "dateModified": new Date().toISOString()
    };
    
    document.getElementById('google_schema').value = JSON.stringify(schema, null, 2);
}
</script>
@endsection
