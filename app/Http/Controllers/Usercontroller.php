<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.users.users_index', ['users' => $users]);
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
        return $us_arr = [$str, $user];

    }

    function edit_response(Request $request)
    {
        $user = User::whereId($request->id);
        $user->update(
            [
                "role" => $request->role,
            ]
        );
        return User::whereId($request->id)->first();


    }

    function user_delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();


    }
}
