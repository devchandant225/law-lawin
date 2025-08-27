@extends('layouts.admin')

@section('title', 'Contact Submissions')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
	<div>
		<div class="flex items-center justify-between mb-6">
			<h1 class="text-2xl font-bold text-gray-900">Contact Submissions</h1>
			<div class="flex items-center gap-3">
				<a href="{{ route('admin.contacts.export', request()->query()) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-primary text-primary hover:bg-purple-50 focus:ring-2 focus:ring-primary transition-colors">
					<i class="fas fa-download"></i>
					<span>Export CSV</span>
				</a>
			</div>
		</div>

		@if(session('success'))
			<div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3 flex items-start justify-between">
				<div>{{ session('success') }}</div>
				<button type="button" class="ml-4 text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">&times;</button>
			</div>
		@endif

		@if(session('error'))
			<div class="mb-4 rounded-lg border border-red-200 bg-red-50 text-red-800 px-4 py-3 flex items-start justify-between">
				<div>{{ session('error') }}</div>
				<button type="button" class="ml-4 text-red-700 hover:text-red-900" onclick="this.parentElement.remove()">&times;</button>
			</div>
		@endif

		<!-- Filters -->
		<div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
			<div class="p-4">
				<form method="GET" action="{{ route('admin.contacts.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
					<div>
						<label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
						<input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search name, email, subject..."
							class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
					</div>
					<div>
						<label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
						<input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
							class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
					</div>
					<div>
						<label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
						<input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}"
							class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
					</div>
					<div class="flex items-end gap-2">
						<button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-primary text-primary hover:bg-purple-50">Filter</button>
						<a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Clear</a>
					</div>
				</form>
			</div>
		</div>

		<!-- Statistics Cards -->
		<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
			<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
				<div class="flex items-center">
					<div class="flex-shrink-0">
						<div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
							<i class="fas fa-envelope text-blue-600"></i>
						</div>
					</div>
					<div class="ml-3">
						<p class="text-sm font-medium text-gray-500">Total Submissions</p>
						<p class="text-2xl font-semibold text-gray-900">{{ $contacts->total() }}</p>
					</div>
				</div>
			</div>
			<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
				<div class="flex items-center">
					<div class="flex-shrink-0">
						<div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
							<i class="fas fa-calendar-day text-green-600"></i>
						</div>
					</div>
					<div class="ml-3">
						<p class="text-sm font-medium text-gray-500">Today</p>
						<p class="text-2xl font-semibold text-gray-900">{{ $contacts->where('submitted_at', '>=', today())->count() }}</p>
					</div>
				</div>
			</div>
			<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
				<div class="flex items-center">
					<div class="flex-shrink-0">
						<div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
							<i class="fas fa-calendar-week text-purple-600"></i>
						</div>
					</div>
					<div class="ml-3">
						<p class="text-sm font-medium text-gray-500">This Week</p>
						<p class="text-2xl font-semibold text-gray-900">{{ $contacts->where('submitted_at', '>=', now()->startOfWeek())->count() }}</p>
					</div>
				</div>
			</div>
			<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
				<div class="flex items-center">
					<div class="flex-shrink-0">
						<div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
							<i class="fas fa-calendar-alt text-orange-600"></i>
						</div>
					</div>
					<div class="ml-3">
						<p class="text-sm font-medium text-gray-500">This Month</p>
						<p class="text-2xl font-semibold text-gray-900">{{ $contacts->where('submitted_at', '>=', now()->startOfMonth())->count() }}</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Contact Submissions Table -->
		<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
			<div class="p-0">
				@if($contacts->count() > 0)
					<div class="overflow-x-auto">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name & Email</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Submitted At</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Actions</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-100">
								@foreach($contacts as $contact)
									<tr>
										<td class="px-4 py-3">
											<div class="text-gray-900 font-medium">{{ $contact->name }}</div>
											<div class="text-sm text-gray-500">{{ $contact->email }}</div>
											@if($contact->phone)
												<div class="text-sm text-gray-500">{{ $contact->phone }}</div>
											@endif
										</td>
										<td class="px-4 py-3">
											<div class="text-gray-900 text-sm">{{ Str::limit($contact->subject, 40) }}</div>
										</td>
										<td class="px-4 py-3">
											<div class="text-gray-900 text-sm">{{ $contact->getMessagePreview(60) }}</div>
										</td>
										<td class="px-4 py-3 text-gray-700 text-sm">
											{{ $contact->submitted_at ? $contact->submitted_at->format('M d, Y') : '' }}<br>
											<span class="text-xs text-gray-400">{{ $contact->submitted_at ? $contact->submitted_at->format('g:i A') : '' }}</span>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center gap-2">
												<a href="{{ route('admin.contacts.show', $contact) }}" title="View Details" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
													<i class="fas fa-eye"></i>
												</a>
												<button type="button" title="Delete" onclick="confirmDelete('{{ $contact->id }}', '{{ addslashes($contact->name) }}')" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
													<i class="fas fa-trash"></i>
												</button>
												<form id="delete-form-{{ $contact->id }}" action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="hidden">
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
						{{ $contacts->appends(request()->query())->links() }}
					</div>
				@else
					<div class="text-center py-12">
						<i class="fas fa-envelope-open text-4xl text-gray-300 mb-3"></i>
						<p class="text-gray-500 mb-4">No contact submissions found.</p>
						@if(request()->hasAny(['search', 'date_from', 'date_to']))
							<a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
								<i class="fas fa-filter"></i>
								<span>Clear filters</span>
							</a>
						@endif
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<script>
function confirmDelete(contactId, contactName) {
    if (confirm('Are you sure you want to delete the contact submission from "' + contactName + '"? This action cannot be undone.')) {
        document.getElementById('delete-form-' + contactId).submit();
    }
}
</script>
@endsection
