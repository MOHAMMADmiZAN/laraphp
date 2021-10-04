<?php

namespace App\Http\Controllers;

class DashBoardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.dashboard');
    }
}
