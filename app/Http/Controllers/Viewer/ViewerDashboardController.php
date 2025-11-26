<?php

namespace App\Http\Controllers\Viewer;
use App\Http\Controllers\Controller;
use App\Models\StudentRecord;

class ViewerDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // Get username
        $currentUsername = $user->username;
        // Fetch all student records, paginated
        $records = StudentRecord::orderBy('updated_at', 'desc')->paginate(10);

        // Pass records to the viewer dashboard
        return view('viewer.viewer_dashboard', compact('records', 'currentUsername'));
    }
}
