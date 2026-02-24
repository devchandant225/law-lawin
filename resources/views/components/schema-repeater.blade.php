@props(['name', 'label', 'data' => []])

<div class="schema-repeater" data-name="{{ $name }}">
    <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
    <div class="schema-items space-y-3">
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
            <div class="schema-item flex gap-2">
                <div class="flex-1">
                    <textarea name="{{ $name }}[]" rows="4" 
                        class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary font-mono text-xs schema-textarea"
                        placeholder='{"@context": "https://schema.org", ...}'>{{ is_array($value) ? json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $value }}</textarea>
                    <p class="json-error-msg mt-1 text-xs text-red-600 hidden">Invalid JSON format</p>
                </div>
                <button type="button" class="remove-schema self-start p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Remove">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        @endforeach
    </div>
    <div class="mt-2">
        <button type="button" class="add-schema inline-flex items-center gap-1 text-sm text-primary hover:text-primary-dark font-medium">
            <i class="fas fa-plus-circle"></i>
            <span>Add Another {{ $label }} Item</span>
        </button>
    </div>
</div>

@once
@push('scripts')
<script>
    function validateJson(textarea) {
        const value = textarea.value.trim();
        const errorMsg = textarea.nextElementSibling;
        if (value) {
            try {
                JSON.parse(value);
                textarea.classList.remove('border-red-300');
                textarea.classList.add('border-green-300');
                errorMsg.classList.add('hidden');
            } catch (e) {
                textarea.classList.remove('border-green-300');
                textarea.classList.add('border-red-300');
                errorMsg.classList.remove('hidden');
            }
        } else {
            textarea.classList.remove('border-red-300', 'border-green-300');
            errorMsg.classList.add('hidden');
        }
    }

    document.addEventListener('blur', function(e) {
        if (e.target.classList.contains('schema-textarea')) {
            validateJson(e.target);
        }
    }, true);

    document.addEventListener('click', function(e) {
        if (e.target.closest('.add-schema')) {
            const repeater = e.target.closest('.schema-repeater');
            const itemsContainer = repeater.querySelector('.schema-items');
            const name = repeater.dataset.name;
            
            const newItem = document.createElement('div');
            newItem.className = 'schema-item flex gap-2';
            newItem.innerHTML = `
                <div class="flex-1">
                    <textarea name="${name}[]" rows="4" 
                        class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary font-mono text-xs schema-textarea"
                        placeholder='{"@context": "https://schema.org", ...}'></textarea>
                    <p class="json-error-msg mt-1 text-xs text-red-600 hidden">Invalid JSON format</p>
                </div>
                <button type="button" class="remove-schema self-start p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Remove">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            itemsContainer.appendChild(newItem);
        }

        if (e.target.closest('.remove-schema')) {
            const item = e.target.closest('.schema-item');
            const container = item.closest('.schema-items');
            if (container.querySelectorAll('.schema-item').length > 1) {
                item.remove();
            } else {
                item.querySelector('textarea').value = '';
            }
        }
    });
</script>
@endpush
@endonce
