@extends('layouts.admin')

@section('title', 'Posts Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
	<div>
		<div class="flex items-center justify-between mb-6">
			<h1 class="text-2xl font-bold text-gray-900">Posts Management</h1>
			<a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors">
				<i class="fas fa-plus"></i>
				<span>Create New Post</span>
			</a>
		</div>

		@if(session('success'))
			<div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3 flex items-start justify-between">
				<div>{{ session('success') }}</div>
				<button type="button" class="ml-4 text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">&times;</button>
			</div>
		@endif

		<!-- Filters -->
		<div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
			<div class="p-4">
				<form method="GET" action="{{ route('admin.posts.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
					<div>
						<label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
						<input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search posts..."
							class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
					</div>
					<div>
						<label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
						<select id="type" name="type" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
							<option value="">All Types</option>
							<option value="service" {{ request('type') == 'service' ? 'selected' : '' }}>Service</option>
							<option value="practice" {{ request('type') == 'practice' ? 'selected' : '' }}>Practice</option>
							<option value="news" {{ request('type') == 'news' ? 'selected' : '' }}>News</option>
							<option value="blog" {{ request('type') == 'blog' ? 'selected' : '' }}>Blog</option>
						</select>
					</div>
					<div>
						<label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
						<select id="status" name="status" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
							<option value="">All Statuses</option>
							<option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
							<option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
							<option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
						</select>
					</div>
					<div class="flex items-end gap-2">
						<button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-primary text-primary hover:bg-purple-50">Filter</button>
						<a href="{{ route('admin.posts.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Clear</a>
					</div>
				</form>
			</div>
		</div>

		<!-- Posts Table -->
		<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
			<div class="p-0">
				@if($posts->count() > 0)
					<div class="overflow-x-auto">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Image</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Type</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">Status</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Created</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Actions</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-100">
								@foreach($posts as $post)
									<tr>
										<td class="px-4 py-3">
											@if($post->feature_image)
												<img src="{{ $post->feature_image_url }}" alt="{{ $post->title }}" class="w-12 h-12 rounded object-cover">
											@else
												<div class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center">
													<i class="fas fa-image text-gray-400"></i>
												</div>
											@endif
										</td>
										<td class="px-4 py-3">
											<div class="text-gray-900 font-medium">{{ Str::limit($post->title, 50) }}</div>
											@if($post->excerpt)
												<div class="text-sm text-gray-500">{{ Str::limit($post->excerpt, 80) }}</div>
											@endif
										</td>
										<td class="px-4 py-3">
											<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-800">{{ ucfirst($post->type) }}</span>
										</td>
										<td class="px-4 py-3">
											@php
												$badgeClasses = [
													'active' => 'bg-green-100 text-green-800',
													'inactive' => 'bg-red-100 text-red-800',
													'draft' => 'bg-yellow-100 text-yellow-800'
												][$post->status] ?? 'bg-gray-100 text-gray-800';
											@endphp
											<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $badgeClasses }}">{{ ucfirst($post->status) }}</span>
										</td>
										<td class="px-4 py-3 text-gray-700 text-sm">{{ $post->created_at->format('M d, Y') }}</td>
										<td class="px-4 py-3">
											<div class="flex items-center gap-2">
												<a href="{{ route('admin.posts.show', $post) }}" title="View" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
													<i class="fas fa-eye"></i>
												</a>
												<a href="{{ route('admin.posts.edit', $post) }}" title="Edit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-primary text-primary hover:bg-purple-50">
													<i class="fas fa-edit"></i>
												</a>
												<a href="{{ route('admin.posts.left-right-contents.index', $post->id) }}" title="Manage Left-Right Content" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-50">
													<i class="fas fa-align-left"></i>
												</a>
												<a href="{{ route('admin.posts.faqs.index', $post->id) }}" title="Manage FAQs" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-indigo-300 text-indigo-600 hover:bg-indigo-50">
													<i class="fas fa-question-circle"></i>
												</a>
												<button type="button" title="Delete" onclick="confirmDelete('{{ $post->id }}', '{{ $post->title }}')" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
													<i class="fas fa-trash"></i>
												</button>
												<form id="delete-form-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="hidden">
													@csrf
													@method('DELETE')
												</form>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<!-- Pagination -->
					<div class="flex justify-center p-4">
						{{ $posts->appends(request()->query())->links() }}
					</div>
				@else
					<div class="text-center py-12">
						<i class="fas fa-file-alt text-4xl text-gray-300 mb-3"></i>
						<p class="text-gray-500 mb-4">No posts found.</p>
						<a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary">
							<i class="fas fa-plus"></i>
							<span>Create your first post</span>
						</a>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<script>
function confirmDelete(postId, postTitle) {
    if (confirm('Are you sure you want to delete "' + postTitle + '"? This action cannot be undone.')) {
        document.getElementById('delete-form-' + postId).submit();
    }
}
</script>
@endsection
