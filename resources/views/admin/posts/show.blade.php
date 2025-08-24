@extends('layouts.admin')

@section('title', 'View Post - ' . $post->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">View Post</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    <i class="fas fa-edit"></i>
                    <span>Edit Post</span>
                </a>
                <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Posts</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Post Header -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900 mb-1">{{ $post->title }}</h2>
                                <div class="text-gray-500 text-sm">
                                    <div>
                                        <i class="fas fa-calendar mr-1"></i>
                                        Created: {{ $post->created_at->format('M d, Y \a\t g:i A') }}
                                    </div>
                                    @if($post->created_at != $post->updated_at)
                                        <div>
                                            <i class="fas fa-edit mr-1"></i>
                                            Updated: {{ $post->updated_at->format('M d, Y \a\t g:i A') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-800 mb-2">{{ ucfirst($post->type) }}</span>
                                <br>
                                @php
                                    $statusClasses = [
                                        'active' => 'bg-green-100 text-green-800',
                                        'inactive' => 'bg-red-100 text-red-800',
                                        'draft' => 'bg-yellow-100 text-yellow-800'
                                    ][$post->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $statusClasses }}">{{ ucfirst($post->status) }}</span>
                            </div>
                        </div>

                        <!-- Slug -->
                        <div class="mb-3 text-sm text-gray-500">
                            <i class="fas fa-link mr-1"></i>
                            Slug: <code class="text-gray-700">{{ $post->slug }}</code>
                        </div>

                        <!-- Featured Image -->
                        @if($post->feature_image)
                            <div class="mb-4">
                                <img src="{{ $post->feature_image_url }}" alt="{{ $post->title }}" class="w-full max-h-[400px] object-cover rounded">
                            </div>
                        @endif

                        <!-- Excerpt -->
                        @if($post->excerpt)
                            <div class="mb-4">
                                <h5 class="font-semibold text-gray-900">Excerpt</h5>
                                <div class="p-3 bg-gray-50 rounded text-gray-700">
                                    {{ $post->excerpt }}
                                </div>
                            </div>
                        @endif

                        <!-- Description -->
                        <div class="mb-2">
                            <h5 class="font-semibold text-gray-900 mb-2">Description</h5>
                            <div class="post-content leading-7 text-gray-800">
                                {!! nl2br(e($post->description)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Information -->
                @if($post->meta_title || $post->meta_description || $post->meta_keywords)
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900"><i class="fas fa-search mr-2"></i>SEO Information</h5>
                        </div>
                        <div class="p-4 space-y-3 text-gray-700">
                            @if($post->meta_title)
                                <div>
                                    <strong class="text-gray-900">Meta Title:</strong>
                                    <div class="text-gray-600">{{ $post->meta_title }}</div>
                                </div>
                            @endif

                            @if($post->meta_description)
                                <div>
                                    <strong class="text-gray-900">Meta Description:</strong>
                                    <div class="text-gray-600">{{ $post->meta_description }}</div>
                                </div>
                            @endif

                            @if($post->meta_keywords)
                                <div>
                                    <strong class="text-gray-900">Meta Keywords:</strong>
                                    <div class="text-gray-600">{{ $post->meta_keywords }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Google Schema -->
                @if($post->google_schema || $post->google_schema_json)
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                            <h5 class="font-semibold text-gray-900"><i class="fab fa-google mr-2"></i>Google Schema (JSON-LD)</h5>
                            <button class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm" onclick="toggleSchema()">
                                <span id="schema-toggle-text">Show Schema</span>
                            </button>
                        </div>
                        <div class="p-4">
                            <div id="schema-content" style="display: none;">
                                <pre class="bg-gray-50 p-3 rounded border border-gray-200 overflow-auto"><code class="language-json">{{ $post->google_schema_json }}</code></pre>
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
                            <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                <i class="fas fa-edit"></i>
                                <span>Edit Post</span>
                            </a>
                            @if($post->status === 'active')
                                <a href="{{ url('/posts/' . $post->slug) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700" target="_blank">
                                    <i class="fas fa-external-link-alt"></i>
                                    <span>View Live Post</span>
                                </a>
                            @endif
                            <button type="button" onclick="confirmDelete()" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
                                <i class="fas fa-trash"></i>
                                <span>Delete Post</span>
                            </button>
                        </div>

                        <!-- Delete Form (Hidden) -->
                        <form id="delete-form" action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>

                <!-- Post Statistics -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Post Details</h5>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-xl font-bold text-indigo-600">{{ $post->id }}</div>
                                <div class="text-sm text-gray-500">Post ID</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-blue-600">{{ ucfirst($post->type) }}</div>
                                <div class="text-sm text-gray-500">Type</div>
                            </div>
                            <div class="text-center">
                                @php
                                    $statusTextClasses = [
                                        'active' => 'text-green-600',
                                        'inactive' => 'text-red-600',
                                        'draft' => 'text-yellow-600'
                                    ][$post->status] ?? 'text-gray-600';
                                @endphp
                                <div class="text-xl font-bold {{ $statusTextClasses }}">{{ ucfirst($post->status) }}</div>
                                <div class="text-sm text-gray-500">Status</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-gray-600">{{ strlen($post->description) }}</div>
                                <div class="text-sm text-gray-500">Characters</div>
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
                                    <div class="font-semibold">Post Created</div>
                                    <small class="text-gray-500">{{ $post->created_at->format('M d, Y \a\t g:i A') }}</small>
                                </div>
                            </div>
                            @if($post->created_at != $post->updated_at)
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <div class="font-semibold">Last Updated</div>
                                        <small class="text-gray-500">{{ $post->updated_at->format('M d, Y \a\t g:i A') }}</small>
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

.post-content {
    line-height: 1.8;
    font-size: 1.1rem;
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
    if (confirm('Are you sure you want to delete "{{ $post->title }}"? This action cannot be undone.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection
