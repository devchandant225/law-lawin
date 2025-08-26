@extends('layouts.admin')

@section('title', 'View Portfolio')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Portfolio Details</h1>
                <p class="text-gray-600 mt-1">View portfolio item information.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700">
                    <i class="fas fa-edit"></i>
                    <span>Edit Portfolio</span>
                </a>
                <a href="{{ route('admin.portfolios.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Portfolios</span>
                </a>
            </div>
        </div>

        <!-- Portfolio Details -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Image Section -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Portfolio Image</h3>
                        @if($portfolio->image)
                            <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" class="w-full rounded-lg object-cover border border-gray-200 max-h-96">
                        @else
                            <div class="w-full h-64 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200">
                                <div class="text-center">
                                    <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-500">No image available</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Details Section -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Portfolio Information</h3>
                            
                            <!-- Title -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <p class="text-gray-900 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">{{ $portfolio->title }}</p>
                            </div>

                            <!-- Order -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                                <p class="text-gray-900 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">{{ $portfolio->order }}</p>
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                                    @php
                                        $badgeClasses = [
                                            'active' => 'bg-green-100 text-green-800',
                                            'inactive' => 'bg-red-100 text-red-800'
                                        ][$portfolio->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $badgeClasses }}">{{ ucfirst($portfolio->status) }}</span>
                                </div>
                            </div>

                            <!-- Timestamps -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Created At</label>
                                    <p class="text-gray-900 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm">{{ $portfolio->created_at->format('M d, Y \a\t H:i') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Updated At</label>
                                    <p class="text-gray-900 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm">{{ $portfolio->updated_at->format('M d, Y \a\t H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button type="button" onclick="toggleStatus()" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    {{ $portfolio->status === 'active' ? 'Set as Inactive' : 'Set as Active' }}
                </button>
            </div>
            
            <div class="flex items-center gap-3">
                <button type="button" onclick="confirmDelete()" class="px-4 py-2 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
                    <i class="fas fa-trash mr-2"></i>Delete Portfolio
                </button>
                <form id="delete-form" action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleStatus() {
    if (confirm('Are you sure you want to change the status of this portfolio?')) {
        fetch(`/admin/portfolios/{{ $portfolio->id }}/toggle-status`, {
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
            alert('Error updating status');
        });
    }
}

function confirmDelete() {
    if (confirm('Are you sure you want to delete "{{ $portfolio->title }}"? This action cannot be undone.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection
