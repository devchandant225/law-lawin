@extends('layouts.admin')

@section('title', 'Publications Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
	<div>
		<div class="flex items-center justify-between mb-6">
			<div>
				<h1 class="text-2xl font-bold text-gray-900">Publications Management</h1>
				<p class="text-gray-600 mt-1">Manage both regular publications and more publications</p>
			</div>
			<div class="flex items-center gap-2">
				<a href="{{ route('admin.publications.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors">
					<i class="fas fa-plus"></i>
					<span>Create New Publication</span>
				</a>
				<!-- Quick Links for Post Types -->
				<div class="flex items-center gap-2 ml-4 border-l border-gray-300 pl-4">
					<a href="{{ route('admin.publications.index', ['post_type' => 'publication']) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm {{ request('post_type') == 'publication' ? 'bg-blue-100 text-blue-800' : 'text-gray-600 hover:bg-gray-100' }}">
						<i class="fas fa-file-alt"></i>
						<span>Publications ({{ \App\Models\Publication::publication()->count() }})</span>
					</a>
					<a href="{{ route('admin.publications.index', ['post_type' => 'more-publication']) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm {{ request('post_type') == 'more-publication' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-gray-100' }}">
						<i class="fas fa-plus-circle"></i>
						<span>More Publications ({{ \App\Models\Publication::morePublication()->count() }})</span>
					</a>
					<a href="{{ route('admin.publications.index', ['post_type' => 'service-location']) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm {{ request('post_type') == 'service-location' ? 'bg-green-100 text-green-800' : 'text-gray-600 hover:bg-gray-100' }}">
						<i class="fas fa-map-marker-alt"></i>
						<span>Service Locations ({{ \App\Models\Publication::serviceLocation()->count() }})</span>
					</a>
					<a href="{{ route('admin.publications.index', ['post_type' => 'language']) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm {{ request('post_type') == 'language' ? 'bg-orange-100 text-orange-800' : 'text-gray-600 hover:bg-gray-100' }}">
						<i class="fas fa-language"></i>
						<span>Languages ({{ \App\Models\Publication::language()->count() }})</span>
					</a>
				</div>
			</div>
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
				<form method="GET" action="{{ route('admin.publications.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
					<div>
						<label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
						<input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search publications..."
							class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
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
					<div>
						<label for="post_type" class="block text-sm font-medium text-gray-700 mb-1">Post Type</label>
						<select id="post_type" name="post_type" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
							<option value="">All Types</option>
							<option value="publication" {{ request('post_type') == 'publication' ? 'selected' : '' }}>Publication</option>
							<option value="more-publication" {{ request('post_type') == 'more-publication' ? 'selected' : '' }}>More Publication</option>
							<option value="service-location" {{ request('post_type') == 'service-location' ? 'selected' : '' }}>Service Location</option>
							<option value="language" {{ request('post_type') == 'language' ? 'selected' : '' }}>Language</option>
						</select>
					</div>
					<div class="flex items-end gap-2">
						<button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-primary text-primary hover:bg-purple-50">Filter</button>
						<a href="{{ route('admin.publications.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Clear</a>
					</div>
				</form>
			</div>
		</div>

		<!-- Publications Table -->
		<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
			<div class="p-0">
				@if($publications->count() > 0)
					<div class="overflow-x-auto">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Image</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">Order</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Post Type</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">Status</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Created</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Actions</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-100">
								@foreach($publications as $publication)
									<tr>
										<td class="px-4 py-3">
											@if($publication->feature_image)
												<img src="{{ $publication->feature_image_url }}" alt="{{ $publication->title }}" class="w-12 h-12 rounded object-cover">
											@else
												<div class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center">
													<i class="fas fa-image text-gray-400"></i>
												</div>
											@endif
										</td>
										<td class="px-4 py-3">
											<div class="text-gray-900 font-medium">{{ Str::limit($publication->title, 50) }}</div>
											@if($publication->excerpt)
												<div class="text-sm text-gray-500">{{ Str::limit($publication->excerpt, 80) }}</div>
											@endif
										</td>
										<td class="px-4 py-3">
											<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-800">{{ $publication->orderlist }}</span>
										</td>
										<td class="px-4 py-3">
											@php
												$postTypeBadgeClasses = [
													'publication' => 'bg-blue-100 text-blue-800',
													'more-publication' => 'bg-purple-100 text-purple-800',
													'service-location' => 'bg-green-100 text-green-800',
													'language' => 'bg-orange-100 text-orange-800'
												][$publication->post_type] ?? 'bg-gray-100 text-gray-800';
											@endphp
											<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $postTypeBadgeClasses }}">{{ ucfirst(str_replace('-', ' ', $publication->post_type)) }}</span>
										</td>
										<td class="px-4 py-3">
											@php
												$badgeClasses = [
													'active' => 'bg-green-100 text-green-800',
													'inactive' => 'bg-red-100 text-red-800',
													'draft' => 'bg-yellow-100 text-yellow-800'
												][$publication->status] ?? 'bg-gray-100 text-gray-800';
											@endphp
											<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $badgeClasses }}">{{ ucfirst($publication->status) }}</span>
										</td>
										<td class="px-4 py-3 text-gray-700 text-sm">{{ $publication->created_at->format('M d, Y') }}</td>
										<td class="px-4 py-3">
											<div class="flex items-center gap-2">
												<a href="{{ route('admin.publications.show', $publication) }}" title="View" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
													<i class="fas fa-eye"></i>
												</a>
												<a href="{{ route('admin.publications.edit', $publication) }}" title="Edit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-primary text-primary hover:bg-purple-50">
													<i class="fas fa-edit"></i>
												</a>
												<a href="{{ route('admin.publications.table-of-contents.index', $publication) }}" title="Table of Contents" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-50">
													<i class="fas fa-list-ol"></i>
												</a>
												<a href="{{ route('admin.faqs.create', ['publication_id' => $publication->id]) }}" title="Add FAQ" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-green-300 text-green-600 hover:bg-green-50">
													<i class="fas fa-question-circle"></i>
												</a>
												<a href="{{ route('admin.publications.teams.create', $publication) }}" title="Manage Team Members" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-orange-300 text-orange-600 hover:bg-orange-50">
													<i class="fas fa-users"></i>
												</a>
												@if($publication->status === 'active')
													@php
														$liveUrls = [
															'publication' => '/publication/' . $publication->slug,
															'more-publication' => '/more-publication/' . $publication->slug,
															'service-location' => '/service-location/' . $publication->slug,
															'language' => '/language/' . $publication->slug
														];
														$liveUrl = $liveUrls[$publication->post_type] ?? '/publication/' . $publication->slug;
														$liveTitle = 'View Live ' . ucfirst(str_replace('-', ' ', $publication->post_type));
													@endphp
													<a href="{{ url($liveUrl) }}" title="{{ $liveTitle }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-emerald-300 text-emerald-600 hover:bg-emerald-50">
														<i class="fas fa-external-link-alt"></i>
													</a>
												@endif
												<button type="button" title="Delete" onclick="confirmDelete('{{ $publication->id }}', '{{ $publication->title }}')" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
													<i class="fas fa-trash"></i>
												</button>
												<form id="delete-form-{{ $publication->id }}" action="{{ route('admin.publications.destroy', $publication) }}" method="POST" class="hidden">
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
						{{ $publications->appends(request()->query())->links() }}
					</div>
				@else
					<div class="text-center py-12">
						<i class="fas fa-file-alt text-4xl text-gray-300 mb-3"></i>
						<p class="text-gray-500 mb-4">No publications found.</p>
						<a href="{{ route('admin.publications.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary">
							<i class="fas fa-plus"></i>
							<span>Create your first publication</span>
						</a>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<script>
function confirmDelete(publicationId, publicationTitle) {
    if (confirm('Are you sure you want to delete "' + publicationTitle + '"? This action cannot be undone.')) {
        document.getElementById('delete-form-' + publicationId).submit();
    }
}
</script>
@endsection
