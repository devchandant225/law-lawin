<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicationTeamController extends Controller
{
    /**
     * Show team members associated with a publication.
     */
    public function index(Publication $publication)
    {
        $teams = $publication->teams()->with('teams')->paginate(10);
        
        return view('admin.publications.teams.index', compact('publication', 'teams'));
    }

    /**
     * Show form for selecting team members to associate with publication.
     */
    public function create(Publication $publication, Request $request)
    {
        $query = Team::active()->ordered();
        
        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('designation', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $teams = $query->paginate(15);
        
        // Get already associated team IDs for this publication
        $associatedTeamIds = $publication->teams()->pluck('teams.id')->toArray();
        
        // Predefined roles
        $roles = [
            'Author' => 'Author',
            'Co-Author' => 'Co-Author', 
            'Editor' => 'Editor',
            'Reviewer' => 'Reviewer',
            'Contributor' => 'Contributor',
            'Research Lead' => 'Research Lead',
            'Data Analyst' => 'Data Analyst',
            'Supervisor' => 'Supervisor'
        ];

        return view('admin.publications.teams.create', compact(
            'publication', 
            'teams', 
            'associatedTeamIds', 
            'roles'
        ));
    }

    /**
     * Associate team members with a publication.
     */
    public function store(Request $request, Publication $publication)
    {
        $request->validate([
            'team_members' => 'required|array',
            'team_members.*' => 'exists:teams,id',
            'roles' => 'nullable|array',
            'roles.*' => 'nullable|string|max:100'
        ]);

        $teamMembers = $request->team_members;
        $roles = $request->roles ?? [];

        // Prepare data for sync with roles
        $syncData = [];
        foreach ($teamMembers as $teamId) {
            $syncData[$teamId] = [
                'role' => $roles[$teamId] ?? null,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Attach new team members (only if not already associated)
        foreach ($syncData as $teamId => $data) {
            if (!$publication->hasTeamMember($teamId)) {
                $publication->teams()->attach($teamId, $data);
            }
        }

        $count = count($teamMembers);
        
        return redirect()->route('admin.publications.teams.create', $publication)
                        ->with('success', "Successfully associated {$count} team member(s) with this publication.");
    }

    /**
     * Remove a team member from publication.
     */
    public function destroy(Publication $publication, Team $team)
    {
        if ($publication->hasTeamMember($team->id)) {
            $publication->teams()->detach($team->id);
            
            return response()->json([
                'success' => true,
                'message' => 'Team member removed from publication successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Team member is not associated with this publication.'
        ], 404);
    }

    /**
     * Update team member's role in publication.
     */
    public function updateRole(Request $request, Publication $publication, Team $team)
    {
        $request->validate([
            'role' => 'nullable|string|max:100'
        ]);

        if ($publication->hasTeamMember($team->id)) {
            $publication->teams()->updateExistingPivot($team->id, [
                'role' => $request->role,
                'updated_at' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Team member role updated successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Team member is not associated with this publication.'
        ], 404);
    }

    /**
     * Show team members for a specific publication (AJAX endpoint).
     */
    public function getTeamMembers(Publication $publication)
    {
        $teamMembers = $publication->getTeamMembersWithRoles();
        
        return response()->json([
            'success' => true,
            'team_members' => $teamMembers,
            'count' => $teamMembers->count()
        ]);
    }

    /**
     * Bulk remove team members from publication.
     */
    public function bulkRemove(Request $request, Publication $publication)
    {
        $request->validate([
            'team_ids' => 'required|array',
            'team_ids.*' => 'exists:teams,id'
        ]);

        $removedCount = 0;
        foreach ($request->team_ids as $teamId) {
            if ($publication->hasTeamMember($teamId)) {
                $publication->teams()->detach($teamId);
                $removedCount++;
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully removed {$removedCount} team member(s) from this publication.",
            'removed_count' => $removedCount
        ]);
    }
}
