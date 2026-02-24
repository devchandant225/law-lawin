@extends('layouts.admin')

@section('title', 'Edit Meta Tag')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
	<div>
		<div class="flex items-center justify-between mb-6">
			<div>
				<h1 class="text-2xl font-bold text-gray-900">Edit Meta Tag</h1>
				<p class="text-gray-600 mt-1">Update SEO meta tags for {{ ucfirst(str_replace('-', ' ', $metaTag->page_type)) }}</p>
			</div>
			<a href="{{ route('admin.meta-tags.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
				<i class="fas fa-arrow-left"></i>
				<span>Back to Meta Tags</span>
			</a>
		</div>

		<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
			<div class="p-6">
				<form action="{{ route('admin.meta-tags.update', $metaTag) }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					
					<div class="grid grid-cols-1 gap-6">
						<!-- Page Type -->
						<div>
							<label for="page_type" class="block text-sm font-medium text-gray-700 mb-2">
								Page Type <span class="text-red-500">*</span>
							</label>
							<select name="page_type" id="page_type" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary @error('page_type') border-red-300 @enderror" required>
								<option value="">Select Page Type</option>
								@foreach($pageTypes as $value => $label)
									<option value="{{ $value }}" {{ old('page_type', $metaTag->page_type) == $value ? 'selected' : '' }}>{{ $label }}</option>
								@endforeach
							</select>
							@error('page_type')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

						<!-- Title -->
						<div>
							<label for="title" class="block text-sm font-medium text-gray-700 mb-2">
								Meta Title <span class="text-red-500">*</span>
							</label>
							<input type="text" name="title" id="title" value="{{ old('title', $metaTag->title) }}" maxlength="255" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary @error('title') border-red-300 @enderror" required>
							@error('title')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
							<p class="mt-1 text-sm text-gray-500">Recommended: 50-60 characters (Current: <span id="title-count">{{ strlen($metaTag->title) }}</span>)</p>
						</div>

						<!-- Description -->
						<div>
							<label for="desc" class="block text-sm font-medium text-gray-700 mb-2">
								Meta Description
							</label>
							<textarea name="desc" id="desc" rows="3" maxlength="500" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary @error('desc') border-red-300 @enderror">{{ old('desc', $metaTag->desc) }}</textarea>
							@error('desc')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
							<p class="mt-1 text-sm text-gray-500">Recommended: 150-160 characters (Current: <span id="desc-count">{{ strlen($metaTag->desc) }}</span>)</p>
						</div>

						<!-- Keywords -->
						<div>
							<label for="keyword" class="block text-sm font-medium text-gray-700 mb-2">
								Meta Keywords
							</label>
							<textarea name="keyword" id="keyword" rows="2" maxlength="1000" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary @error('keyword') border-red-300 @enderror" placeholder="keyword1, keyword2, keyword3">{{ old('keyword', $metaTag->keyword) }}</textarea>
							@error('keyword')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
							<p class="mt-1 text-sm text-gray-500">Separate keywords with commas</p>
						</div>

						<!-- Image -->
						<div>
							<label for="image" class="block text-sm font-medium text-gray-700 mb-2">
								Meta Image (Open Graph)
							</label>
							@if($metaTag->image)
								<div class="mb-3">
									<img src="{{ Storage::url($metaTag->image) }}" alt="Current meta image" class="w-32 h-18 object-cover rounded-lg border border-gray-200">
									<p class="text-sm text-gray-500 mt-1">Current image</p>
								</div>
							@endif
							<input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-purple-700 @error('image') border-red-300 @enderror">
							@error('image')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
							<p class="mt-1 text-sm text-gray-500">Recommended: 1200x630px, max 2MB (Leave empty to keep current image)</p>
						</div>

						<!-- Schema JSON-LD (Head) -->
						<div>
							<label for="schema_head" class="block text-sm font-medium text-gray-700 mb-2">
								Schema JSON-LD (Head)
							</label>
							<textarea name="schema_head" id="schema_head" rows="8" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary font-mono text-sm @error('schema_head') border-red-300 @enderror" placeholder='{"@context": "https://schema.org", "@type": "WebPage", "name": "Page Name"}'>{{ old('schema_head', $metaTag->schema_head ? json_encode($metaTag->schema_head, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
							@error('schema_head')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
							<p class="mt-1 text-sm text-gray-500">Structured data for the &lt;head&gt; section (optional)</p>
						</div>

						<!-- Schema JSON-LD (Body) -->
						<div>
							<label for="schema_body" class="block text-sm font-medium text-gray-700 mb-2">
								Schema JSON-LD (Body)
							</label>
							<textarea name="schema_body" id="schema_body" rows="8" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary font-mono text-sm @error('schema_body') border-red-300 @enderror" placeholder='{"@context": "https://schema.org", "@type": "WebPage", "name": "Page Name"}'>{{ old('schema_body', $metaTag->schema_body ? json_encode($metaTag->schema_body, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
							@error('schema_body')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
							<p class="mt-1 text-sm text-gray-500">Structured data for the end of &lt;body&gt; section (optional)</p>
						</div>

						<!-- Status -->
						<div>
							<div class="flex items-center">
								<input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $metaTag->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
								<label for="is_active" class="ml-2 block text-sm text-gray-700">
									Active
								</label>
							</div>
							<p class="mt-1 text-sm text-gray-500">Enable this meta tag for the selected page</p>
						</div>
					</div>

					<div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
						<a href="{{ route('admin.meta-tags.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
							Cancel
						</a>
						<button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-primary">
							Update Meta Tag
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
// Character counters
function updateCharCount(inputId, countId) {
	const input = document.getElementById(inputId);
	const counter = document.getElementById(countId);
	if (input && counter) {
		counter.textContent = input.value.length;
	}
}

document.getElementById('title').addEventListener('input', function() {
	updateCharCount('title', 'title-count');
});

document.getElementById('desc').addEventListener('input', function() {
	updateCharCount('desc', 'desc-count');
});

// JSON validation for schema fields
['schema_head', 'schema_body'].forEach(id => {
	const element = document.getElementById(id);
	if (element) {
		element.addEventListener('blur', function() {
			const value = this.value.trim();
			if (value) {
				try {
					JSON.parse(value);
					this.classList.remove('border-red-300');
					this.classList.add('border-green-300');
				} catch (e) {
					this.classList.remove('border-green-300');
					this.classList.add('border-red-300');
				}
			} else {
				this.classList.remove('border-red-300', 'border-green-300');
			}
		});
	}
});
</script>
@endsection
