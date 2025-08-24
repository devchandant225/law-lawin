@extends('layouts.admin')

@section('title', 'View FAQ')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">View FAQ</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.faqs.edit', $faq) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    <i class="fas fa-edit"></i>
                    <span>Edit FAQ</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to FAQs</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- FAQ Content -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h2 class="text-xl font-semibold text-gray-900">FAQ Details</h2>
                                    @php
                                        $statusClasses = [
                                            'active' => 'bg-green-100 text-green-800',
                                            'inactive' => 'bg-red-100 text-red-800',
                                        ][$faq->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $statusClasses }}">{{ ucfirst($faq->status) }}</span>
                                </div>
                                <div class="text-gray-500 text-sm mb-4">
                                    <div>
                                        <i class="fas fa-calendar mr-1"></i>
                                        Created: {{ $faq->created_at->format('M d, Y \a\t g:i A') }}
                                    </div>
                                    @if($faq->created_at != $faq->updated_at)
                                        <div>
                                            <i class="fas fa-edit mr-1"></i>
                                            Updated: {{ $faq->updated_at->format('M d, Y \a\t g:i A') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Publication Info -->
                        <div class="mb-4 p-3 bg-blue-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-book text-blue-600 mr-2"></i>
                                <span class="text-sm font-medium text-blue-900">Publication:</span>
                                <span class="text-sm text-blue-800 ml-2">{{ $faq->publication->title ?? 'No Publication' }}</span>
                            </div>
                        </div>

                        <!-- Question -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 flex items-center">
                                <i class="fas fa-question-circle text-indigo-600 mr-2"></i>
                                Question
                            </h3>
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <p class="text-gray-800 leading-relaxed">{{ $faq->question }}</p>
                            </div>
                        </div>

                        <!-- Answer -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 flex items-center">
                                <i class="fas fa-lightbulb text-yellow-600 mr-2"></i>
                                Answer
                            </h3>
                            <div class="p-4 bg-green-50 rounded-lg">
                                <p class="text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Quick Actions -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Quick Actions</h5>
                    </div>
                    <div class="p-4">
                        <div class="grid gap-2">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                <i class="fas fa-edit"></i>
                                <span>Edit FAQ</span>
                            </a>
                            <a href="{{ route('admin.faqs.create', ['publication_id' => $faq->publication_id]) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">
                                <i class="fas fa-plus"></i>
                                <span>Add Another FAQ</span>
                            </a>
                            <button type="button" onclick="confirmDelete()" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
                                <i class="fas fa-trash"></i>
                                <span>Delete FAQ</span>
                            </button>
                        </div>

                        <!-- Delete Form (Hidden) -->
                        <form id="delete-form" action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>

                <!-- FAQ Statistics -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">FAQ Details</h5>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="text-center">
                                <div class="text-xl font-bold text-indigo-600">{{ $faq->id }}</div>
                                <div class="text-sm text-gray-500">FAQ ID</div>
                            </div>
                            <div class="text-center">
                                @php
                                    $statusTextClasses = [
                                        'active' => 'text-green-600',
                                        'inactive' => 'text-red-600',
                                    ][$faq->status] ?? 'text-gray-600';
                                @endphp
                                <div class="text-xl font-bold {{ $statusTextClasses }}">{{ ucfirst($faq->status) }}</div>
                                <div class="text-sm text-gray-500">Status</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-gray-600">{{ strlen($faq->question) }}</div>
                                <div class="text-sm text-gray-500">Question Length</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-gray-600">{{ strlen($faq->answer) }}</div>
                                <div class="text-sm text-gray-500">Answer Length</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Timeline</h5>
                    </div>
                    <div class="p-4">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <div class="font-semibold">FAQ Created</div>
                                    <small class="text-gray-500">{{ $faq->created_at->format('M d, Y \a\t g:i A') }}</small>
                                </div>
                            </div>
                            @if($faq->created_at != $faq->updated_at)
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <div class="font-semibold">Last Updated</div>
                                        <small class="text-gray-500">{{ $faq->updated_at->format('M d, Y \a\t g:i A') }}</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -26px;
    top: 0;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #e9ecef;
}

.bg-success {
    background-color: #28a745;
}

.bg-primary {
    background-color: #007bff;
}
</style>

<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete this FAQ? This action cannot be undone.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection
