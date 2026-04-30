@props(['name', 'label', 'data' => []])

<div class="schema-repeater space-y-4" data-name="{{ $name }}">
    <div class="flex items-center justify-between">
        <label class="block text-sm font-semibold text-gray-700">{{ $label }}</label>
        <button type="button" class="add-schema inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-bold hover:bg-indigo-100 transition-colors border border-indigo-100">
            <i class="fas fa-plus-circle"></i>
            <span>Add Item</span>
        </button>
    </div>
    
    <div class="schema-items space-y-4">
        @php
            $items = old($name, $data ?: []);
            if (!is_array($items)) {
                $items = [$items];
            }
            if (empty($items)) {
                $items = [''];
            }
        @endphp

        @foreach($items as $index => $value)
            @php
                // Convert array to JSON string for display
                $displayValue = is_array($value) ? json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : (string) $value;
            @endphp
            <div class="schema-item relative group bg-gray-50/50 rounded-xl p-4 border border-gray-200 transition-all hover:border-indigo-300 hover:bg-white shadow-sm hover:shadow-md">
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Item #{{ $index + 1 }}</span>
                        <button type="button" class="remove-schema p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md transition-all opacity-0 group-hover:opacity-100" title="Remove">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </div>
                    <div class="relative">
                        <textarea name="{{ $name }}[]" rows="5"
                            class="block w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 font-mono text-[11px] leading-relaxed schema-textarea bg-white/50 focus:bg-white transition-all"
                            placeholder='{"@context": "https://schema.org", "@type": "WebPage", ...}'>{{ $displayValue }}</textarea>
                        <div class="json-status absolute top-2 right-2 pointer-events-none">
                            <i class="fas fa-check-circle text-green-500 hidden"></i>
                            <i class="fas fa-exclamation-circle text-red-500 hidden"></i>
                        </div>
                    </div>
                    <p class="json-error-msg text-[10px] font-medium text-red-600 hidden">
                        <i class="fas fa-info-circle mr-1"></i>Invalid JSON structure. Please check your syntax.
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@once
@push('scripts')
<script>
    function validateJson(textarea) {
        const value = textarea.value.trim();
        const container = textarea.closest('.schema-item');
        const errorMsg = container.querySelector('.json-error-msg');
        const successIcon = container.querySelector('.fa-check-circle');
        const errorIcon = container.querySelector('.fa-exclamation-circle');
        
        if (value) {
            try {
                JSON.parse(value);
                textarea.classList.remove('border-red-300', 'bg-red-50/10');
                textarea.classList.add('border-green-300', 'bg-green-50/10');
                errorMsg.classList.add('hidden');
                successIcon.classList.remove('hidden');
                errorIcon.classList.add('hidden');
            } catch (e) {
                textarea.classList.remove('border-green-300', 'bg-green-50/10');
                textarea.classList.add('border-red-300', 'bg-red-50/10');
                errorMsg.classList.remove('hidden');
                successIcon.classList.add('hidden');
                errorIcon.classList.remove('hidden');
            }
        } else {
            textarea.classList.remove('border-red-300', 'border-green-300', 'bg-red-50/10', 'bg-green-50/10');
            errorMsg.classList.add('hidden');
            successIcon.classList.add('hidden');
            errorIcon.classList.add('hidden');
        }
    }

    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('schema-textarea')) {
            validateJson(e.target);
        }
    }, true);

    document.addEventListener('click', function(e) {
        const addBtn = e.target.closest('.add-schema');
        if (addBtn) {
            const repeater = addBtn.closest('.schema-repeater');
            const itemsContainer = repeater.querySelector('.schema-items');
            const name = repeater.dataset.name;
            const nextIndex = itemsContainer.querySelectorAll('.schema-item').length + 1;
            
            const newItem = document.createElement('div');
            newItem.className = 'schema-item relative group bg-gray-50/50 rounded-xl p-4 border border-gray-200 transition-all hover:border-indigo-300 hover:bg-white shadow-sm hover:shadow-md';
            newItem.innerHTML = `
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Item #${nextIndex}</span>
                        <button type="button" class="remove-schema p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md transition-all opacity-0 group-hover:opacity-100" title="Remove">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </div>
                    <div class="relative">
                        <textarea name="${name}[]" rows="5" 
                            class="block w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 font-mono text-[11px] leading-relaxed schema-textarea bg-white/50 focus:bg-white transition-all"
                            placeholder='{"@context": "https://schema.org", "@type": "WebPage", ...}'></textarea>
                        <div class="json-status absolute top-2 right-2 pointer-events-none">
                            <i class="fas fa-check-circle text-green-500 hidden"></i>
                            <i class="fas fa-exclamation-circle text-red-500 hidden"></i>
                        </div>
                    </div>
                    <p class="json-error-msg text-[10px] font-medium text-red-600 hidden">
                        <i class="fas fa-info-circle mr-1"></i>Invalid JSON structure. Please check your syntax.
                    </p>
                </div>
            `;
            itemsContainer.appendChild(newItem);
            
            // Re-index all items
            updateSchemaIndices(itemsContainer);
        }

        const removeBtn = e.target.closest('.remove-schema');
        if (removeBtn) {
            const item = removeBtn.closest('.schema-item');
            const container = item.closest('.schema-items');
            if (container.querySelectorAll('.schema-item').length > 1) {
                item.remove();
                updateSchemaIndices(container);
            } else {
                const textarea = item.querySelector('textarea');
                textarea.value = '';
                validateJson(textarea);
            }
        }
    });

    function updateSchemaIndices(container) {
        container.querySelectorAll('.schema-item').forEach((item, index) => {
            item.querySelector('span.tracking-widest').textContent = `Item #${index + 1}`;
        });
    }
    
    // Initial validation
    document.querySelectorAll('.schema-textarea').forEach(textarea => {
        if (textarea.value.trim()) validateJson(textarea);
    });
</script>
@endpush
@endonce
