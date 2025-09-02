@extends('layouts.admin')

@section('title', 'Meta Tags Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
	<div>
		<div class="flex items-center justify-between mb-6">
			<div>
				<h1 class="text-2xl font-bold text-gray-900">Meta Tags Management</h1>
				<p class="text-gray-600 mt-1">Manage SEO meta tags for all pages</p>
			</div>
			<div class="flex items-center gap-2">
				<a href="{{ route('admin.meta-tags.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors">
					<i class="fas fa-plus"></i>
					<span>Create New Meta Tag</span>
				</a>
			</div>
		</div>

		@if(session('success'))
			<div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3 flex items-start justify-between">
				<div>{{ session('success') }}</div>
				<button type="button" class="ml-4 text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">&times;</button>
			</div>
		@endif

		<!-- Meta Tags Table -->
		<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
			<div class="p-0">
				@if($metaTags->count() > 0)
					<div class="overflow-x-auto">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Image</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Page Type</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">Status</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Created</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Actions</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-100">
								@foreach($metaTags as $metaTag)
									<tr>
										<td class="px-4 py-3">
											@if($metaTag->image)
												<img src="{{ Storage::url($metaTag->image) }}" alt="{{ $metaTag->title }}" class="w-12 h-12 rounded object-cover">
											@else
												<div class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center">
													<i class="fas fa-image text-gray-400"></i>
												</div>
											@endif
										</td>
										<td class="px-4 py-3">
											<div class="text-gray-900 font-medium">{{ Str::limit($metaTag->title, 50) }}</div>
											@if($metaTag->desc)
												<div class="text-sm text-gray-500">{{ Str::limit($metaTag->desc, 80) }}</div>
											@endif
										</td>
										<td class="px-4 py-3">
											@php
												$pageTypeBadgeClasses = [
													'home' => 'bg-blue-100 text-blue-800',
													'about' => 'bg-purple-100 text-purple-800',
													'service' => 'bg-green-100 text-green-800',
													'services' => 'bg-green-100 text-green-800',
													'publication' => 'bg-orange-100 text-orange-800',
													'more-publication' => 'bg-orange-100 text-orange-800',
													'practice' => 'bg-indigo-100 text-indigo-800',
													'practices' => 'bg-indigo-100 text-indigo-800',
													'language' => 'bg-pink-100 text-pink-800',
													'languages' => 'bg-pink-100 text-pink-800',
													'team' => 'bg-yellow-100 text-yellow-800',
													'contact' => 'bg-red-100 text-red-800'
												][$metaTag->page_type] ?? 'bg-gray-100 text-gray-800';
											@endphp
											<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $pageTypeBadgeClasses }}">{{ ucfirst(str_replace('-', ' ', $metaTag->page_type)) }}</span>
										</td>
										<td class="px-4 py-3">
											@php
												$badgeClasses = [
													1 => 'bg-green-100 text-green-800',
													0 => 'bg-red-100 text-red-800'
												][$metaTag->is_active] ?? 'bg-gray-100 text-gray-800';
											@endphp
											<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $badgeClasses }}">{{ $metaTag->is_active ? 'Active' : 'Inactive' }}</span>
										</td>
										<td class="px-4 py-3 text-gray-700 text-sm">{{ $metaTag->created_at->format('M d, Y') }}</td>
										<td class="px-4 py-3">
											<div class="flex items-center gap-2">
												<a href="{{ route('admin.meta-tags.edit', $metaTag) }}" title="Edit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-primary text-primary hover:bg-purple-50">
													<i class="fas fa-edit"></i>
												</a>
												<form action="{{ route('admin.meta-tags.toggle-status', $metaTag) }}" method="POST" class="inline">
													@csrf
													<button type="submit" title="{{ $metaTag->is_active ? 'Deactivate' : 'Activate' }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border {{ $metaTag->is_active ? 'border-yellow-300 text-yellow-600 hover:bg-yellow-50' : 'border-green-300 text-green-600 hover:bg-green-50' }}">
														<i class="fas {{ $metaTag->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
													</button>
												</form>
												<button type="button" title="Delete" onclick="confirmDelete('{{ $metaTag->id }}', '{{ $metaTag->title }}')" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
													<i class="fas fa-trash"></i>
												</button>
												<form id="delete-form-{{ $metaTag->id }}" action="{{ route('admin.meta-tags.destroy', $metaTag) }}" method="POST" class="hidden">
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
						{{ $metaTags->links() }}
					</div>
				@else
					<div class="text-center py-12">
						<i class="fas fa-tags text-4xl text-gray-300 mb-3"></i>
						<p class="text-gray-500 mb-4">No meta tags found.</p>
						<a href="{{ route('admin.meta-tags.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary">
							<i class="fas fa-plus"></i>
							<span>Create your first meta tag</span>
						</a>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<script>
function confirmDelete(id, title) {
	if (confirm(`Are you sure you want to delete the meta tag for "${title}"?`)) {
		document.getElementById('delete-form-' + id).submit();
	}
}
</script>
@endsection
