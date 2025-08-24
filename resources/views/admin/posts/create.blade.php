@extends('layouts.admin')

@section('title', 'Create New Post')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Create New Post</h1>
            <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Posts</span>
            </a>
        </div>

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
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
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-600">*</span></label>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}" required onkeyup="generateSlug()"
                                           placeholder="Enter post title"
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

                                <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-600">*</span></label>
                                <textarea id="description" name="description" rows="8" required
                                          placeholder="Write the full content of your post here..."
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                                <!-- Excerpt -->
                            <div>
                                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                                <textarea id="excerpt" name="excerpt" rows="3" placeholder="Short summary of the post"
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('excerpt') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('excerpt') }}</textarea>
                                @error('excerpt')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Brief summary that appears in post listings</p>
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
                                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" maxlength="255" placeholder="Up to 60 characters recommended"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('meta_title') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('meta_title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters</p>
                                </div>

                                <!-- Meta Description -->
                                <div>
                                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                                    <textarea id="meta_description" name="meta_description" rows="3" maxlength="500" placeholder="Up to 160 characters recommended"
                                              class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('meta_description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters</p>
                                </div>

                                <!-- Meta Keywords -->
                                <div>
                                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                                    <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('meta_keywords') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('meta_keywords')
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
                                    <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate based on post type. <a href="#" onclick="generateSchema()" class="text-indigo-600 hover:underline">Generate Sample Schema</a></p>
                                </div>
                            </div>
                        </div>
                </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="lg:sticky lg:top-4 space-y-6">
                        <!-- Post Settings -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Post Settings</h5>
                            </div>
                            <div class="p-4 space-y-4">
                                <!-- Type -->
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type <span class="text-red-600">*</span></label>
                                    <select id="type" name="type" required
                                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('type') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                        <option value="">Select Type</option>
                                        <option value="service" {{ old('type') == 'service' ? 'selected' : '' }}>Service</option>
                                        <option value="practice" {{ old('type') == 'practice' ? 'selected' : '' }}>Practice</option>
                                        <option value="news" {{ old('type') == 'news' ? 'selected' : '' }}>News</option>
                                        <option value="blog" {{ old('type') == 'blog' ? 'selected' : '' }}>Blog</option>
                                    </select>
                                    @error('type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

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
                                        <span>Create Post</span>
                                    </button>
                                    <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
    const type = document.getElementById('type').value || 'blog';
    const title = document.getElementById('title').value || 'Your Post Title';
    const description = document.getElementById('excerpt').value || 'Your post excerpt';
    
    const schemaTypes = {
        'service': 'Service',
        'practice': 'Article', 
        'news': 'NewsArticle',
        'blog': 'BlogPosting'
    };
    
    const schema = {
        "@context": "https://schema.org",
        "@type": schemaTypes[type] || 'Article',
        "name": title,
        "description": description,
        "url": window.location.origin + "/posts/your-slug",
        "datePublished": new Date().toISOString(),
        "dateModified": new Date().toISOString()
    };
    
    document.getElementById('google_schema').value = JSON.stringify(schema, null, 2);
}
   CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ 'https://beinseo.com/upload_blog_editor_image?_token=' . csrf_token() }}",
            filebrowserUploadMethod: 'form'
        })
</script>
@endsection
