@extends('layouts.admin')

@section('title', 'Manage FAQs - ' . $post->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Manage FAQs for "{{ $post->title }}"</h1>
            <nav class="text-sm breadcrumbs">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline">Dashboard</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><a href="{{ route('admin.posts.index') }}" class="text-primary hover:underline">Posts</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><a href="{{ route('admin.posts.edit', $post->id) }}" class="text-primary hover:underline">{{ $post->title }}</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li class="text-gray-500">FAQs</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                <h2 class="text-xl font-semibold text-gray-800">FAQ List</h2>
                <a href="{{ route('admin.posts.faqs.create', $post->id) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors">
                    <i class="fas fa-plus"></i>
                    <span>Add New FAQ</span>
                </a>
            </div>

            <form method="GET" class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <input type="text" name="search" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" placeholder="Search FAQs..." value="{{ request('search') }}">
                    </div>
                    <div class="md:col-span-2 flex items-end">
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-primary text-primary hover:bg-purple-50">Search</button>
                        <a href="{{ route('admin.posts.faqs.index', $post->id) }}" class="ml-2 inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Clear</a>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Created At</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($faqs as $faq)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ Str::limit($faq->question, 50) }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit(strip_tags($faq->answer), 80) }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $faq->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($faq->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-700 text-sm">{{ $faq->created_at->format('M d, Y') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.posts.faqs.edit', [$post->id, $faq->id]) }}" title="Edit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-primary text-primary hover:bg-purple-50">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.posts.faqs.destroy', [$post->id, $faq->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-red-300 text-red-600 hover:bg-red-50" onclick="return confirm('Are you sure you want to delete this FAQ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-12 text-center text-gray-500">
                                    <i class="fas fa-question-circle text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-lg">No FAQs found.</p>
                                    <a href="{{ route('admin.posts.faqs.create', $post->id) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary mt-4">
                                        <i class="fas fa-plus"></i>
                                        <span>Create your first FAQ</span>
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-center mt-6">
                {{ $faqs->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection