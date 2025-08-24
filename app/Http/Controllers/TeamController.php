<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of team members.
     */
    public function index()
    {
        $teams = Team::active()->ordered()->get();
        return view('team.index', compact('teams'));
    }

    /**
     * Display the specified team member.
     */
    public function show(Team $team)
    {
        // Only show active team members
        if ($team->status !== 'active') {
            abort(404);
        }

        return view('team.show', compact('team'));
    }
}
