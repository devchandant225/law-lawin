@extends('layouts.admin')

@section('title', 'Add Table of Contents - ' . $publication->title)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Add Table of Contents</h1>
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
                                <span class="text-sm font-medium text-gray-500">Add</span>
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
                        Adding table of contents items for this publication
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
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-blue-600">Table of Contents Items</h3>
                <div>
                    <button type="button"
                        class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-green-600 text-white text-sm hover:bg-green-700 focus:ring-2 focus:ring-green-500 transition-colors"
                        id="addMoreBtn">
                        <i class="fas fa-plus"></i>
                        <span>Add More</span>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <form id="tocForm" action="{{ route('admin.publications.table-of-contents.store', $publication) }}"
                    method="POST">
                    @csrf

                    <!-- Instructions -->
                    <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-400"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-blue-800">Instructions:</h4>
                                <ul class="mt-2 text-sm text-blue-700 list-disc list-inside space-y-1">
                                    <li>Add multiple table of contents items at once</li>
                                    <li>Title is required for each item</li>
                                    <li>Description is optional but recommended</li>
                                    <li>Use the "Add More" button to add items at the end</li>
                                    <li>Use the "Add Below" button to insert items at specific positions</li>
                                    <li>Remove unwanted items using the trash button</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Form Fields Container -->
                    <div id="tocItemsContainer" class="space-y-6">
                        <!-- Initial Item -->
                        <div class="toc-item-group bg-gray-50 border border-gray-200 rounded-lg">
                            <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200">
                                <h4 class="text-sm font-medium text-gray-900">Item #<span class="item-number">1</span></h4>
                                <div class="flex gap-2">
                                    <button type="button"
                                        class="inline-flex items-center gap-1 px-2 py-1 text-xs border border-green-300 text-green-600 rounded hover:bg-green-50 focus:ring-2 focus:ring-green-500 transition-colors add-item-below">
                                        <i class="fas fa-plus"></i>
                                        <span>Add Below</span>
                                    </button>
                                    <button type="button"
                                        class="inline-flex items-center gap-1 px-2 py-1 text-xs border border-red-300 text-red-600 rounded hover:bg-red-50 focus:ring-2 focus:ring-red-500 transition-colors remove-item hidden">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="toc_items_0_title" class="block text-sm font-medium text-gray-700 mb-1">
                                            Title <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('toc_items.0.title') border-red-500 @enderror"
                                            id="toc_items_0_title" name="toc_items[0][title]"
                                            value="{{ old('toc_items.0.title') }}" placeholder="Enter title" required>
                                        @error('toc_items.0.title')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="toc_items_0_status"
                                            class="block text-sm font-medium text-gray-700 mb-1">
                                            Status
                                        </label>
                                        <select
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('toc_items.0.status') border-red-500 @enderror"
                                            id="toc_items_0_status" name="toc_items[0][status]">
                                            <option value="1"
                                                {{ old('toc_items.0.status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0"
                                                {{ old('toc_items.0.status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('toc_items.0.status')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="toc_items_0_description"
                                        class="block text-sm font-medium text-gray-700 mb-1">
                                        Description
                                    </label>
                                    <textarea
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('toc_items.0.description') border-red-500 @enderror"
                                        id="toc_items_0_description" name="toc_items[0][description]" rows="3"
                                        placeholder="Enter description (optional)">{{ old('toc_items.0.description') }}</textarea>
                                    @error('toc_items.0.description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Items will be ordered automatically based on the sequence added.
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
                                    <span>Save Table of Contents</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let itemCounter = 1;
            let ckeditorInstances = {};

            // Initialize CKEditor for the initial description field
            initializeCKEditor('toc_items_0_description');

            // Add More Button Click (adds to end)
            document.getElementById('addMoreBtn').addEventListener('click', function() {
                addNewItem();
            });

            // Handle button clicks using event delegation
            document.addEventListener('click', function(e) {
                // Remove Item Button Click
                if (e.target.closest('.remove-item')) {
                    const itemGroup = e.target.closest('.toc-item-group');
                    const descriptionTextarea = itemGroup.querySelector('textarea[name*="[description]"]');

                    // Destroy CKEditor instance for this item
                    if (descriptionTextarea && ckeditorInstances[descriptionTextarea.id]) {
                        try {
                            ckeditorInstances[descriptionTextarea.id].destroy();
                            delete ckeditorInstances[descriptionTextarea.id];
                        } catch (e) {
                            console.warn('Error destroying CKEditor instance:', e);
                        }
                    }

                    itemGroup.style.transition = 'opacity 0.3s';
                    itemGroup.style.opacity = '0';
                    setTimeout(() => {
                        itemGroup.remove();
                        updateItemNumbers();
                        updateRemoveButtonsVisibility();
                        updateFormFieldNames();
                    }, 300);
                }

                // Add Item Below Button Click
                if (e.target.closest('.add-item-below')) {
                    const currentItem = e.target.closest('.toc-item-group');
                    addItemBelow(currentItem);
                }
            });

            // Form Validation
            document.getElementById('tocForm').addEventListener('submit', function(e) {
                let isValid = true;
                let emptyCount = 0;

                // Clear previous error states
                document.querySelectorAll('input, textarea, select').forEach(el => {
                    el.classList.remove('border-red-500');
                });
                document.querySelectorAll('.validation-error').forEach(el => el.remove());

                // Sync CKEditor data before validation
                for (let instanceId in ckeditorInstances) {
                    if (ckeditorInstances[instanceId]) {
                        ckeditorInstances[instanceId].updateElement();
                    }
                }

                // Validate each item
                document.querySelectorAll('.toc-item-group').forEach((item, index) => {
                    const titleInput = item.querySelector('input[name*="[title]"]');
                    const descriptionInput = item.querySelector('textarea[name*="[description]"]');

                    const title = titleInput.value.trim();
                    let description = descriptionInput.value.trim();

                    // Get CKEditor content if available
                    if (ckeditorInstances[descriptionInput.id]) {
                        description = ckeditorInstances[descriptionInput.id].getData().trim();
                    }

                    // Check if item is completely empty
                    if (!title && !description) {
                        emptyCount++;
                        return; // Skip validation for empty items
                    }

                    // Validate title if item has any content
                    if (!title) {
                        titleInput.classList.add('border-red-500');
                        const errorMsg = document.createElement('p');
                        errorMsg.className = 'mt-1 text-sm text-red-600 validation-error';
                        errorMsg.textContent = 'Title is required when description is provided.';
                        titleInput.parentNode.appendChild(errorMsg);
                        isValid = false;
                    }

                    // Validate title length
                    if (title && title.length > 255) {
                        titleInput.classList.add('border-red-500');
                        const errorMsg = document.createElement('p');
                        errorMsg.className = 'mt-1 text-sm text-red-600 validation-error';
                        errorMsg.textContent = 'Title cannot exceed 255 characters.';
                        titleInput.parentNode.appendChild(errorMsg);
                        isValid = false;
                    }
                });

                // Check if all items are empty
                const totalItems = document.querySelectorAll('.toc-item-group').length;
                if (emptyCount === totalItems) {
                    showAlert('error', 'Please add at least one table of contents item with a title.');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    const firstInvalid = document.querySelector('.border-red-500');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });

            // Initialize CKEditor for a specific textarea
            function initializeCKEditor(textareaId) {
                if (ckeditorInstances[textareaId]) {
                    try {
                        ckeditorInstances[textareaId].destroy();
                    } catch (e) {
                        console.warn('Error destroying CKEditor instance:', e);
                    }
                    delete ckeditorInstances[textareaId];
                }

                setTimeout(() => {
                    if (document.getElementById(textareaId)) {
                        ckeditorInstances[textareaId] = CKEDITOR.replace(textareaId, {
                            filebrowserUploadUrl: "{{ 'https://lawinpartners.joomni.com/admin/upload_editor_image?_token=' . csrf_token() }}",
                            filebrowserUploadMethod: 'form',
                            height: 200
                        });
                    }
                }, 100);
            }

            // Add new item at the end
            function addNewItem() {
                const itemHtml = createItemHTML(itemCounter);
                document.getElementById('tocItemsContainer').insertAdjacentHTML('beforeend', itemHtml);
                const newTextareaId = `toc_items_${itemCounter}_description`;
                itemCounter++;

                updateItemNumbers();
                updateRemoveButtonsVisibility();

                // Initialize CKEditor for the new textarea
                initializeCKEditor(newTextareaId);

                // Scroll to new item
                const items = document.querySelectorAll('.toc-item-group');
                const newItem = items[items.length - 1];
                newItem.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                // Focus on title field
                const titleInput = newItem.querySelector('input[name*="[title]"]');
                setTimeout(() => titleInput.focus(), 100);
            }

            // Add new item below a specific item
            function addItemBelow(currentItem) {
                const itemHtml = createItemHTML(itemCounter);
                const newTextareaId = `toc_items_${itemCounter}_description`;
                currentItem.insertAdjacentHTML('afterend', itemHtml);
                itemCounter++;

                updateItemNumbers();
                updateRemoveButtonsVisibility();
                updateFormFieldNames();

                // Initialize CKEditor for the new textarea
                initializeCKEditor(newTextareaId);

                // Get the newly inserted item (it's the next sibling after currentItem)
                const newItem = currentItem.nextElementSibling;
                newItem.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                // Focus on title field
                const titleInput = newItem.querySelector('input[name*="[title]"]');
                setTimeout(() => titleInput.focus(), 100);
            }

            // Create item HTML template
            function createItemHTML(counter) {
                return `
            <div class="toc-item-group bg-gray-50 border border-gray-200 rounded-lg">
                <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200">
                    <h4 class="text-sm font-medium text-gray-900">Item #<span class="item-number">${counter + 1}</span></h4>
                    <div class="flex gap-2">
                        <button type="button" class="inline-flex items-center gap-1 px-2 py-1 text-xs border border-green-300 text-green-600 rounded hover:bg-green-50 focus:ring-2 focus:ring-green-500 transition-colors add-item-below">
                            <i class="fas fa-plus"></i>
                            <span>Add Below</span>
                        </button>
                        <button type="button" class="inline-flex items-center gap-1 px-2 py-1 text-xs border border-red-300 text-red-600 rounded hover:bg-red-50 focus:ring-2 focus:ring-red-500 transition-colors remove-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="toc_items_${counter}_title" class="block text-sm font-medium text-gray-700 mb-1">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                   id="toc_items_${counter}_title" 
                                   name="toc_items[${counter}][title]" 
                                   placeholder="Enter title"
                                   required>
                        </div>
                        <div>
                            <label for="toc_items_${counter}_status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                    id="toc_items_${counter}_status" 
                                    name="toc_items[${counter}][status]">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="toc_items_${counter}_description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                  id="toc_items_${counter}_description" 
                                  name="toc_items[${counter}][description]" 
                                  rows="3" 
                                  placeholder="Enter description (optional)"></textarea>
                    </div>
                </div>
            </div>
        `;
            }

            function updateItemNumbers() {
                document.querySelectorAll('.toc-item-group').forEach((item, index) => {
                    const numberSpan = item.querySelector('.item-number');
                    numberSpan.textContent = index + 1;
                });
            }

            function updateFormFieldNames() {
                document.querySelectorAll('.toc-item-group').forEach((item, index) => {
                    // Update form field names and IDs to maintain proper indexing
                    const titleInput = item.querySelector('input[name*="[title]"]');
                    const statusSelect = item.querySelector('select[name*="[status]"]');
                    const descriptionTextarea = item.querySelector('textarea[name*="[description]"]');
                    const titleLabel = item.querySelector('label[for*="_title"]');
                    const statusLabel = item.querySelector('label[for*="_status"]');
                    const descriptionLabel = item.querySelector('label[for*="_description"]');

                    if (titleInput) {
                        titleInput.name = `toc_items[${index}][title]`;
                        titleInput.id = `toc_items_${index}_title`;
                        if (titleLabel) titleLabel.setAttribute('for', `toc_items_${index}_title`);
                    }

                    if (statusSelect) {
                        statusSelect.name = `toc_items[${index}][status]`;
                        statusSelect.id = `toc_items_${index}_status`;
                        if (statusLabel) statusLabel.setAttribute('for', `toc_items_${index}_status`);
                    }

                    if (descriptionTextarea) {
                        descriptionTextarea.name = `toc_items[${index}][description]`;
                        descriptionTextarea.id = `toc_items_${index}_description`;
                        if (descriptionLabel) descriptionLabel.setAttribute('for',
                            `toc_items_${index}_description`);
                    }
                });
            }

            function updateRemoveButtonsVisibility() {
                const itemCount = document.querySelectorAll('.toc-item-group').length;
                const removeButtons = document.querySelectorAll('.remove-item');

                removeButtons.forEach(btn => {
                    if (itemCount > 1) {
                        btn.classList.remove('hidden');
                    } else {
                        btn.classList.add('hidden');
                    }
                });
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

            // Handle old input repopulation for validation errors
            @if (old('toc_items'))
                @foreach (old('toc_items', []) as $index => $item)
                    @if ($index > 0)
                        // Add items for old input beyond the first one
                        setTimeout(function() {
                            addNewItem();

                            // Set the values
                            const items = document.querySelectorAll('.toc-item-group');
                            const lastItem = items[items.length - 1];
                            lastItem.querySelector('input[name*="[title]"]').value =
                                '{{ addslashes($item['title'] ?? '') }}';
                            lastItem.querySelector('textarea[name*="[description]"]').value =
                                '{{ addslashes($item['description'] ?? '') }}';
                            lastItem.querySelector('select[name*="[status]"]').value =
                                '{{ $item['status'] ?? 1 }}';
                        }, 100 * {{ $index }});
                    @endif
                @endforeach
            @endif
        });
    </script>
@endpush
