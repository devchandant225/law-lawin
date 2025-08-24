@extends('layouts.admin')

@section('title', 'View About Us Content Section')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">View About Us Content Section</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.about-us-contents.edit', $aboutUsContent) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
                <a href="{{ route('admin.about-us-contents.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Content Sections</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Content Information -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Content Information</h5>
                    </div>
                    <div class="p-4 space-y-4">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                                {{ $aboutUsContent->title ?: 'No title provided' }}
                            </div>
                        </div>

                        <!-- Description 1 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description 1</label>
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-200 min-h-[100px]">
                                @if($aboutUsContent->desc_1)
                                    <div class="whitespace-pre-line">{{ $aboutUsContent->desc_1 }}</div>
                                @else
                                    <span class="text-gray-500 italic">No description provided</span>
                                @endif
                            </div>
                        </div>

                        <!-- Description 2 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description 2</label>
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-200 min-h-[100px]">
                                @if($aboutUsContent->desc_2)
                                    <div class="whitespace-pre-line">{{ $aboutUsContent->desc_2 }}</div>
                                @else
                                    <span class="text-gray-500 italic">No description provided</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Images -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Images</h5>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Image 1 -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Image 1</label>
                                @if($aboutUsContent->image1)
                                    <div class="space-y-2">
                                        <img src="{{ asset('storage/' . $aboutUsContent->image1) }}" alt="Image 1" class="w-full h-48 object-cover rounded-lg border border-gray-300">
                                        <p class="text-xs text-gray-500 break-all">{{ $aboutUsContent->image1 }}</p>
                                    </div>
                                @else
                                    <div class="w-full h-48 bg-gray-100 rounded-lg border border-gray-300 flex items-center justify-center">
                                        <div class="text-center text-gray-500">
                                            <i class="fas fa-image text-2xl mb-2"></i>
                                            <p class="text-sm">No image provided</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Image 2 -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Image 2</label>
                                @if($aboutUsContent->image2)
                                    <div class="space-y-2">
                                        <img src="{{ asset('storage/' . $aboutUsContent->image2) }}" alt="Image 2" class="w-full h-48 object-cover rounded-lg border border-gray-300">
                                        <p class="text-xs text-gray-500 break-all">{{ $aboutUsContent->image2 }}</p>
                                    </div>
                                @else
                                    <div class="w-full h-48 bg-gray-100 rounded-lg border border-gray-300 flex items-center justify-center">
                                        <div class="text-center text-gray-500">
                                            <i class="fas fa-image text-2xl mb-2"></i>
                                            <p class="text-sm">No image provided</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-4 space-y-6">
                    <!-- Content Settings -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Content Settings</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <!-- Page Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Page Type</label>
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if($aboutUsContent->page_type === 'about-page') bg-blue-100 text-blue-800
                                        @elseif($aboutUsContent->page_type === 'home-page') bg-purple-100 text-purple-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $aboutUsContent->page_type_label }}
                                    </span>
                                </div>
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <div class="flex items-center">
                                    @php
                                        $badgeClasses = [
                                            'active' => 'bg-green-100 text-green-800',
                                            'inactive' => 'bg-red-100 text-red-800',
                                        ][$aboutUsContent->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeClasses }}">
                                        {{ $aboutUsContent->status_label }}
                                    </span>
                                </div>
                            </div>

                            <!-- Order -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                                <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                                    {{ $aboutUsContent->order_list ?? 'Not set' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Meta Information -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Meta Information</h5>
                        </div>
                        <div class="p-4 space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">ID:</span>
                                <span class="font-medium">#{{ $aboutUsContent->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Created:</span>
                                <span class="font-medium">{{ $aboutUsContent->created_at->format('M d, Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Updated:</span>
                                <span class="font-medium">{{ $aboutUsContent->updated_at->format('M d, Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Last Updated:</span>
                                <span class="font-medium">{{ $aboutUsContent->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Actions</h5>
                        </div>
                        <div class="p-4">
                            <div class="grid gap-2">
                                <a href="{{ route('admin.about-us-contents.edit', $aboutUsContent) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit Content Section</span>
                                </a>
                                <button type="button" onclick="toggleStatus({{ $aboutUsContent->id }})" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-50">
                                    <i class="fas fa-toggle-{{ $aboutUsContent->status === 'active' ? 'on' : 'off' }}"></i>
                                    <span>Toggle Status</span>
                                </button>
                                <button type="button" onclick="confirmDelete('{{ $aboutUsContent->id }}', '{{ addslashes($aboutUsContent->title ?: 'Untitled Content') }}')" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
                                    <i class="fas fa-trash"></i>
                                    <span>Delete Content Section</span>
                                </button>
                                <form id="delete-form-{{ $aboutUsContent->id }}" action="{{ route('admin.about-us-contents.destroy', $aboutUsContent) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="{{ route('admin.about-us-contents.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Back to List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(contentSectionId, contentSectionTitle) {
    if (confirm('Are you sure you want to delete this content section: "' + contentSectionTitle + '"? This action cannot be undone.')) {
        document.getElementById('delete-form-' + contentSectionId).submit();
    }
}

async function toggleStatus(contentSectionId) {
    try {
        const response = await fetch(`/admin/about-us-contents/${contentSectionId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const data = await response.json();

        if (data.success) {
            // Reload the page to reflect the changes
            window.location.reload();
        } else {
            alert('Failed to toggle status. Please try again.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    }
}
</script>
@endsection
