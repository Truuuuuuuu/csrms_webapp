<?php

namespace App\Http\Controllers\Editor;
use App\Models\User;
use App\Http\Controllers\Controller;

class EditorDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        //get username
        $currentUsername = $user->username;
        // Total users

        return view('editor.editor_dashboard', compact( 'currentUsername'));
    }
}
