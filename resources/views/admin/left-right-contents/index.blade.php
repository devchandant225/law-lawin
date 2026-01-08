@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">Left-Right Contents</h1>
        <a href="{{ route('admin.left-right-contents.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Content
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800">
                <thead>
                    <tr class="bg-gray-700 text-white">
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Title</th>
                        <th class="py-3 px-4 text-left">Post</th>
                        <th class="py-3 px-4 text-left">Order</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-200">
                    @forelse($contents as $content)
                        <tr class="border-b border-gray-700 hover:bg-gray-750">
                            <td class="py-3 px-4">{{ $content->id }}</td>
                            <td class="py-3 px-4">{{ Str::limit($content->title, 30) }}</td>
                            <td class="py-3 px-4">{{ $content->post->title ?? 'N/A' }}</td>
                            <td class="py-3 px-4">{{ $content->order }}</td>
                            <td class="py-3 px-4">
                                <button
                                    onclick="toggleStatus({{ $content->id }})"
                                    class="status-toggle px-2 py-1 rounded-full text-xs {{ $content->status ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}"
                                    data-id="{{ $content->id }}"
                                >
                                    {{ $content->status ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.left-right-contents.edit', $content->id) }}" class="text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.left-right-contents.destroy', $content->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Are you sure you want to delete this content?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-400">No left-right contents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function toggleStatus(id) {
            try {
                const response = await fetch(`/admin/left-right-contents/${id}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.success) {
                        // Find the status button and toggle its state
                        const button = document.querySelector(`button[data-id="${id}"]`);
                        const isCurrentlyActive = button.textContent.trim() === 'Active';

                        if (isCurrentlyActive) {
                            button.textContent = 'Inactive';
                            button.className = 'status-toggle px-2 py-1 rounded-full text-xs bg-red-600 text-white';
                        } else {
                            button.textContent = 'Active';
                            button.className = 'status-toggle px-2 py-1 rounded-full text-xs bg-green-600 text-white';
                        }
                    }
                } else {
                    alert('Failed to update status');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while updating status');
            }
        }
    </script>
</div>
@endsection