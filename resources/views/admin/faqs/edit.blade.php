@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit FAQ</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.faqs.show', $faq) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-sky-300 text-sky-700 hover:bg-sky-50">
                    <i class="fas fa-eye"></i>
                    <span>View FAQ</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to FAQs</span>
                </a>
            </div>
        </div>

        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- FAQ Information -->
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">FAQ Information</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <!-- Question -->
                            <div>
                                <label for="question" class="block text-sm font-medium text-gray-700 mb-1">Question <span class="text-red-600">*</span></label>
                                <textarea id="question" name="question" rows="3" required 
                                          placeholder="Enter the frequently asked question..."
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('question') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('question', $faq->question) }}</textarea>
                                @error('question')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Clear and concise question that users frequently ask</p>
                            </div>

                            <!-- Answer -->
                            <div>
                                <label for="answer" class="block text-sm font-medium text-gray-700 mb-1">Answer <span class="text-red-600">*</span></label>
                                <textarea id="answer" name="answer" rows="6" required 
                                          placeholder="Provide a comprehensive answer..."
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('answer') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('answer', $faq->answer) }}</textarea>
                                @error('answer')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Detailed answer that addresses the question completely</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-4 space-y-6">
                        <!-- FAQ Settings -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">FAQ Settings</h5>
                            </div>
                            <div class="p-4 space-y-4">
                                <!-- Publication -->
                                <div>
                                    <label for="publication_id" class="block text-sm font-medium text-gray-700 mb-1">Publication <span class="text-red-600">*</span></label>
                                    <select id="publication_id" name="publication_id" required
                                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('publication_id') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                        <option value="">Select Publication</option>
                                        @foreach($publications as $publication)
                                            <option value="{{ $publication->id }}" 
                                                {{ (old('publication_id', $faq->publication_id) == $publication->id) ? 'selected' : '' }}>
                                                {{ $publication->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('publication_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Select the publication this FAQ belongs to</p>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-600">*</span></label>
                                    <select id="status" name="status" required
                                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                        <option value="active" {{ old('status', $faq->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $faq->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Set FAQ visibility status</p>
                                </div>

                                <!-- FAQ Information -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">FAQ Information</label>
                                    <div class="text-sm text-gray-500 space-y-1">
                                        <div>Created: {{ $faq->created_at->format('M d, Y \a\t g:i A') }}</div>
                                        <div>Updated: {{ $faq->updated_at->format('M d, Y \a\t g:i A') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="p-4">
                                <div class="grid gap-2">
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                        <i class="fas fa-save"></i>
                                        <span>Update FAQ</span>
                                    </button>
                                    <a href="{{ route('admin.faqs.show', $faq) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-sky-300 text-sky-700 hover:bg-sky-50">
                                        <i class="fas fa-eye"></i>
                                        <span>View FAQ</span>
                                    </a>
                                    <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
