@extends('layouts.admin')

@section('title', 'Add New Team Member')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Add New Team Member</h1>
            <a href="{{ route('admin.teams.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Team</span>
            </a>
        </div>

        <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
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
                            <!-- Name & Slug -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-600">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required onkeyup="generateSlug()"
                                           placeholder="Enter member name"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Auto-generated from name"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('slug') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('slug')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Used in the URL. Leave empty to auto-generate.</p>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@example.com"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+1234567890"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('phone') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Designation & Tagline -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="designation" class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                                    <input type="text" id="designation" name="designation" value="{{ old('designation') }}" placeholder="e.g., Senior Partner"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('designation') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('designation')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="orderlist" class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                                    <input type="number" id="orderlist" name="orderlist" value="{{ old('orderlist', 0) }}" min="0"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('orderlist') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('orderlist')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Display order (0 = first)</p>
                                </div>
                            </div>

                            <!-- Tagline -->
                            <div>
                                <label for="tagline" class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                                <input type="text" id="tagline" name="tagline" value="{{ old('tagline') }}" placeholder="Brief professional tagline"
                                       class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('tagline') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                @error('tagline')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Short, catchy description</p>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea id="description" name="description" rows="6" placeholder="Detailed bio and description..."
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Professional Information</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <!-- Experience -->
                            <div>
                                <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Experience</label>
                                <textarea id="experience" name="experience" rows="4" placeholder="Professional experience and achievements..."
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('experience') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('experience') }}</textarea>
                                @error('experience')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Qualification -->
                            <div>
                                <label for="qualification" class="block text-sm font-medium text-gray-700 mb-1">Qualification</label>
                                <textarea id="qualification" name="qualification" rows="4" placeholder="Educational qualifications and certifications..."
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('qualification') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('qualification') }}</textarea>
                                @error('qualification')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Additional Details -->
                            <div>
                                <label for="additional_details" class="block text-sm font-medium text-gray-700 mb-1">Additional Details</label>
                                <textarea id="additional_details" name="additional_details" rows="4" placeholder="Any additional information..."
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('additional_details') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('additional_details') }}</textarea>
                                @error('additional_details')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Social Links</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="linkedinlink" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                                    <input type="url" id="linkedinlink" name="linkedinlink" value="{{ old('linkedinlink') }}" placeholder="https://linkedin.com/in/username"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('linkedinlink') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('linkedinlink')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="facebooklink" class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                                    <input type="url" id="facebooklink" name="facebooklink" value="{{ old('facebooklink') }}" placeholder="https://facebook.com/username"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('facebooklink') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('facebooklink')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
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
                                <label for="googleschema" class="block text-sm font-medium text-gray-700 mb-1">Schema JSON</label>
                                <textarea id="googleschema" name="googleschema" rows="8" placeholder="Enter valid JSON-LD schema"
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('googleschema') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('googleschema') }}</textarea>
                                @error('googleschema')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate. <a href="#" onclick="generateSchema()" class="text-indigo-600 hover:underline">Generate Sample Schema</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-4 space-y-6">
                        <!-- Status -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Settings</h5>
                            </div>
                            <div class="p-4">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-600">*</span></label>
                                    <select id="status" name="status" required
                                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Profile Image -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Profile Image</h5>
                            </div>
                            <div class="p-4 space-y-4">
                                <div class="mb-3">
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('image') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('image')
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
                                        <span>Add Member</span>
                                    </button>
                                    <a href="{{ route('admin.teams.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</a>
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
// Generate slug from name
function generateSlug() {
    const name = document.getElementById('name').value;
    const slug = name.toLowerCase()
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
    const name = document.getElementById('name').value || 'Team Member Name';
    const designation = document.getElementById('designation').value || 'Position';
    const tagline = document.getElementById('tagline').value || 'Professional tagline';
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const linkedinlink = document.getElementById('linkedinlink').value;
    const facebooklink = document.getElementById('facebooklink').value;
    
    const schema = {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": name,
        "jobTitle": designation,
        "description": tagline,
        "url": window.location.origin + "/team/member-slug"
    };
    
    if (email) schema.email = email;
    if (phone) schema.telephone = phone;
    
    const sameAs = [];
    if (linkedinlink) sameAs.push(linkedinlink);
    if (facebooklink) sameAs.push(facebooklink);
    if (sameAs.length > 0) schema.sameAs = sameAs;
    
    document.getElementById('googleschema').value = JSON.stringify(schema, null, 2);
}

// Initialize CKEditor if available
if (typeof CKEDITOR !== 'undefined') {
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{ 'https://beinseo.com/upload_blog_editor_image?_token=' . csrf_token() }}",
        filebrowserUploadMethod: 'form'
    });
}
</script>
@endsection
