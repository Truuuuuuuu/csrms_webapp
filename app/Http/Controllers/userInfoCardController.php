<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserInfoCardController extends Component
{
    public $username;
    public $role;

    public function __construct($username = null, $role = null)
    {
        // Use current user if values are not provided
        $this->username = $username ?? auth()->user()->username;
        $this->role = $role ?? auth()->user()->role;
    }

    public function render()
    {
        return view('components.user-info-card');
    }
}
