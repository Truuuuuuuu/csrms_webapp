<?php

namespace App\Http\Controllers\Viewer;
use App\Http\Controllers\Controller;
use App\Models\StudentRecord;

class ViewerDashboardController extends Controller
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
        // Pass records to the viewer dashboard
        return view('viewer.viewer_dashboard', compact('records', 'currentUsername'));
    }
}
