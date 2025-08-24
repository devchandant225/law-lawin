@extends('layouts.admin')

@section('title', 'Add Table of Contents - ' . $publication->title)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Add Table of Contents</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.index') }}">Publications</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.show', $publication) }}">{{ Str::limit($publication->title, 30) }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.publications.table-of-contents.index', $publication) }}">Table of Contents</a></li>
                    <li class="breadcrumb-item active">Add</li>
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
                        Adding table of contents items for this publication
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
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Table of Contents Items</h6>
            <div>
                <button type="button" class="btn btn-sm btn-success" id="addMoreBtn">
                    <i class="fas fa-plus"></i> Add More
                </button>
            </div>
        </div>

        <div class="card-body">
            <form id="tocForm" action="{{ route('admin.publications.table-of-contents.store', $publication) }}" method="POST">
                @csrf

                <!-- Instructions -->
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i>
                    <strong>Instructions:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Add multiple table of contents items at once</li>
                        <li>Title is required for each item</li>
                        <li>Description is optional but recommended</li>
                        <li>Use the "Add More" button to add additional items</li>
                        <li>Remove unwanted items using the trash button</li>
                    </ul>
                </div>

                <!-- Dynamic Form Fields Container -->
                <div id="tocItemsContainer">
                    <!-- Initial Item -->
                    <div class="toc-item-group card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Item #<span class="item-number">1</span></h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-item" style="display: none;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="toc_items_0_title">Title <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('toc_items.0.title') is-invalid @enderror" 
                                               id="toc_items_0_title" 
                                               name="toc_items[0][title]" 
                                               value="{{ old('toc_items.0.title') }}" 
                                               placeholder="Enter title"
                                               required>
                                        @error('toc_items.0.title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="toc_items_0_status">Status</label>
                                        <select class="form-control @error('toc_items.0.status') is-invalid @enderror" 
                                                id="toc_items_0_status" 
                                                name="toc_items[0][status]">
                                            <option value="1" {{ old('toc_items.0.status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('toc_items.0.status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('toc_items.0.status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="toc_items_0_description">Description</label>
                                        <textarea class="form-control @error('toc_items.0.description') is-invalid @enderror" 
                                                  id="toc_items_0_description" 
                                                  name="toc_items[0][description]" 
                                                  rows="3" 
                                                  placeholder="Enter description (optional)">{{ old('toc_items.0.description') }}</textarea>
                                        @error('toc_items.0.description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i>
                                Items will be ordered automatically based on the sequence added.
                            </small>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Table of Contents
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    let itemCounter = 1;

    // Add More Button Click
    $('#addMoreBtn').click(function() {
        addNewItem();
    });

    // Remove Item Button Click (using event delegation)
    $(document).on('click', '.remove-item', function() {
        const $itemGroup = $(this).closest('.toc-item-group');
        $itemGroup.fadeOut(300, function() {
            $(this).remove();
            updateItemNumbers();
            updateRemoveButtonsVisibility();
        });
    });

    // Form Validation
    $('#tocForm').submit(function(e) {
        let isValid = true;
        let emptyCount = 0;

        // Clear previous error states
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        // Validate each item
        $('.toc-item-group').each(function(index) {
            const $item = $(this);
            const $titleInput = $item.find('input[name*="[title]"]');
            const $descriptionInput = $item.find('textarea[name*="[description]"]');
            
            const title = $titleInput.val().trim();
            const description = $descriptionInput.val().trim();

            // Check if item is completely empty
            if (!title && !description) {
                emptyCount++;
                return; // Skip validation for empty items
            }

            // Validate title if item has any content
            if (!title) {
                $titleInput.addClass('is-invalid');
                $titleInput.after('<div class="invalid-feedback">Title is required when description is provided.</div>');
                isValid = false;
            }

            // Validate title length
            if (title && title.length > 255) {
                $titleInput.addClass('is-invalid');
                $titleInput.after('<div class="invalid-feedback">Title cannot exceed 255 characters.</div>');
                isValid = false;
            }
        });

        // Check if all items are empty
        const totalItems = $('.toc-item-group').length;
        if (emptyCount === totalItems) {
            showAlert('error', 'Please add at least one table of contents item with a title.');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $('.is-invalid:first').offset().top - 100
            }, 500);
        }
    });

    function addNewItem() {
        const itemHtml = `
            <div class="toc-item-group card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Item #<span class="item-number">${itemCounter + 1}</span></h6>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-item">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="toc_items_${itemCounter}_title">Title <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control" 
                                       id="toc_items_${itemCounter}_title" 
                                       name="toc_items[${itemCounter}][title]" 
                                       placeholder="Enter title"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="toc_items_${itemCounter}_status">Status</label>
                                <select class="form-control" 
                                        id="toc_items_${itemCounter}_status" 
                                        name="toc_items[${itemCounter}][status]">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="toc_items_${itemCounter}_description">Description</label>
                                <textarea class="form-control" 
                                          id="toc_items_${itemCounter}_description" 
                                          name="toc_items[${itemCounter}][description]" 
                                          rows="3" 
                                          placeholder="Enter description (optional)"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        $('#tocItemsContainer').append(itemHtml);
        itemCounter++;
        
        updateItemNumbers();
        updateRemoveButtonsVisibility();

        // Scroll to new item
        const $newItem = $('.toc-item-group').last();
        $('html, body').animate({
            scrollTop: $newItem.offset().top - 100
        }, 500);

        // Focus on title field
        $newItem.find('input[name*="[title]"]').focus();
    }

    function updateItemNumbers() {
        $('.toc-item-group').each(function(index) {
            $(this).find('.item-number').text(index + 1);
        });
    }

    function updateRemoveButtonsVisibility() {
        const itemCount = $('.toc-item-group').length;
        if (itemCount > 1) {
            $('.remove-item').show();
        } else {
            $('.remove-item').hide();
        }
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

    // Handle old input repopulation for validation errors
    @if(old('toc_items'))
        @foreach(old('toc_items', []) as $index => $item)
            @if($index > 0)
                // Add items for old input beyond the first one
                setTimeout(function() {
                    addNewItem();
                    
                    // Set the values
                    const $lastItem = $('.toc-item-group').last();
                    $lastItem.find('input[name*="[title]"]').val('{{ $item['title'] ?? '' }}');
                    $lastItem.find('textarea[name*="[description]"]').val('{{ $item['description'] ?? '' }}');
                    $lastItem.find('select[name*="[status]"]').val('{{ $item['status'] ?? 1 }}');
                }, 100 * {{ $index }});
            @endif
        @endforeach
    @endif
});
</script>
@endsection
