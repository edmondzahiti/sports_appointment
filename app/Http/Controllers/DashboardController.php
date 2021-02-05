<?php

namespace App\Http\Controllers;

use App\Models\Event\Event;
use App\Models\Field\Field;
use App\Models\User\User;

class DashboardController extends Controller
{
    public function __construct() {
    }

    public function index() {
        $users = User::whereNull('deleted_at')->count();
        $fields = Field::count();
        $events = Event::whereNull('deleted_at')->count();

        return view('admin.dashboard', compact('users', 'fields', 'events'));
    }
}
