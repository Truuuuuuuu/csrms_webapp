<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;

class EditorDashboardController extends Controller
{
    public function index()
    {
        return view('editor.editor_dashboard'); 
    }
}
