<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableOfContentRequest;
use App\Models\Publication;
use App\Models\TableOfContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableOfContentController extends Controller
{
    /**
     * Display a listing of table of contents for a publication.
     */
    public function index(Publication $publication)
    {
        $tableOfContents = $publication->orderedTableOfContents()
                                     ->paginate(20);

        return view('admin.publications.table-of-contents.index', compact(
            'publication',
            'tableOfContents'
        ));
    }

    /**
     * Show the form for creating new table of contents.
     */
    public function create(Publication $publication)
    {
        return view('admin.publications.table-of-contents.create', compact('publication'));
    }

    /**
     * Store newly created table of contents in storage.
     */
    public function store(TableOfContentRequest $request, Publication $publication)
    {
        try {
            DB::beginTransaction();

            $tocItems = $request->validated()['toc_items'];
            $createdCount = 0;

            foreach ($tocItems as $index => $item) {
                $tableOfContent = new TableOfContent([
                    'title' => $item['title'],
                    'description' => $item['description'] ?? null,
                    'status' => $item['status'] ?? true,
                    'order_index' => TableOfContent::getNextOrderIndex($publication->id) + $index
                ]);

                $publication->tableOfContents()->save($tableOfContent);
                $createdCount++;
            }

            DB::commit();

            return redirect()
                ->route('admin.publications.table-of-contents.index', $publication)
                ->with('success', "Successfully created {$createdCount} table of contents item(s).");

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occurred while creating table of contents items.');
        }
    }

    /**
     * Display the specified table of content.
     */
    public function show(Publication $publication, TableOfContent $tableOfContent)
    {
        // Ensure the table of content belongs to the publication
        if ($tableOfContent->publication_id !== $publication->id) {
            abort(404);
        }

        return view('admin.publications.table-of-contents.show', compact(
            'publication',
            'tableOfContent'
        ));
    }

    /**
     * Show the form for editing the specified table of content.
     */
    public function edit(Publication $publication, TableOfContent $tableOfContent)
    {
        // Ensure the table of content belongs to the publication
        if ($tableOfContent->publication_id !== $publication->id) {
            abort(404);
        }

        return view('admin.publications.table-of-contents.edit', compact(
            'publication',
            'tableOfContent'
        ));
    }

    /**
     * Update the specified table of content in storage.
     */
    public function update(TableOfContentRequest $request, Publication $publication, TableOfContent $tableOfContent)
    {
        // Ensure the table of content belongs to the publication
        if ($tableOfContent->publication_id !== $publication->id) {
            abort(404);
        }

        try {
            $validated = $request->validated();
            $tableOfContent->update($validated);

            return redirect()
                ->route('admin.publications.table-of-contents.index', $publication)
                ->with('success', 'Table of contents item updated successfully.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occurred while updating the table of contents item.');
        }
    }

    /**
     * Remove the specified table of content from storage.
     */
    public function destroy(Publication $publication, TableOfContent $tableOfContent)
    {
        // Ensure the table of content belongs to the publication
        if ($tableOfContent->publication_id !== $publication->id) {
            return response()->json([
                'success' => false,
                'message' => 'Table of contents item not found.'
            ], 404);
        }

        try {
            $title = $tableOfContent->title;
            $tableOfContent->delete();

            return response()->json([
                'success' => true,
                'message' => "Table of contents item '{$title}' deleted successfully."
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the table of contents item.'
            ], 500);
        }
    }

    /**
     * Reorder table of contents items.
     */
    public function reorder(Request $request, Publication $publication)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*' => 'exists:table_of_contents,id'
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->items as $index => $tocId) {
                TableOfContent::where('id', $tocId)
                             ->where('publication_id', $publication->id)
                             ->update(['order_index' => $index + 1]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Table of contents items reordered successfully.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while reordering table of contents items.'
            ], 500);
        }
    }

    /**
     * Toggle the status of a table of content.
     */
    public function toggleStatus(Publication $publication, TableOfContent $tableOfContent)
    {
        // Ensure the table of content belongs to the publication
        if ($tableOfContent->publication_id !== $publication->id) {
            return response()->json([
                'success' => false,
                'message' => 'Table of contents item not found.'
            ], 404);
        }

        try {
            $tableOfContent->update(['status' => !$tableOfContent->status]);

            $status = $tableOfContent->status ? 'activated' : 'deactivated';

            return response()->json([
                'success' => true,
                'status' => $tableOfContent->status,
                'message' => "Table of contents item {$status} successfully."
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the status.'
            ], 500);
        }
    }

    /**
     * Bulk delete table of contents items.
     */
    public function bulkDelete(Request $request, Publication $publication)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:table_of_contents,id'
        ]);

        try {
            $deletedCount = TableOfContent::whereIn('id', $request->ids)
                                         ->where('publication_id', $publication->id)
                                         ->delete();

            return response()->json([
                'success' => true,
                'message' => "Successfully deleted {$deletedCount} table of contents item(s).",
                'deleted_count' => $deletedCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting table of contents items.'
            ], 500);
        }
    }
}
