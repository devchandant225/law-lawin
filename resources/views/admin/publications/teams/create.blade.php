@extends('layouts.admin')

@section('title', 'Manage Team Members - ' . $publication->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manage Team Members</h1>
                <p class="text-gray-600 mt-1">Publication: <span class="font-medium">{{ $publication->title }}</span></p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.publications.teams.index', $publication) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-list"></i>
                    <span>View Current Team</span>
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

        @if($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 text-red-800 px-4 py-3">
                <div class="font-medium">Please fix the following errors:</div>
                <ul class="mt-1 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Search and Filter -->
        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-4">
                <form method="GET" action="{{ route('admin.publications.teams.create', $publication) }}" class="flex gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Team Members</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" 
                               placeholder="Search by name, designation, or email..."
                               class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-primary text-primary hover:bg-purple-50">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                        <a href="{{ route('admin.publications.teams.create', $publication) }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Clear</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Team Selection Form -->
        <form method="POST" action="{{ route('admin.publications.teams.store', $publication) }}" id="teamAssignmentForm">
            @csrf
            
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Select Team Members</h3>
                        <div class="flex items-center gap-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-primary focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Select All</span>
                            </label>
                            <button type="submit" 
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="assignButton" disabled>
                                <i class="fas fa-user-plus"></i>
                                <span>Assign Selected Members</span>
                            </button>
                        </div>
                    </div>
                </div>

                @if($teams->count() > 0)
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($teams as $team)
                                <div class="team-card border border-gray-200 rounded-xl p-4 hover:border-primary/50 transition-colors {{ in_array($team->id, $associatedTeamIds) ? 'bg-green-50 border-green-200' : '' }}">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 mt-1">
                                            @if(!in_array($team->id, $associatedTeamIds))
                                                <input type="checkbox" name="team_members[]" value="{{ $team->id }}" 
                                                       class="team-checkbox rounded border-gray-300 text-primary focus:ring-primary">
                                            @else
                                                <div class="w-4 h-4 bg-green-500 rounded flex items-center justify-center">
                                                    <i class="fas fa-check text-white text-xs"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start gap-3">
                                                <div class="flex-shrink-0">
                                                    @if($team->image_url)
                                                        <img src="{{ $team->image_url }}" alt="{{ $team->name }}" 
                                                             class="w-12 h-12 rounded-full object-cover">
                                                    @else
                                                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-user text-gray-400"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="text-sm font-medium text-gray-900 truncate">{{ $team->name }}</h4>
                                                    @if($team->designation)
                                                        <p class="text-xs text-gray-600 mt-1">{{ $team->designation }}</p>
                                                    @endif
                                                    @if($team->email)
                                                        <p class="text-xs text-gray-500 mt-1">{{ $team->email }}</p>
                                                    @endif
                                                    
                                                    @if(in_array($team->id, $associatedTeamIds))
                                                        <div class="mt-2">
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-green-100 text-green-800">
                                                                <i class="fas fa-check mr-1"></i>
                                                                Already Assigned
                                                            </span>
                                                        </div>
                                                    @else
                                                        <!-- Role Selection -->
                                                        <div class="mt-3 role-selection" style="display: none;">
                                                            <label class="block text-xs font-medium text-gray-700 mb-1">Role:</label>
                                                            <select name="roles[{{ $team->id }}]" 
                                                                    class="block w-full text-xs rounded-md border-gray-300 focus:border-primary focus:ring-primary">
                                                                @foreach($roles as $roleKey => $roleValue)
                                                                    <option value="{{ $roleValue }}">{{ $roleKey }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($teams->hasPages())
                            <div class="mt-6 flex justify-center">
                                {{ $teams->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-users text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 mb-4">
                            @if(request('search'))
                                No team members found matching your search.
                            @else
                                No team members available.
                            @endif
                        </p>
                        @if(!request('search'))
                            <a href="{{ route('admin.teams.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary">
                                <i class="fas fa-plus"></i>
                                <span>Create Team Member</span>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const teamCheckboxes = document.querySelectorAll('.team-checkbox');
    const assignButton = document.getElementById('assignButton');
    const roleSelections = document.querySelectorAll('.role-selection');

    // Handle select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        teamCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
            toggleRoleSelection(checkbox);
        });
        updateAssignButtonState();
    });

    // Handle individual checkbox changes
    teamCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            toggleRoleSelection(this);
            updateSelectAllState();
            updateAssignButtonState();
        });
    });

    // Function to toggle role selection visibility
    function toggleRoleSelection(checkbox) {
        const card = checkbox.closest('.team-card');
        const roleSelection = card.querySelector('.role-selection');
        
        if (checkbox.checked) {
            roleSelection.style.display = 'block';
            card.classList.add('border-primary', 'bg-primary/5');
        } else {
            roleSelection.style.display = 'none';
            card.classList.remove('border-primary', 'bg-primary/5');
        }
    }

    // Update select all checkbox state
    function updateSelectAllState() {
        const checkedCount = document.querySelectorAll('.team-checkbox:checked').length;
        const totalCount = teamCheckboxes.length;
        
        if (checkedCount === 0) {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
        } else if (checkedCount === totalCount) {
            selectAllCheckbox.checked = true;
            selectAllCheckbox.indeterminate = false;
        } else {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = true;
        }
    }

    // Update assign button state
    function updateAssignButtonState() {
        const checkedCount = document.querySelectorAll('.team-checkbox:checked').length;
        assignButton.disabled = checkedCount === 0;
        
        if (checkedCount === 0) {
            assignButton.innerHTML = '<i class="fas fa-user-plus"></i><span>Assign Selected Members</span>';
        } else {
            assignButton.innerHTML = `<i class="fas fa-user-plus"></i><span>Assign ${checkedCount} Member${checkedCount > 1 ? 's' : ''}</span>`;
        }
    }

    // Form submission confirmation
    document.getElementById('teamAssignmentForm').addEventListener('submit', function(e) {
        const checkedCount = document.querySelectorAll('.team-checkbox:checked').length;
        if (checkedCount === 0) {
            e.preventDefault();
            alert('Please select at least one team member to assign.');
            return;
        }

        const confirmMessage = `Are you sure you want to assign ${checkedCount} team member${checkedCount > 1 ? 's' : ''} to this publication?`;
        if (!confirm(confirmMessage)) {
            e.preventDefault();
        }
    });
});
</script>

<style>
.team-card {
    transition: all 0.2s ease-in-out;
}

.team-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.role-selection {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

@endsection
