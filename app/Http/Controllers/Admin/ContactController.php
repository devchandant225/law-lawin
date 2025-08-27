<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of contact submissions.
     */
    public function index(Request $request)
    {
        $query = Contact::query()->latest('submitted_at');

        // Filter by search term
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter by date range
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('submitted_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('submitted_at', '<=', $request->date_to);
        }

        $contacts = $query->paginate(20);

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified contact submission.
     */
    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified contact submission from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact submission deleted successfully.');
    }

    /**
     * Export contact submissions to CSV.
     */
    public function export(Request $request)
    {
        $query = Contact::query()->latest('submitted_at');

        // Apply same filters as index
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('submitted_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('submitted_at', '<=', $request->date_to);
        }

        $contacts = $query->get();

        $filename = 'contact_submissions_' . now()->format('Y_m_d_H_i_s') . '.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Phone',
                'Subject',
                'Message',
                'Submitted At',
                'IP Address',
                'User Agent'
            ]);

            // Add contact data
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->subject,
                    $contact->message,
                    $contact->submitted_at ? $contact->submitted_at->format('Y-m-d H:i:s') : '',
                    $contact->ip_address,
                    $contact->user_agent
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get dashboard statistics for contact submissions.
     */
    public function getStats()
    {
        $totalContacts = Contact::count();
        $todayContacts = Contact::whereDate('submitted_at', today())->count();
        $thisWeekContacts = Contact::whereBetween('submitted_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();
        $thisMonthContacts = Contact::whereMonth('submitted_at', now()->month)
            ->whereYear('submitted_at', now()->year)
            ->count();

        return [
            'total' => $totalContacts,
            'today' => $todayContacts,
            'this_week' => $thisWeekContacts,
            'this_month' => $thisMonthContacts
        ];
    }
}
