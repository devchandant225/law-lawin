@extends('layouts.admin')

@section('title', 'View Team Member')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Team Member Details</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.teams.edit', $team) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700">
                    <i class="fas fa-edit"></i>
                    <span>Edit Member</span>
                </a>
                <a href="{{ route('admin.teams.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Team</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Basic Information</h5>
                    </div>
                    <div class="p-4">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $team->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Slug</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-mono bg-gray-50 px-2 py-1 rounded">{{ $team->slug }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($team->email)
                                        <a href="mailto:{{ $team->email }}" class="text-indigo-600 hover:underline">{{ $team->email }}</a>
                                    @else
                                        <span class="text-gray-400">Not provided</span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($team->phone)
                                        <a href="tel:{{ $team->phone }}" class="text-indigo-600 hover:underline">{{ $team->phone }}</a>
                                    @else
                                        <span class="text-gray-400">Not provided</span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Designation</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $team->designation ?? 'Not specified' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Display Order</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-800">{{ $team->orderlist }}</span>
                                </dd>
                            </div>
                        </dl>

                        @if($team->tagline)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <dt class="text-sm font-medium text-gray-500">Tagline</dt>
                                <dd class="mt-1 text-sm text-gray-900 italic">{{ $team->tagline }}</dd>
                            </div>
                        @endif

                        @if($team->description)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <dt class="text-sm font-medium text-gray-500">Description</dt>
                                <dd class="mt-1 text-sm text-gray-900 prose max-w-none">{!! nl2br(e($team->description)) !!}</dd>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Professional Information -->
                @if($team->experience || $team->qualification || $team->additional_details)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Professional Information</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            @if($team->experience)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 mb-2">Experience</dt>
                                    <dd class="text-sm text-gray-900 prose max-w-none">{!! nl2br(e($team->experience)) !!}</dd>
                                </div>
                            @endif

                            @if($team->qualification)
                                <div class="pt-4 border-t border-gray-100">
                                    <dt class="text-sm font-medium text-gray-500 mb-2">Qualification</dt>
                                    <dd class="text-sm text-gray-900 prose max-w-none">{!! nl2br(e($team->qualification)) !!}</dd>
                                </div>
                            @endif

                            @if($team->additional_details)
                                <div class="pt-4 border-t border-gray-100">
                                    <dt class="text-sm font-medium text-gray-500 mb-2">Additional Details</dt>
                                    <dd class="text-sm text-gray-900 prose max-w-none">{!! nl2br(e($team->additional_details)) !!}</dd>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Social Links -->
                @if($team->linkedinlink || $team->facebooklink)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Social Links</h5>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if($team->linkedinlink)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">LinkedIn</dt>
                                        <dd class="mt-1">
                                            <a href="{{ $team->linkedinlink }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-indigo-600 hover:underline">
                                                <i class="fab fa-linkedin"></i>
                                                View LinkedIn Profile
                                            </a>
                                        </dd>
                                    </div>
                                @endif

                                @if($team->facebooklink)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Facebook</dt>
                                        <dd class="mt-1">
                                            <a href="{{ $team->facebooklink }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-indigo-600 hover:underline">
                                                <i class="fab fa-facebook"></i>
                                                View Facebook Profile
                                            </a>
                                        </dd>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- SEO Information -->
                @if($team->metatitle || $team->metadescription || $team->metakeywords)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">SEO Settings</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            @if($team->metatitle)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Meta Title</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $team->metatitle }}</dd>
                                </div>
                            @endif

                            @if($team->metadescription)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Meta Description</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $team->metadescription }}</dd>
                                </div>
                            @endif

                            @if($team->metakeywords)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Meta Keywords</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $team->metakeywords }}</dd>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Google Schema -->
                @if($team->googleschema)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Google Schema (JSON-LD)</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-gray-50 rounded-lg p-4 text-xs overflow-x-auto"><code>{{ $team->google_schema_json }}</code></pre>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Status & Actions -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Status & Actions</h5>
                    </div>
                    <div class="p-4 space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                @php
                                    $badgeClasses = [
                                        'active' => 'bg-green-100 text-green-800',
                                        'inactive' => 'bg-red-100 text-red-800',
                                        'draft' => 'bg-yellow-100 text-yellow-800'
                                    ][$team->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs {{ $badgeClasses }}">
                                    {{ ucfirst($team->status) }}
                                </span>
                            </dd>
                        </div>

                        <div class="flex flex-col gap-2 pt-4 border-t border-gray-200">
                            <a href="{{ route('admin.teams.edit', $team) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700">
                                <i class="fas fa-edit"></i>
                                <span>Edit Member</span>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ $team->id }}', '{{ $team->name }}')" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
                                <i class="fas fa-trash"></i>
                                <span>Delete Member</span>
                            </button>
                            <form id="delete-form-{{ $team->id }}" action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Profile Image -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Profile Image</h5>
                    </div>
                    <div class="p-4">
                        @if($team->image)
                            <img src="{{ $team->image_url }}" alt="{{ $team->name }}" class="w-full rounded-lg border border-gray-200">
                        @else
                            <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-user text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-500">No profile image</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Member Information -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Information</h5>
                    </div>
                    <div class="p-4">
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Created</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $team->created_at->format('M d, Y \a\t g:i A') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $team->updated_at->format('M d, Y \a\t g:i A') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Public URL</dt>
                                <dd class="mt-1 text-sm">
                                    <a href="{{ url('/team/' . $team->slug) }}" target="_blank" class="text-indigo-600 hover:underline break-all">
                                        {{ url('/team/' . $team->slug) }}
                                    </a>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(teamId, teamName) {
    if (confirm('Are you sure you want to delete "' + teamName + '"? This action cannot be undone.')) {
        document.getElementById('delete-form-' + teamId).submit();
    }
}
</script>
@endsection
