<?php

namespace App\Http\Controllers\Editor;

use App\Models\StudentRecord;
use App\Http\Controllers\Controller;

class EditorDashboardController extends Controller
{
    public function index()
    {
        $currentUsername = auth()->user()->username;
        $search = request('search');

        // Query builder
        $query = StudentRecord::orderBy('updated_at', 'desc');

        // Apply search filter
        if (!empty($search)) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        // Pagination with query string
        $records = $query->paginate(5)->withQueryString();

        return view('editor.editor_dashboard', compact('currentUsername', 'records'));
    }

}
