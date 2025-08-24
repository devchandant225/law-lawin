@extends('layouts.admin')

@section('title', 'View Table of Contents Item - ' . $publication->title)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Table of Contents Item</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.index') }}">Publications</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.show', $publication) }}">{{ Str::limit($publication->title, 30) }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.table-of-contents.index', $publication) }}">Table of Contents</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.publications.table-of-contents.edit', [$publication, $tableOfContent]) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Item
            </a>
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
                        Viewing table of contents item
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

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Item Details Card -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Item Details</h6>
                    <span class="badge badge-{{ $tableOfContent->status_badge_class }} badge-pill">
                        {{ $tableOfContent->status_label }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary">{{ $tableOfContent->title }}</h5>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <small class="text-muted">
                                <i class="fas fa-sort-numeric-up"></i>
                                Order Position: <strong>{{ $tableOfContent->order_index }}</strong>
                            </small>
                        </div>
                    </div>
                    
                    @if($tableOfContent->description)
                        <div class="mt-3">
                            <h6 class="text-secondary">Description</h6>
                            <div class="border-left border-primary pl-3">
                                <p class="mb-0">{{ $tableOfContent->description }}</p>
                            </div>
                        </div>
                    @else
                        <div class="mt-3">
                            <div class="alert alert-light" role="alert">
                                <i class="fas fa-info-circle"></i>
                                No description provided for this item.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.publications.table-of-contents.edit', [$publication, $tableOfContent]) }}" 
                           class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit Item
                        </a>
                        <button class="btn btn-{{ $tableOfContent->status ? 'warning' : 'success' }} btn-sm" 
                                onclick="toggleStatus()">
                            <i class="fas fa-toggle-{{ $tableOfContent->status ? 'off' : 'on' }}"></i>
                            {{ $tableOfContent->status ? 'Deactivate' : 'Activate' }}
                        </button>
                        <a href="{{ route('admin.publications.table-of-contents.index', $publication) }}" 
                           class="btn btn-info btn-sm">
                            <i class="fas fa-list"></i> All Items
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete()">
                            <i class="fas fa-trash"></i> Delete Item
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item Information Card -->
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Item Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted d-block">Status</small>
                            <span class="badge badge-{{ $tableOfContent->status_badge_class }}">
                                {{ $tableOfContent->status_label }}
                            </span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Order Position</small>
                            <strong>{{ $tableOfContent->order_index }}</strong>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-12">
                            <small class="text-muted d-block">Created</small>
                            <span>{{ $tableOfContent->created_at->format('M d, Y \a\t g:i A') }}</span>
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-12">
                            <small class="text-muted d-block">Last Updated</small>
                            <span>{{ $tableOfContent->updated_at->format('M d, Y \a\t g:i A') }}</span>
                        </div>
                    </div>

                    @if($tableOfContent->description)
                        <div class="row mt-2">
                            <div class="col-12">
                                <small class="text-muted d-block">Description Length</small>
                                <span>{{ strlen($tableOfContent->description) }} characters</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Navigation Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Navigation</h6>
                </div>
                <div class="card-body">
                    @php
                        $prevItem = $publication->tableOfContents()
                            ->where('order_index', '<', $tableOfContent->order_index)
                            ->orderBy('order_index', 'desc')
                            ->first();
                        $nextItem = $publication->tableOfContents()
                            ->where('order_index', '>', $tableOfContent->order_index)
                            ->orderBy('order_index', 'asc')
                            ->first();
                    @endphp

                    @if($prevItem)
                        <div class="mb-2">
                            <small class="text-muted d-block">Previous Item</small>
                            <a href="{{ route('admin.publications.table-of-contents.show', [$publication, $prevItem]) }}" 
                               class="text-decoration-none">
                                <i class="fas fa-arrow-left"></i> {{ Str::limit($prevItem->title, 30) }}
                            </a>
                        </div>
                    @endif

                    @if($nextItem)
                        <div class="mb-2">
                            <small class="text-muted d-block">Next Item</small>
                            <a href="{{ route('admin.publications.table-of-contents.show', [$publication, $nextItem]) }}" 
                               class="text-decoration-none">
                                {{ Str::limit($nextItem->title, 30) }} <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif

                    @if(!$prevItem && !$nextItem)
                        <div class="text-muted text-center">
                            <i class="fas fa-info-circle"></i>
                            This is the only item
                        </div>
                    @endif
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
