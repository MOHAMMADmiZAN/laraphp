<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('dashboard.users.users_index', ['users' => $users]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }
}
