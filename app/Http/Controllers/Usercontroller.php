<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public $admin_role = ['super-admin', 'admin', 'moderator'];
    public $user_role = ['user', 'member', 'admin', 'moderator'];

    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('dashboard.users.users_index', ['users' => $users, 'admin_role' => $this->admin_role]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $str = <<<EOD
            <div class="card mt-3 text-center">
             <div class="card-header bg-dark"><h1>User Edit</h1></div>
             <div class="card-body">
             <div class="form-group">
             <input type="text" id="us_name" value="$user->name" class="form-control" readonly>
             </div>
             <div class="form-group">
             <input type="text" id="us_role" class="form-control">
             </div>
             </div>
            EOD;
        return [$str, $user];

    }

    function edit_response(Request $request)
    {
        $user = User::whereId($request->id);
        if (in_array($request->role, $this->user_role) && $request->role != auth()->user()->role && $request->role != 'super-admin') {
            $user->update(
                [
                    "role" => $request->role,
                ]
            );
            return User::whereId($request->id)->first();
        } else {
            return back()->with('update_fail', 'Your Data Not Updated');
        }
    }

    function user_delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->role !== auth()->user()->role && $user->role != 'super-admin') {
            $user->delete();
        } else {
            return 'Not Dumped';
        }


    }
}
