@extends('layouts.admin')

@section('title', 'Table of Contents - ' . $publication->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Table of Contents</h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <i class="fas fa-home mr-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                            <a href="{{ route('admin.publications.index') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Publications</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                            <a href="{{ route('admin.publications.show', $publication) }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">{{ Str::limit($publication->title, 30) }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                            <span class="text-sm font-medium text-gray-500">Table of Contents</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.publications.table-of-contents.create', $publication) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 transition-colors">
                <i class="fas fa-plus"></i>
                <span>Add Table of Contents</span>
            </a>
            <a href="{{ route('admin.publications.show', $publication) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 transition-colors">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Publication</span>
            </a>
        </div>
    </div>

    <!-- Publication Info Card -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $publication->title }}</h2>
                <p class="text-sm text-gray-600">
                    Total TOC Items: {{ $publication->tableOfContentsCount() }} | 
                    Active Items: {{ $publication->activeTableOfContentsCount() }}
                </p>
            </div>
            <div class="flex-shrink-0">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $publication->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ ucfirst($publication->status) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Table of Contents List -->
    <div class="bg-white shadow rounded-lg">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-blue-600">Table of Contents Items</h3>
            <div>
                <button class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-red-600 text-white text-sm hover:bg-red-700 focus:ring-2 focus:ring-red-500 transition-colors hidden" id="bulkDeleteBtn">
                    <i class="fas fa-trash"></i>
                    <span>Delete Selected</span>
                </button>
            </div>
        </div>

        <div class="p-6">
            @if($tableOfContents->count() > 0)
                <!-- Drag and Drop Notice -->
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6 relative" id="dragDropNotice">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <strong>Tip:</strong> Drag and drop items to reorder them. Changes are saved automatically.
                            </p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button type="button" class="text-blue-400 hover:text-blue-600" onclick="closeDragNotice()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table of Contents Items -->
                <div id="tocItemsList" class="space-y-4">
                    @foreach($tableOfContents as $item)
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm toc-item" data-id="{{ $item->id }}">
                        <div class="flex items-center gap-4">
                            <!-- Checkbox -->
                            <div class="flex-shrink-0">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 item-checkbox" id="check{{ $item->id }}" value="{{ $item->id }}">
                            </div>
                            
                            <!-- Drag Handle -->
                            <div class="flex-shrink-0">
                                <i class="fas fa-grip-vertical text-gray-400 cursor-move drag-handle"></i>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1">
                                <h4 class="text-base font-medium text-gray-900 mb-1">{{ $item->title }}</h4>
                                @if($item->description)
                                    <p class="text-sm text-gray-600 mb-1">{{ Str::limit($item->description, 100) }}</p>
                                @endif
                                <span class="text-xs text-gray-500">Order: {{ $item->order_index }}</span>
                            </div>
                            
                            <!-- Status Badge -->
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $item->status ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $item->status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            
                            <!-- Actions Dropdown -->
                            <div class="relative flex-shrink-0">
                                <button type="button" class="inline-flex items-center gap-1 px-3 py-1 text-xs border border-blue-300 text-blue-600 rounded-md hover:bg-blue-50 focus:ring-2 focus:ring-blue-500 dropdown-toggle" data-dropdown-id="dropdown{{ $item->id }}">
                                    Actions
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                <div class="absolute right-0 z-10 mt-1 w-48 bg-white rounded-md shadow-lg border border-gray-200 hidden" id="dropdown{{ $item->id }}">
                                    <div class="py-1">
                                        <a href="{{ route('admin.publications.table-of-contents.show', [$publication, $item]) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                            <i class="fas fa-eye text-gray-400"></i>
                                            <span>View</span>
                                        </a>
                                        <a href="{{ route('admin.publications.table-of-contents.edit', [$publication, $item]) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                            <i class="fas fa-edit text-gray-400"></i>
                                            <span>Edit</span>
                                        </a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 toggle-status" data-id="{{ $item->id }}">
                                            <i class="fas fa-toggle-{{ $item->status ? 'off' : 'on' }} text-gray-400"></i>
                                            <span>{{ $item->status ? 'Deactivate' : 'Activate' }}</span>
                                        </a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-red-700 hover:bg-red-50 delete-item" data-id="{{ $item->id }}" data-title="{{ $item->title }}">
                                            <i class="fas fa-trash text-red-400"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-6">
                    {{ $tableOfContents->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <i class="fas fa-list-ol text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Table of Contents Items</h3>
                    <p class="text-gray-600 mb-6">Get started by adding your first table of contents item.</p>
                    <a href="{{ route('admin.publications.table-of-contents.create', $publication) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 transition-colors">
                        <i class="fas fa-plus"></i>
                        <span>Add Table of Contents</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="deleteModal">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeModal('deleteModal')"></div>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Confirm Delete</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Are you sure you want to delete "<span id="deleteItemTitle" class="font-medium"></span>"?</p>
                            <p class="text-sm text-red-600 mt-1">This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" id="confirmDelete">
                    Delete
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal('deleteModal')">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Delete Modal -->
<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="bulkDeleteModal">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeModal('bulkDeleteModal')"></div>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Confirm Bulk Delete</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Are you sure you want to delete <span id="bulkDeleteCount" class="font-medium"></span> selected item(s)?</p>
                            <p class="text-sm text-red-600 mt-1">This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" id="confirmBulkDelete">
                    Delete Selected
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal('bulkDeleteModal')">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let deleteItemId = null;
    
    // Initialize Sortable for drag and drop reordering
    @if($tableOfContents->count() > 0)
    const sortable = Sortable.create(document.getElementById('tocItemsList'), {
        handle: '.drag-handle',
        animation: 150,
        onEnd: function(evt) {
            const itemIds = Array.from(document.querySelectorAll('.toc-item')).map(item => item.getAttribute('data-id'));
            
            // Send reorder request
            fetch('{{ route("admin.publications.table-of-contents.reorder", $publication) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    items: itemIds
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                }
            })
            .catch(error => {
                showAlert('error', 'Error reordering items');
                // Revert the change
                evt.item.parentNode.insertBefore(evt.item, evt.item.parentNode.children[evt.oldIndex]);
            });
        }
    });
    @endif
    
    // Handle checkbox selection
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('item-checkbox')) {
            const checkedCount = document.querySelectorAll('.item-checkbox:checked').length;
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            
            if (checkedCount > 0) {
                bulkDeleteBtn.classList.remove('hidden');
            } else {
                bulkDeleteBtn.classList.add('hidden');
            }
        }
    });
    
    // Handle dropdown toggles
    document.addEventListener('click', function(e) {
        if (e.target.closest('.dropdown-toggle')) {
            e.preventDefault();
            const button = e.target.closest('.dropdown-toggle');
            const dropdownId = button.getAttribute('data-dropdown-id');
            const dropdown = document.getElementById(dropdownId);
            
            // Close all other dropdowns
            document.querySelectorAll('[id^="dropdown"]').forEach(dd => {
                if (dd.id !== dropdownId) {
                    dd.classList.add('hidden');
                }
            });
            
            // Toggle this dropdown
            dropdown.classList.toggle('hidden');
        }
        
        // Close dropdowns when clicking outside
        if (!e.target.closest('.dropdown-toggle') && !e.target.closest('[id^="dropdown"]')) {
            document.querySelectorAll('[id^="dropdown"]').forEach(dd => {
                dd.classList.add('hidden');
            });
        }
    });
    
    // Handle individual delete
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-item')) {
            e.preventDefault();
            const deleteLink = e.target.closest('.delete-item');
            deleteItemId = deleteLink.getAttribute('data-id');
            document.getElementById('deleteItemTitle').textContent = deleteLink.getAttribute('data-title');
            showModal('deleteModal');
        }
    });
    
    // Confirm individual delete
    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (deleteItemId) {
            fetch('{{ route("admin.publications.table-of-contents.destroy", [$publication, "__ID__"]) }}'.replace('__ID__', deleteItemId), {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    const itemElement = document.querySelector('.toc-item[data-id="' + deleteItemId + '"]');
                    if (itemElement) {
                        itemElement.style.transition = 'opacity 0.3s';
                        itemElement.style.opacity = '0';
                        setTimeout(() => itemElement.remove(), 300);
                    }
                }
            })
            .catch(error => {
                showAlert('error', 'Error deleting item');
            });
        }
        closeModal('deleteModal');
    });
    
    // Handle bulk delete
    document.getElementById('bulkDeleteBtn').addEventListener('click', function() {
        const checkedCount = document.querySelectorAll('.item-checkbox:checked').length;
        document.getElementById('bulkDeleteCount').textContent = checkedCount;
        showModal('bulkDeleteModal');
    });
    
    // Confirm bulk delete
    document.getElementById('confirmBulkDelete').addEventListener('click', function() {
        const selectedIds = Array.from(document.querySelectorAll('.item-checkbox:checked')).map(cb => cb.value);
        
        fetch('{{ route("admin.publications.table-of-contents.bulk-delete", $publication) }}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                ids: selectedIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                selectedIds.forEach(function(id) {
                    const itemElement = document.querySelector('.toc-item[data-id="' + id + '"]');
                    if (itemElement) {
                        itemElement.style.transition = 'opacity 0.3s';
                        itemElement.style.opacity = '0';
                        setTimeout(() => itemElement.remove(), 300);
                    }
                });
                document.getElementById('bulkDeleteBtn').classList.add('hidden');
            }
        })
        .catch(error => {
            showAlert('error', 'Error deleting items');
        });
        
        closeModal('bulkDeleteModal');
    });
    
    // Handle status toggle
    document.addEventListener('click', function(e) {
        if (e.target.closest('.toggle-status')) {
            e.preventDefault();
            const toggleLink = e.target.closest('.toggle-status');
            const itemId = toggleLink.getAttribute('data-id');
            const badgeElement = document.querySelector('.toc-item[data-id="' + itemId + '"] span[class*="bg-green-100"], .toc-item[data-id="' + itemId + '"] span[class*="bg-gray-100"]');
            
            fetch('{{ route("admin.publications.table-of-contents.toggle-status", [$publication, "__ID__"]) }}'.replace('__ID__', itemId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    
                    // Update badge
                    if (badgeElement) {
                        badgeElement.className = badgeElement.className.replace(/bg-(green|gray)-100 text-(green|gray)-800/, '');
                        const newClasses = data.status ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
                        badgeElement.className += ' ' + newClasses;
                        badgeElement.textContent = data.status ? 'Active' : 'Inactive';
                    }
                    
                    // Update action link
                    const iconClass = data.status ? 'fa-toggle-off' : 'fa-toggle-on';
                    const linkText = data.status ? 'Deactivate' : 'Activate';
                    toggleLink.innerHTML = `<i class="fas ${iconClass} text-gray-400"></i><span>${linkText}</span>`;
                }
            })
            .catch(error => {
                showAlert('error', 'Error updating status');
            });
        }
    });
    
    // Modal functions
    window.showModal = function(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    };
    
    window.closeModal = function(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    };
    
    // Close drag notice
    window.closeDragNotice = function() {
        document.getElementById('dragDropNotice').remove();
    };
    
    // Alert function
    function showAlert(type, message) {
        const alertType = type === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800';
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
});
</script>
@endpush
