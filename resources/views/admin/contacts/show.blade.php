@extends('layouts.admin')

@section('title', 'Contact Submission Details')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
	<div class="mb-6">
		<div class="flex items-center justify-between">
			<div>
				<nav class="flex" aria-label="Breadcrumb">
					<ol class="inline-flex items-center space-x-1 md:space-x-3">
						<li class="inline-flex items-center">
							<a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
								<i class="fas fa-home w-4 h-4 mr-2"></i>
								Dashboard
							</a>
						</li>
						<li>
							<div class="flex items-center">
								<i class="fas fa-chevron-right text-gray-400 w-4 h-4"></i>
								<a href="{{ route('admin.contacts.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Contact Submissions</a>
							</div>
						</li>
						<li aria-current="page">
							<div class="flex items-center">
								<i class="fas fa-chevron-right text-gray-400 w-4 h-4"></i>
								<span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $contact->name }}</span>
							</div>
						</li>
					</ol>
				</nav>
				<h1 class="mt-2 text-2xl font-bold text-gray-900">Contact Submission Details</h1>
			</div>
			<div class="flex items-center gap-3">
				<a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
					<i class="fas fa-arrow-left"></i>
					<span>Back to List</span>
				</a>
				<button type="button" onclick="confirmDelete()" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
					<i class="fas fa-trash"></i>
					<span>Delete</span>
				</button>
			</div>
		</div>
	</div>

	@if(session('success'))
		<div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3 flex items-start justify-between">
			<div>{{ session('success') }}</div>
			<button type="button" class="ml-4 text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">&times;</button>
		</div>
	@endif

	<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
		<!-- Main Content -->
		<div class="lg:col-span-2 space-y-6">
			<!-- Contact Information -->
			<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
				<div class="px-6 py-4 border-b border-gray-200">
					<h2 class="text-lg font-semibold text-gray-900">Contact Information</h2>
				</div>
				<div class="p-6 space-y-4">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
							<p class="text-gray-900">{{ $contact->name }}</p>
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
							<p class="text-gray-900">
								<a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800">
									{{ $contact->email }}
								</a>
							</p>
						</div>
					</div>
					@if($contact->phone)
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
							<p class="text-gray-900">
								<a href="tel:{{ $contact->phone }}" class="text-blue-600 hover:text-blue-800">
									{{ $contact->phone }}
								</a>
							</p>
						</div>
					@endif
				</div>
			</div>

			<!-- Message Content -->
			<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
				<div class="px-6 py-4 border-b border-gray-200">
					<h2 class="text-lg font-semibold text-gray-900">Subject & Message</h2>
				</div>
				<div class="p-6 space-y-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
						<p class="text-gray-900 font-medium">{{ $contact->subject }}</p>
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
						<div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
							<p class="text-gray-900 whitespace-pre-wrap">{{ $contact->message }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Sidebar -->
		<div class="space-y-6">
			<!-- Submission Details -->
			<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
				<div class="px-6 py-4 border-b border-gray-200">
					<h2 class="text-lg font-semibold text-gray-900">Submission Details</h2>
				</div>
				<div class="p-6 space-y-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Submitted At</label>
						<p class="text-gray-900">
							{{ $contact->submitted_at ? $contact->submitted_at->format('F j, Y') : 'N/A' }}
						</p>
						<p class="text-sm text-gray-500">
							{{ $contact->submitted_at ? $contact->submitted_at->format('g:i:s A') : '' }}
						</p>
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Time Ago</label>
						<p class="text-gray-900">
							{{ $contact->submitted_at ? $contact->submitted_at->diffForHumans() : 'N/A' }}
						</p>
					</div>
					@if($contact->ip_address)
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">IP Address</label>
							<p class="text-gray-900 font-mono text-sm">{{ $contact->ip_address }}</p>
						</div>
					@endif
				</div>
			</div>

			<!-- Technical Information -->
			@if($contact->user_agent)
				<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
					<div class="px-6 py-4 border-b border-gray-200">
						<h2 class="text-lg font-semibold text-gray-900">Technical Information</h2>
					</div>
					<div class="p-6">
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">User Agent</label>
							<p class="text-gray-900 text-sm break-all">{{ $contact->user_agent }}</p>
						</div>
					</div>
				</div>
			@endif

			<!-- Quick Actions -->
			<div class="bg-white border border-gray-200 rounded-xl shadow-sm">
				<div class="px-6 py-4 border-b border-gray-200">
					<h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
				</div>
				<div class="p-6 space-y-3">
					<a href="mailto:{{ $contact->email }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-50">
						<i class="fas fa-reply"></i>
						<span>Reply via Email</span>
					</a>
					@if($contact->phone)
						<a href="tel:{{ $contact->phone }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-green-300 text-green-600 hover:bg-green-50">
							<i class="fas fa-phone"></i>
							<span>Call</span>
						</a>
					@endif
					<button type="button" onclick="copyToClipboard('{{ $contact->email }}')" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">
						<i class="fas fa-copy"></i>
						<span>Copy Email</span>
					</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Delete Form -->
	<form id="delete-form" action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="hidden">
		@csrf
		@method('DELETE')
	</form>
</div>

<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete this contact submission from "{{ $contact->name }}"? This action cannot be undone.')) {
        document.getElementById('delete-form').submit();
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Create a temporary notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
        notification.textContent = 'Email copied to clipboard!';
        document.body.appendChild(notification);
        
        // Remove the notification after 3 seconds
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 3000);
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endsection
