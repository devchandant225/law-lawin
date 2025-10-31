@extends('layouts.admin')

@section('title', 'View Publication - ' . $publication->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">View Publication</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.publications.edit', $publication) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    <i class="fas fa-edit"></i>
                    <span>Edit Publication</span>
                </a>
                <a href="{{ route('admin.publications.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Publications</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Publication Header -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900 mb-1">{{ $publication->title }}</h2>
                                <div class="text-gray-500 text-sm">
                                    <div>
                                        <i class="fas fa-calendar mr-1"></i>
                                        Created: {{ $publication->created_at->format('M d, Y \a\t g:i A') }}
                                    </div>
                                    @if($publication->created_at != $publication->updated_at)
                                        <div>
                                            <i class="fas fa-edit mr-1"></i>
                                            Updated: {{ $publication->updated_at->format('M d, Y \a\t g:i A') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                @php
                                    $statusClasses = [
                                        'active' => 'bg-green-100 text-green-800',
                                        'inactive' => 'bg-red-100 text-red-800',
                                        'draft' => 'bg-yellow-100 text-yellow-800'
                                    ][$publication->status] ?? 'bg-gray-100 text-gray-800';
                                    
                                    $postTypeClasses = [
                                        'publication' => 'bg-blue-100 text-blue-800',
                                        'more-publication' => 'bg-purple-100 text-purple-800',
                                        'terms-condition' => 'bg-green-100 text-green-800',
                                        'privacy-policy' => 'bg-yellow-100 text-yellow-800',
                                        'cookies-policy' => 'bg-red-100 text-red-800'
                                    ][$publication->post_type] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $statusClasses }}">{{ ucfirst($publication->status) }}</span>
                                <br>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $postTypeClasses }} mt-2">{{ ucfirst(str_replace('-', ' ', $publication->post_type)) }}</span>
                                <br>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-800 mt-2">Order: {{ $publication->orderlist }}</span>
                            </div>
                        </div>

                        <!-- Slug -->
                        <div class="mb-3 text-sm text-gray-500">
                            <i class="fas fa-link mr-1"></i>
                            Slug: <code class="text-gray-700">{{ $publication->slug }}</code>
                        </div>

                        <!-- Featured Image -->
                        @if($publication->feature_image)
                            <div class="mb-4">
                                <img src="{{ $publication->feature_image_url }}" alt="{{ $publication->title }}" class="w-full max-h-[400px] object-cover rounded">
                            </div>
                        @endif

                        <!-- Excerpt -->
                        @if($publication->excerpt)
                            <div class="mb-2">
                                <h5 class="font-semibold text-gray-900">Excerpt</h5>
                                <div class="p-3 bg-gray-50 rounded text-gray-700">
                                    {{ $publication->excerpt }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SEO Information -->
                @if($publication->metatitle || $publication->metadescription || $publication->metakeywords)
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900"><i class="fas fa-search mr-2"></i>SEO Information</h5>
                        </div>
                        <div class="p-4 space-y-3 text-gray-700">
                            @if($publication->metatitle)
                                <div>
                                    <strong class="text-gray-900">Meta Title:</strong>
                                    <div class="text-gray-600">{{ $publication->metatitle }}</div>
                                </div>
                            @endif

                            @if($publication->metadescription)
                                <div>
                                    <strong class="text-gray-900">Meta Description:</strong>
                                    <div class="text-gray-600">{{ $publication->metadescription }}</div>
                                </div>
                            @endif

                            @if($publication->metakeywords)
                                <div>
                                    <strong class="text-gray-900">Meta Keywords:</strong>
                                    <div class="text-gray-600">{{ $publication->metakeywords }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Google Schema -->
                @if($publication->google_schema || $publication->google_schema_json)
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                            <h5 class="font-semibold text-gray-900"><i class="fab fa-google mr-2"></i>Google Schema (JSON-LD)</h5>
                            <button class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm" onclick="toggleSchema()">
                                <span id="schema-toggle-text">Show Schema</span>
                            </button>
                        </div>
                        <div class="p-4">
                            <div id="schema-content" style="display: none;">
                                <pre class="bg-gray-50 p-3 rounded border border-gray-200 overflow-auto"><code class="language-json">{{ $publication->google_schema_json }}</code></pre>
                            </div>
                        </div>
                    </div>
                @endif
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
                            <a href="{{ route('admin.publications.edit', $publication) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                <i class="fas fa-edit"></i>
                                <span>Edit Publication</span>
                            </a>
                            @if($publication->status === 'active')
                                @if($publication->post_type === 'publication')
                                    <a href="{{ url('/publication/' . $publication->slug) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <span>View Live Publication</span>
                                    </a>
                                @elseif($publication->post_type === 'more-publication')
                                    <a href="{{ url('/more-publication/' . $publication->slug) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-purple-600 text-white hover:bg-purple-700" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <span>View Live More Publication</span>
                                    </a>
                                @elseif($publication->post_type === 'terms-condition')
                                    <a href="{{ url('/terms-condition') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <span>View Terms & Conditions</span>
                                    </a>
                                @elseif($publication->post_type === 'privacy-policy')
                                    <a href="{{ url('/privacy-policy') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-yellow-600 text-white hover:bg-yellow-700" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <span>View Privacy Policy</span>
                                    </a>
                                @elseif($publication->post_type === 'cookies-policy')
                                    <a href="{{ url('/cookies-policy') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        <span>View Cookies Policy</span>
                                    </a>
                                @endif
                            @endif
                            <button type="button" onclick="confirmDelete()" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
                                <i class="fas fa-trash"></i>
                                <span>Delete Publication</span>
                            </button>
                        </div>

                        <!-- Delete Form (Hidden) -->
                        <form id="delete-form" action="{{ route('admin.publications.destroy', $publication) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>

                <!-- Publication Statistics -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Publication Details</h5>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-xl font-bold text-indigo-600">{{ $publication->id }}</div>
                                <div class="text-sm text-gray-500">ID</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-blue-600">{{ $publication->orderlist }}</div>
                                <div class="text-sm text-gray-500">Order</div>
                            </div>
                            <div class="text-center">
                                @php
                                    $statusTextClasses = [
                                        'active' => 'text-green-600',
                                        'inactive' => 'text-red-600',
                                        'draft' => 'text-yellow-600'
                                    ][$publication->status] ?? 'text-gray-600';
                                @endphp
                                <div class="text-xl font-bold {{ $statusTextClasses }}">{{ ucfirst($publication->status) }}</div>
                                <div class="text-sm text-gray-500">Status</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-gray-600">{{ strlen($publication->excerpt ?: '') }}</div>
                                <div class="text-sm text-gray-500">Excerpt Length</div>
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
                                    <div class="font-semibold">Publication Created</div>
                                    <small class="text-gray-500">{{ $publication->created_at->format('M d, Y \a\t g:i A') }}</small>
                                </div>
                            </div>
                            @if($publication->created_at != $publication->updated_at)
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <div class="font-semibold">Last Updated</div>
                                        <small class="text-gray-500">{{ $publication->updated_at->format('M d, Y \a\t g:i A') }}</small>
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
function toggleSchema() {
    const content = document.getElementById('schema-content');
    const toggleText = document.getElementById('schema-toggle-text');
    
    if (content.style.display === 'none') {
        content.style.display = 'block';
        toggleText.textContent = 'Hide Schema';
    } else {
        content.style.display = 'none';
        toggleText.textContent = 'Show Schema';
    }
}

function confirmDelete() {
    if (confirm('Are you sure you want to delete "{{ $publication->title }}"? This action cannot be undone.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection
