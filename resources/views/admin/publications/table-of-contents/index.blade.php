@extends('layouts.admin')

@section('title', 'Table of Contents - ' . $publication->title)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Table of Contents</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.index') }}">Publications</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.show', $publication) }}">{{ Str::limit($publication->title, 30) }}</a></li>
                    <li class="breadcrumb-item active">Table of Contents</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.publications.table-of-contents.create', $publication) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Table of Contents
            </a>
            <a href="{{ route('admin.publications.show', $publication) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Publication
            </a>
        </div>
    </div>

    <!-- Publication Info Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="card-title mb-1">{{ $publication->title }}</h5>
                    <p class="text-muted small mb-0">
                        Total TOC Items: {{ $publication->tableOfContentsCount() }} | 
                        Active Items: {{ $publication->activeTableOfContentsCount() }}
                    </p>
                </div>
                <div class="col-md-4 text-md-right">
                    <span class="badge badge-{{ $publication->status === 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($publication->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Table of Contents List -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Table of Contents Items</h6>
            <div>
                <button class="btn btn-sm btn-danger" id="bulkDeleteBtn" style="display: none;">
                    <i class="fas fa-trash"></i> Delete Selected
                </button>
            </div>
        </div>

        <div class="card-body">
            @if($tableOfContents->count() > 0)
                <!-- Drag and Drop Notice -->
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i>
                    <strong>Tip:</strong> Drag and drop items to reorder them. Changes are saved automatically.
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>

                <!-- Table of Contents Items -->
                <div id="tocItemsList">
                    @foreach($tableOfContents as $item)
                    <div class="card mb-3 toc-item" data-id="{{ $item->id }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-1 text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input item-checkbox" id="check{{ $item->id }}" value="{{ $item->id }}">
                                        <label class="custom-control-label" for="check{{ $item->id }}"></label>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <i class="fas fa-grip-vertical text-muted drag-handle" style="cursor: move;"></i>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="card-title mb-1">{{ $item->title }}</h6>
                                    @if($item->description)
                                        <p class="text-muted small mb-0">{{ Str::limit($item->description, 100) }}</p>
                                    @endif
                                    <small class="text-muted">Order: {{ $item->order_index }}</small>
                                </div>
                                <div class="col-md-2 text-center">
                                    <span class="badge badge-{{ $item->status_badge_class }}">
                                        {{ $item->status_label }}
                                    </span>
                                </div>
                                <div class="col-md-2 text-right">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.publications.table-of-contents.show', [$publication, $item]) }}">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.publications.table-of-contents.edit', [$publication, $item]) }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item toggle-status" href="#" data-id="{{ $item->id }}">
                                                <i class="fas fa-toggle-{{ $item->status ? 'off' : 'on' }}"></i> 
                                                {{ $item->status ? 'Deactivate' : 'Activate' }}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger delete-item" href="#" data-id="{{ $item->id }}" data-title="{{ $item->title }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $tableOfContents->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <i class="fas fa-list-ol fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Table of Contents Items</h5>
                    <p class="text-muted">Get started by adding your first table of contents item.</p>
                    <a href="{{ route('admin.publications.table-of-contents.create', $publication) }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Table of Contents
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete "<span id="deleteItemTitle"></span>"?</p>
                <p class="text-danger small">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Delete Modal -->
<div class="modal fade" id="bulkDeleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Bulk Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span id="bulkDeleteCount"></span> selected item(s)?</p>
                <p class="text-danger small">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmBulkDelete">Delete Selected</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
$(document).ready(function() {
    let deleteItemId = null;
    
    // Initialize Sortable for drag and drop reordering
    @if($tableOfContents->count() > 0)
    const sortable = Sortable.create(document.getElementById('tocItemsList'), {
        handle: '.drag-handle',
        animation: 150,
        onEnd: function(evt) {
            const itemIds = Array.from(document.querySelectorAll('.toc-item')).map(item => item.getAttribute('data-id'));
            
            // Send reorder request
            $.ajax({
                url: '{{ route("admin.publications.table-of-contents.reorder", $publication) }}',
                method: 'POST',
                data: {
                    items: itemIds,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                    }
                },
                error: function(xhr) {
                    showAlert('error', 'Error reordering items');
                    // Revert the change
                    evt.item.parentNode.insertBefore(evt.item, evt.item.parentNode.children[evt.oldIndex]);
                }
            });
        }
    });
    @endif
    
    // Handle checkbox selection
    $('.item-checkbox').change(function() {
        const checkedCount = $('.item-checkbox:checked').length;
        if (checkedCount > 0) {
            $('#bulkDeleteBtn').show();
        } else {
            $('#bulkDeleteBtn').hide();
        }
    });
    
    // Handle individual delete
    $('.delete-item').click(function(e) {
        e.preventDefault();
        deleteItemId = $(this).data('id');
        $('#deleteItemTitle').text($(this).data('title'));
        $('#deleteModal').modal('show');
    });
    
    // Confirm individual delete
    $('#confirmDelete').click(function() {
        if (deleteItemId) {
            $.ajax({
                url: '{{ route("admin.publications.table-of-contents.destroy", [$publication, "__ID__"]) }}'.replace('__ID__', deleteItemId),
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        $('.toc-item[data-id="' + deleteItemId + '"]').fadeOut(300, function() {
                            $(this).remove();
                        });
                    }
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    showAlert('error', response.message || 'Error deleting item');
                }
            });
        }
        $('#deleteModal').modal('hide');
    });
    
    // Handle bulk delete
    $('#bulkDeleteBtn').click(function() {
        const checkedCount = $('.item-checkbox:checked').length;
        $('#bulkDeleteCount').text(checkedCount);
        $('#bulkDeleteModal').modal('show');
    });
    
    // Confirm bulk delete
    $('#confirmBulkDelete').click(function() {
        const selectedIds = $('.item-checkbox:checked').map(function() {
            return $(this).val();
        }).get();
        
        $.ajax({
            url: '{{ route("admin.publications.table-of-contents.bulk-delete", $publication) }}',
            method: 'DELETE',
            data: {
                ids: selectedIds,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    selectedIds.forEach(function(id) {
                        $('.toc-item[data-id="' + id + '"]').fadeOut(300, function() {
                            $(this).remove();
                        });
                    });
                    $('#bulkDeleteBtn').hide();
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                showAlert('error', response.message || 'Error deleting items');
            }
        });
        
        $('#bulkDeleteModal').modal('hide');
    });
    
    // Handle status toggle
    $('.toggle-status').click(function(e) {
        e.preventDefault();
        const itemId = $(this).data('id');
        const $badge = $('.toc-item[data-id="' + itemId + '"] .badge');
        
        $.ajax({
            url: '{{ route("admin.publications.table-of-contents.toggle-status", [$publication, "__ID__"]) }}'.replace('__ID__', itemId),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    
                    // Update badge
                    $badge.removeClass('badge-success badge-secondary')
                          .addClass(response.status ? 'badge-success' : 'badge-secondary')
                          .text(response.status ? 'Active' : 'Inactive');
                    
                    // Update action link
                    const $link = $('.toc-item[data-id="' + itemId + '"] .toggle-status');
                    $link.html('<i class="fas fa-toggle-' + (response.status ? 'off' : 'on') + '"></i> ' + 
                              (response.status ? 'Deactivate' : 'Activate'));
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                showAlert('error', response.message || 'Error updating status');
            }
        });
    });
    
    // Alert function
    function showAlert(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        `;
        
        $('.container-fluid').prepend(alertHtml);
        
        // Auto dismiss after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    }
});
</script>
@endsection
