@extends('layouts.admin')

@section('title', 'View Page: ' . $page->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">View Page</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.pages.edit', $page) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors">
                    <i class="fas fa-edit"></i>
                    <span>Edit Page</span>
                </a>
                <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Pages</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Page Content -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900">{{ $page->title }}</h2>
                        <div class="mt-2 flex items-center gap-4 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <i class="fas fa-calendar"></i>
                                Created: {{ $page->created_at->format('M d, Y H:i') }}
                            </span>
                            @if($page->updated_at->gt($page->created_at))
                                <span class="flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    Updated: {{ $page->updated_at->format('M d, Y H:i') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        @if($page->feature_image)
                            <div class="mb-6">
                                <img src="{{ $page->feature_image_url }}" alt="{{ $page->title }}" class="w-full h-64 object-cover rounded-lg border border-gray-200">
                            </div>
                        @endif

                        @if($page->excerpt)
                            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <h4 class="font-semibold text-blue-900 mb-2">Excerpt</h4>
                                <p class="text-blue-800">{{ $page->excerpt }}</p>
                            </div>
                        @endif

                        @if($page->description)
                            <div class="prose max-w-none">
                                <h4 class="font-semibold text-gray-900 mb-3">Description</h4>
                                <div class="text-gray-700 whitespace-pre-line">{{ $page->description }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SEO Information -->
                @if($page->metatitle || $page->metadescription || $page->metakeywords)
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">SEO Information</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            @if($page->metatitle)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                                    <p class="text-gray-900">{{ $page->metatitle }}</p>
                                </div>
                            @endif

                            @if($page->metadescription)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                                    <p class="text-gray-700">{{ $page->metadescription }}</p>
                                </div>
                            @endif

                            @if($page->metakeywords)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                                    <p class="text-gray-700">{{ $page->metakeywords }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- JSON-LD Schema -->
                @if($page->json_ld_schema)
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">JSON-LD Schema</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-gray-50 p-4 rounded-lg text-sm overflow-x-auto"><code>{{ json_encode($page->json_ld_schema, JSON_PRETTY_PRINT) }}</code></pre>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-4 space-y-6">
                    <!-- Page Details -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Page Details</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Status:</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $page->status_badge_class }}">
                                    {{ $page->status_name }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Type:</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-800">
                                    {{ $page->type_name }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Slug:</span>
                                <span class="text-sm text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded">{{ $page->slug }}</span>
                            </div>

                            <div class="pt-2 border-t border-gray-200">
                                <span class="text-sm text-gray-600">URL:</span>
                                <div class="mt-1">
                                    <a href="{{ url('/page/' . $page->slug) }}" target="_blank" class="text-sm text-primary hover:text-primary/80 break-all">
                                        {{ url('/page/' . $page->slug) }}
                                        <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Actions</h5>
                        </div>
                        <div class="p-4 space-y-3">
                            <a href="{{ route('admin.pages.edit', $page) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors">
                                <i class="fas fa-edit"></i>
                                <span>Edit Page</span>
                            </a>

                            <button type="button" onclick="toggleStatus({{ $page->id }})" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-50 transition-colors">
                                <i class="fas fa-toggle-{{ $page->status == 'active' ? 'on' : 'off' }}"></i>
                                <span>{{ $page->status == 'active' ? 'Deactivate' : 'Activate' }}</span>
                            </button>

                            <button type="button" onclick="confirmDelete({{ $page->id }}, '{{ $page->title }}')" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-red-300 text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-trash"></i>
                                <span>Delete Page</span>
                            </button>

                            <form id="delete-form-{{ $page->id }}" action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Statistics</h5>
                        </div>
                        <div class="p-4 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Created:</span>
                                <span class="text-sm text-gray-900">{{ $page->created_at->format('M d, Y') }}</span>
                            </div>

                            @if($page->updated_at->gt($page->created_at))
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Last Updated:</span>
                                    <span class="text-sm text-gray-900">{{ $page->updated_at->format('M d, Y') }}</span>
                                </div>
                            @endif

                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">ID:</span>
                                <span class="text-sm text-gray-900">#{{ $page->id }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(pageId, pageTitle) {
    if (confirm('Are you sure you want to delete "' + pageTitle + '"? This action cannot be undone.')) {
        document.getElementById('delete-form-' + pageId).submit();
    }
}

function toggleStatus(pageId) {
    fetch(`{{ url('admin/pages') }}/${pageId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error updating status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating status');
    });
}
</script>
@endsection
