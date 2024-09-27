<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function view_users() {
        return view('managers.view-users');
    }
}
