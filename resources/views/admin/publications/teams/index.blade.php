@extends('layouts.admin')

@section('title', 'Team Members - ' . $publication->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Team Members</h1>
                <p class="text-gray-600 mt-1">Publication: <span class="font-medium">{{ $publication->title }}</span></p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.publications.teams.create', $publication) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors">
                    <i class="fas fa-user-plus"></i>
                    <span>Add Team Members</span>
                </a>
                <a href="{{ route('admin.publications.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Publications</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3 flex items-start justify-between">
                <div>{{ session('success') }}</div>
                <button type="button" class="ml-4 text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        <!-- Current Team Members -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Current Team Members ({{ $assignedTeamIds ? count($assignedTeamIds) : 0 }})</h3>
                    @if($assignedTeamIds && count($assignedTeamIds) > 0)
                        <button type="button" onclick="bulkRemove()" 
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-red-300 text-red-600 hover:bg-red-50 transition-colors">
                            <i class="fas fa-trash"></i>
                            <span>Remove All</span>
                        </button>
                    @endif
                </div>
            </div>

            @if($teams->count() > 0)
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($teams as $team)
                            <div class="team-member-card border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-200">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0">
                                        @if($team->image_url)
                                            <img src="{{ $team->image_url }}" alt="{{ $team->name }}" 
                                                 class="w-16 h-16 rounded-full object-cover">
                                        @else
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400 text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-lg font-medium text-gray-900 truncate">{{ $team->name }}</h4>
                                        @if($team->designation)
                                            <p class="text-sm text-gray-600 mt-1">{{ $team->designation }}</p>
                                        @endif
                                        @if($team->email)
                                            <p class="text-sm text-gray-500 mt-1">{{ $team->email }}</p>
                                        @endif

                                        <!-- Role Badge -->
                                        @php
                                            $teamMember = $publication->teams()->where('teams.id', $team->id)->first();
                                            $role = $teamMember ? $teamMember->pivot->role : 'Team Member';
                                        @endphp
                                        <div class="mt-3 flex items-center gap-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800 font-medium">
                                                <i class="fas fa-user-tag mr-1"></i>
                                                {{ $role }}
                                            </span>
                                        </div>

                                        <!-- Actions -->
                                        <div class="mt-4 flex items-center gap-2">
                                            <button type="button" 
                                                    onclick="editRole({{ $team->id }}, '{{ $role }}', '{{ $team->name }}')"
                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-50 transition-colors">
                                                <i class="fas fa-edit"></i>
                                                Edit Role
                                            </button>
                                            <button type="button" 
                                                    onclick="removeTeamMember({{ $team->id }}, '{{ $team->name }}')"
                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs rounded-lg border border-red-300 text-red-600 hover:bg-red-50 transition-colors">
                                                <i class="fas fa-trash"></i>
                                                Remove
                                            </button>
                                        </div>
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
        <div class="mt-3 text-center">
            <h3 class="text-lg font-medium text-gray-900 mb-4" id="modalTitle">Edit Team Member Role</h3>
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

function bulkRemove() {
    if (confirm('Are you sure you want to remove all team members from this publication?')) {
        const teamIds = @json($assignedTeamIds);
        
        fetch(`{{ route('admin.publications.teams.bulk-remove', $publication) }}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                team_ids: teamIds
            })
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
            alert('An error occurred while removing team members');
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

<style>
.team-member-card {
    transition: all 0.3s ease-in-out;
}

.team-member-card:hover {
    transform: translateY(-4px);
}
</style>

@endsection
