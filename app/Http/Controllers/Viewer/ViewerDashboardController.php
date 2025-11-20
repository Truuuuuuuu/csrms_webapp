<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;

class ViewerDashboardController extends Controller
{
    public function index()
    {
        return view('viewer.viewer_dashboard'); 
    }
}
