<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpDeskController extends Controller
{
    /**
     * Display NRN Legal Help Desk page
     */
    public function nrnLegal()
    {
        return view('help-desk.nrn-legal', [
            'title' => 'NRN Legal Help Desk',
            'description' => 'Legal assistance and support for Non-Resident Nepalis'
        ]);
    }

    /**
     * Display FDI Legal Help Desk page
     */
    public function fdiLegal()
    {
        return view('help-desk.fdi-legal', [
            'title' => 'FDI Legal Help Desk',
            'description' => 'Legal assistance and support for Foreign Direct Investment'
        ]);
    }
}
