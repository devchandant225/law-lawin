@extends('layouts.admin')

@section('title', 'Edit Table of Contents Item - ' . $publication->title)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Table of Contents Item</h1>
                <nav class="flex mt-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                <i class="fas fa-home mr-1"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                                <a href="{{ route('admin.publications.index') }}"
                                    class="text-sm font-medium text-gray-700 hover:text-blue-600">Publications</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                                <a href="{{ route('admin.publications.show', $publication) }}"
                                    class="text-sm font-medium text-gray-700 hover:text-blue-600">{{ Str::limit($publication->title, 30) }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                                <a href="{{ route('admin.publications.table-of-contents.index', $publication) }}"
                                    class="text-sm font-medium text-gray-700 hover:text-blue-600">Table of Contents</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                                <span class="text-sm font-medium text-gray-500">Edit</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('admin.publications.table-of-contents.index', $publication) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to List</span>
                </a>
            </div>
        </div>

        <!-- Publication Info Card -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $publication->title }}</h2>
                    <p class="text-sm text-gray-600">
                        Editing table of contents item
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $publication->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($publication->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-blue-600">Edit Table of Contents Item</h3>
            </div>

            <div class="p-6">
                <form action="{{ route('admin.publications.table-of-contents.update', [$publication, $tableOfContent]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div class="md:col-span-3">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                                id="title" name="title" value="{{ old('title', $tableOfContent->title) }}"
                                placeholder="Enter title" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>
                            <select
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                                id="status" name="status">
                                <option value="1" {{ old('status', $tableOfContent->status) == 1 ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('status', $tableOfContent->status) == 0 ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <textarea
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                            id="description" name="description" rows="5" placeholder="Enter description (optional)">{{ old('description', $tableOfContent->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Order Information -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Order</label>
                        <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        This item is currently at position
                                        <strong>{{ $tableOfContent->order_index }}</strong> in the table of contents.
                                        To change the order, go back to the list and use drag & drop functionality.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-clock mr-1"></i>
                                Last updated: {{ $tableOfContent->updated_at->format('M d, Y \a\t g:i A') }}
                            </p>
                        </div>
                        <div class="flex gap-3">
                            <button type="button"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 transition-colors"
                                onclick="window.history.back()">
                                <i class="fas fa-times"></i>
                                <span>Cancel</span>
                            </button>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 transition-colors">
                                <i class="fas fa-save"></i>
                                <span>Update Item</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Item Actions Card -->
        <div class="bg-white shadow rounded-lg mt-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-blue-600">Quick Actions</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-eye text-blue-500 mr-3"></i>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">View Item</h4>
                                <p class="text-xs text-gray-500">View this table of contents item details</p>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('admin.publications.table-of-contents.show', [$publication, $tableOfContent]) }}"
                                class="inline-flex items-center px-3 py-2 border border-blue-300 text-blue-600 text-sm rounded-md hover:bg-blue-50 focus:ring-2 focus:ring-blue-500 transition-colors">
                                View
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-center">
                            <i
                                class="fas fa-toggle-{{ $tableOfContent->status ? 'on' : 'off' }} {{ $tableOfContent->status ? 'text-green-500' : 'text-gray-400' }} mr-3"></i>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">Status:
                                    {{ $tableOfContent->status ? 'Active' : 'Inactive' }}</h4>
                                <p class="text-xs text-gray-500">Toggle item status</p>
                            </div>
                        </div>
                        <div>
                            <button
                                class="inline-flex items-center px-3 py-2 border {{ $tableOfContent->status ? 'border-yellow-300 text-yellow-600 hover:bg-yellow-50' : 'border-green-300 text-green-600 hover:bg-green-50' }} text-sm rounded-md focus:ring-2 focus:ring-{{ $tableOfContent->status ? 'yellow' : 'green' }}-500 transition-colors"
                                onclick="toggleStatus()">
                                {{ $tableOfContent->status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-list text-blue-500 mr-3"></i>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">All Items</h4>
                                    <p class="text-xs text-gray-500">Manage all table of contents items</p>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('admin.publications.table-of-contents.index', $publication) }}"
                                    class="inline-flex items-center px-3 py-2 border border-blue-300 text-blue-600 text-sm rounded-md hover:bg-blue-50 focus:ring-2 focus:ring-blue-500 transition-colors">
                                    View All
                                </a>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-trash text-red-500 mr-3"></i>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Delete Item</h4>
                                    <p class="text-xs text-gray-500">Permanently remove this item</p>
                                </div>
                            </div>
                            <div>
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-red-300 text-red-600 text-sm rounded-md hover:bg-red-50 focus:ring-2 focus:ring-red-500 transition-colors"
                                    onclick="confirmDelete()">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="fixed inset-0 z-50 hidden" id="deleteModal">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="hideDeleteModal()"></div>
            <div class="relative bg-white rounded-lg max-w-md w-full shadow-xl">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Confirm Delete</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-600" onclick="hideDeleteModal()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <p class="text-sm text-gray-700 mb-2">Are you sure you want to delete
                        "<strong>{{ $tableOfContent->title }}</strong>"?</p>
                    <p class="text-sm text-red-600">This action cannot be undone.</p>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 transition-colors"
                        onclick="hideDeleteModal()">Cancel</button>
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:ring-2 focus:ring-red-500 transition-colors"
                        onclick="deleteItem()">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize CKEditor for the description field
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ 'https://lawinpartners.joomni.com/admin/upload_editor_image?_token=' . csrf_token() }}",
            filebrowserUploadMethod: 'form',
            height: 300
        });

        function toggleStatus() {
            $.ajax({
                url: '{{ route('admin.publications.table-of-contents.toggle-status', [$publication, $tableOfContent]) }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        // Reload page to reflect changes
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    showAlert('error', response.message || 'Error updating status');
                }
            });
        }

        function confirmDelete() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function deleteItem() {
            $.ajax({
                url: '{{ route('admin.publications.table-of-contents.destroy', [$publication, $tableOfContent]) }}',
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        // Redirect to index after successful deletion
                        setTimeout(function() {
                            window.location.href =
                                '{{ route('admin.publications.table-of-contents.index', $publication) }}';
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    showAlert('error', response.message || 'Error deleting item');
                }
            });
            hideDeleteModal();
        }

        function showAlert(type, message) {
            const alertType = type === 'success' ? 'bg-green-50 border-green-200 text-green-800' :
                'bg-red-50 border-red-200 text-red-800';
            const iconColor = type === 'success' ? 'text-green-400' : 'text-red-400';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

            const alertHtml = `
        <div class="${alertType} border rounded-md p-4 mb-4 alert-notification">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas ${icon} ${iconColor}"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">${message}</p>
                </div>
                <div class="ml-auto pl-3">
                    <button type="button" class="${iconColor.replace('text-', 'text-').replace('-400', '-600')} hover:${iconColor.replace('-400', '-800')}" onclick="this.closest('.alert-notification').remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    `;

            const container = document.querySelector('.max-w-7xl');
            container.insertAdjacentHTML('afterbegin', alertHtml);

            // Auto dismiss after 5 seconds
            setTimeout(function() {
                const notification = container.querySelector('.alert-notification');
                if (notification) {
                    notification.remove();
                }
            }, 5000);
        }
    </script>
@endpush
