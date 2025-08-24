@extends('layouts.admin')

@section('title', 'About Us Content Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
	<div>
		<div class="flex items-center justify-between mb-6">
			<h1 class="text-2xl font-bold text-gray-900">About Us Content Management</h1>
			<a href="{{ route('admin.about-us-contents.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors">
				<i class="fas fa-plus"></i>
				<span>Create New Content Section</span>
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
				<form method="GET" action="{{ route('admin.about-us-contents.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
					<div>
						<label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
						<input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search content sections..."
							class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
					</div>
					<div>
						<label for="page_type" class="block text-sm font-medium text-gray-700 mb-1">Page Type</label>
						<select id="page_type" name="page_type" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
							<option value="">All Page Types</option>
							@foreach($pageTypeOptions as $key => $label)
								<option value="{{ $key }}" {{ request('page_type') == $key ? 'selected' : '' }}>
									{{ $label }}
								</option>
							@endforeach
						</select>
					</div>
					<div>
						<label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
						<select id="status" name="status" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
							<option value="">All Statuses</option>
							@foreach($statusOptions as $key => $label)
								<option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
									{{ $label }}
								</option>
							@endforeach
						</select>
					</div>
					<div class="flex items-end gap-2">
						<button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-primary text-primary hover:bg-purple-50">Filter</button>
						<a href="{{ route('admin.about-us-contents.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Clear</a>
					</div>
				</form>
			</div>
		</div>

		<!-- Content Sections Table -->
		<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
			<div class="p-0">
				@if($contentSections->count() > 0)
					<div class="overflow-x-auto">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Page Type</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">Status</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Order</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Created</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Actions</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-100">
								@foreach($contentSections as $contentSection)
									<tr>
										<td class="px-4 py-3">
											<div class="text-gray-900 font-medium">
												{{ $contentSection->title ?: 'No Title' }}
											</div>
											@if($contentSection->desc_1)
												<div class="text-sm text-gray-500">{!! Str::limit($contentSection->desc_1, 80) !!}</div>
											@endif
										</td>
										<td class="px-4 py-3">
											<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
												@if($contentSection->page_type === 'about-page') bg-blue-100 text-blue-800
												@elseif($contentSection->page_type === 'home-page') bg-purple-100 text-purple-800
												@else bg-gray-100 text-gray-800
												@endif">
												{{ $contentSection->page_type_label }}
											</span>
										</td>
										<td class="px-4 py-3">
											@php
												$badgeClasses = [
													'active' => 'bg-green-100 text-green-800',
													'inactive' => 'bg-red-100 text-red-800',
												][$contentSection->status] ?? 'bg-gray-100 text-gray-800';
											@endphp
											<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $badgeClasses }}">{{ $contentSection->status_label }}</span>
										</td>
										<td class="px-4 py-3 text-gray-700 text-sm">
											{{ $contentSection->order_list ?? '-' }}
										</td>
										<td class="px-4 py-3 text-gray-700 text-sm">{{ $contentSection->created_at->format('M d, Y') }}</td>
										<td class="px-4 py-3">
											<div class="flex items-center gap-2">
												<a href="{{ route('admin.about-us-contents.show', $contentSection) }}" title="View" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
													<i class="fas fa-eye"></i>
												</a>
												<a href="{{ route('admin.about-us-contents.edit', $contentSection) }}" title="Edit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-primary text-primary hover:bg-purple-50">
													<i class="fas fa-edit"></i>
												</a>
												<button type="button" title="Toggle Status" onclick="toggleStatus({{ $contentSection->id }})" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-50">
													<i class="fas fa-toggle-{{ $contentSection->status === 'active' ? 'on' : 'off' }}"></i>
												</button>
												<button type="button" title="Delete" onclick="confirmDelete('{{ $contentSection->id }}', '{{ addslashes($contentSection->title ?: 'Untitled Content') }}')" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
													<i class="fas fa-trash"></i>
												</button>
												<form id="delete-form-{{ $contentSection->id }}" action="{{ route('admin.about-us-contents.destroy', $contentSection) }}" method="POST" class="hidden">
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
						{{ $contentSections->appends(request()->query())->links() }}
					</div>
				@else
					<div class="text-center py-12">
						<i class="fas fa-file-alt text-4xl text-gray-300 mb-3"></i>
						<p class="text-gray-500 mb-4">No content sections found.</p>
						<a href="{{ route('admin.about-us-contents.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary">
							<i class="fas fa-plus"></i>
							<span>Create your first content section</span>
						</a>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<script>
function confirmDelete(contentSectionId, contentSectionTitle) {
    if (confirm('Are you sure you want to delete this content section: "' + contentSectionTitle + '"? This action cannot be undone.')) {
        document.getElementById('delete-form-' + contentSectionId).submit();
    }
}

async function toggleStatus(contentSectionId) {
    try {
        const response = await fetch(`/admin/about-us-contents/${contentSectionId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const data = await response.json();

        if (data.success) {
            // Reload the page to reflect the changes
            window.location.reload();
        } else {
            alert('Failed to toggle status. Please try again.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    }
}
</script>
@endsection
