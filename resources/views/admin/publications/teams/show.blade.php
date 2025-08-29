@extends('layouts.admin')

@section('title', 'Team Members Details - ' . $publication->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Team Members Details</h1>
                <p class="text-gray-600 mt-1">Publication: <span class="font-medium">{{ $publication->title }}</span></p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.publications.teams.create', $publication) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors">
                    <i class="fas fa-user-plus"></i>
                    <span>Add More Members</span>
                </a>
                <a href="{{ route('admin.publications.teams.index', $publication) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Team List</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3 flex items-start justify-between">
                <div>{{ session('success') }}</div>
                <button type="button" class="ml-4 text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        <!-- Team Members Details -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Team Members Information</h3>
                <p class="text-sm text-gray-600 mt-1">Total members assigned: {{ $teamMembers->count() }}</p>
            </div>

            @if($teamMembers->count() > 0)
                <div class="p-6">
                    <div class="space-y-6">
                        @foreach($teamMembers as $teamMember)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start gap-6">
                                    <!-- Profile Image -->
                                    <div class="flex-shrink-0">
                                        @if($teamMember->image_url)
                                            <img src="{{ $teamMember->image_url }}" alt="{{ $teamMember->name }}" 
                                                 class="w-20 h-20 rounded-full object-cover">
                                        @else
                                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400 text-2xl"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Member Info -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h4 class="text-xl font-semibold text-gray-900">{{ $teamMember->name }}</h4>
                                                @if($teamMember->designation)
                                                    <p class="text-gray-600 mt-1">{{ $teamMember->designation }}</p>
                                                @endif
                                                
                                                <!-- Role in Publication -->
                                                <div class="mt-2">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800 font-medium">
                                                        <i class="fas fa-user-tag mr-2"></i>
                                                        {{ $teamMember->pivot->role ?? 'Team Member' }}
                                                    </span>
                                                </div>

                                                <!-- Assignment Date -->
                                                <p class="text-sm text-gray-500 mt-2">
                                                    <i class="fas fa-calendar-plus mr-1"></i>
                                                    Assigned on: {{ $teamMember->pivot->created_at->format('M d, Y \a\t H:i A') }}
                                                </p>
                                            </div>

                                            <!-- Actions -->
                                            <div class="flex flex-col gap-2">
                                                <button type="button" 
                                                        onclick="editRole({{ $teamMember->id }}, '{{ $teamMember->pivot->role }}', '{{ $teamMember->name }}')"
                                                        class="inline-flex items-center gap-2 px-3 py-2 text-sm rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-50 transition-colors">
                                                    <i class="fas fa-edit"></i>
                                                    Edit Role
                                                </button>
                                                <button type="button" 
                                                        onclick="removeTeamMember({{ $teamMember->id }}, '{{ $teamMember->name }}')"
                                                        class="inline-flex items-center gap-2 px-3 py-2 text-sm rounded-lg border border-red-300 text-red-600 hover:bg-red-50 transition-colors">
                                                    <i class="fas fa-trash"></i>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Additional Info -->
                                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @if($teamMember->email)
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-envelope text-gray-400"></i>
                                                    <a href="mailto:{{ $teamMember->email }}" class="text-primary hover:text-primary/80">{{ $teamMember->email }}</a>
                                                </div>
                                            @endif
                                            @if($teamMember->phone)
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-phone text-gray-400"></i>
                                                    <a href="tel:{{ $teamMember->phone }}" class="text-gray-600">{{ $teamMember->phone }}</a>
                                                </div>
                                            @endif
                                        </div>

                                        @if($teamMember->tagline)
                                            <div class="mt-4">
                                                <p class="text-gray-700 italic">"{{ $teamMember->tagline }}"</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-users text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500 mb-4">No team members assigned to this publication yet.</p>
                    <a href="{{ route('admin.publications.teams.create', $publication) }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary">
                        <i class="fas fa-user-plus"></i>
                        <span>Add Team Members</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Role Edit Modal -->
<div id="roleEditModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4 text-center" id="modalTitle">Edit Team Member Role</h3>
            <form id="roleEditForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="roleSelect" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select id="roleSelect" name="role" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
                        <option value="Author">Author</option>
                        <option value="Co-Author">Co-Author</option>
                        <option value="Editor">Editor</option>
                        <option value="Reviewer">Reviewer</option>
                        <option value="Contributor">Contributor</option>
                        <option value="Research Lead">Research Lead</option>
                        <option value="Data Analyst">Data Analyst</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Team Member">Team Member</option>
                    </select>
                </div>
                <div class="flex items-center gap-3 justify-center">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-primary">
                        Update Role
                    </button>
                    <button type="button" onclick="closeRoleModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editRole(teamId, currentRole, teamName) {
    document.getElementById('modalTitle').textContent = `Edit Role for ${teamName}`;
    document.getElementById('roleSelect').value = currentRole;
    document.getElementById('roleEditForm').action = `{{ route('admin.publications.teams.update-role', [$publication, 'TEAM_ID']) }}`.replace('TEAM_ID', teamId);
    document.getElementById('roleEditModal').classList.remove('hidden');
}

function closeRoleModal() {
    document.getElementById('roleEditModal').classList.add('hidden');
}

function removeTeamMember(teamId, teamName) {
    if (confirm(`Are you sure you want to remove ${teamName} from this publication?`)) {
        fetch(`{{ route('admin.publications.teams.destroy', [$publication, 'TEAM_ID']) }}`.replace('TEAM_ID', teamId), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'An error occurred');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while removing the team member');
        });
    }
}

// Close modal when clicking outside
document.getElementById('roleEditModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRoleModal();
    }
});
</script>

@endsection
