@extends('layouts.admin')

@section('title', 'Edit Table of Contents Item - ' . $publication->title)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Table of Contents Item</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.index') }}">Publications</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.show', $publication) }}">{{ Str::limit($publication->title, 30) }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.table-of-contents.index', $publication) }}">Table of Contents</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.publications.table-of-contents.index', $publication) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
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
                        Editing table of contents item
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

    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Edit Table of Contents Item</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.publications.table-of-contents.update', [$publication, $tableOfContent]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $tableOfContent->title) }}" 
                                   placeholder="Enter title"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status">
                                <option value="1" {{ old('status', $tableOfContent->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $tableOfContent->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="5" 
                              placeholder="Enter description (optional)">{{ old('description', $tableOfContent->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Current Order Information -->
                <div class="form-group">
                    <label class="form-label">Current Order</label>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        This item is currently at position <strong>{{ $tableOfContent->order_index }}</strong> in the table of contents.
                        To change the order, go back to the list and use drag & drop functionality.
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                <i class="fas fa-clock"></i>
                                Last updated: {{ $tableOfContent->updated_at->format('M d, Y \a\t g:i A') }}
                            </small>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Item
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Item Actions Card -->
    <div class="card mt-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-eye text-info mr-3"></i>
                        <div>
                            <h6 class="mb-1">View Item</h6>
                            <p class="text-muted small mb-0">View this table of contents item details</p>
                        </div>
                        <div class="ml-auto">
                            <a href="{{ route('admin.publications.table-of-contents.show', [$publication, $tableOfContent]) }}" 
                               class="btn btn-sm btn-outline-info">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-toggle-{{ $tableOfContent->status ? 'on' : 'off' }} text-{{ $tableOfContent->status ? 'success' : 'secondary' }} mr-3"></i>
                        <div>
                            <h6 class="mb-1">Status: {{ $tableOfContent->status_label }}</h6>
                            <p class="text-muted small mb-0">Toggle item status</p>
                        </div>
                        <div class="ml-auto">
                            <button class="btn btn-sm btn-outline-{{ $tableOfContent->status ? 'warning' : 'success' }}" 
                                    onclick="toggleStatus()">
                                {{ $tableOfContent->status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-list text-primary mr-3"></i>
                        <div>
                            <h6 class="mb-1">All Items</h6>
                            <p class="text-muted small mb-0">Manage all table of contents items</p>
                        </div>
                        <div class="ml-auto">
                            <a href="{{ route('admin.publications.table-of-contents.index', $publication) }}" 
                               class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-trash text-danger mr-3"></i>
                        <div>
                            <h6 class="mb-1">Delete Item</h6>
                            <p class="text-muted small mb-0">Permanently remove this item</p>
                        </div>
                        <div class="ml-auto">
                            <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete()">
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
                <p>Are you sure you want to delete "<strong>{{ $tableOfContent->title }}</strong>"?</p>
                <p class="text-danger small">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="deleteItem()">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleStatus() {
    $.ajax({
        url: '{{ route("admin.publications.table-of-contents.toggle-status", [$publication, $tableOfContent]) }}',
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
    $('#deleteModal').modal('show');
}

function deleteItem() {
    $.ajax({
        url: '{{ route("admin.publications.table-of-contents.destroy", [$publication, $tableOfContent]) }}',
        method: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                showAlert('success', response.message);
                // Redirect to index after successful deletion
                setTimeout(function() {
                    window.location.href = '{{ route("admin.publications.table-of-contents.index", $publication) }}';
                }, 1000);
            }
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            showAlert('error', response.message || 'Error deleting item');
        }
    });
    $('#deleteModal').modal('hide');
}

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
</script>
@endsection
