<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

class editProfileController extends Controller
{
    public function index($id)
    {
        return view("dashboard.editProfile", ["user" => User::findOrFail($id)]);
    }

    /**
     * @throws \Safe\Exceptions\FilesystemException
     */
    public function updateProfile(Request $request, $id)
    {
        $request->validate(
            [
                "name" => "required|regex:/^[a-zA-Z ]+$/|min:3|max:50",
                "email" => "required|email",
                'oldPassword' => ['required'],
                'newPassword' => ['required', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()],
                "profileImage" => ['image', 'max:512'],

            ]
        );
//         profile image before update
        $user = User::findOrFail($id);
        $hashPassword = $user->password;
        $requestPassword = $request->oldPassword;
        if (!Hash::check($requestPassword, $hashPassword)) {
            return back()->with('notMatch', "Please enter Valid Old Password");
        } else {
            $newProfileImage = $request->profileImage;
            $ext = $newProfileImage->getClientOriginalExtension();
            $newName = Str::random() . '.' . Auth::id() . '.' . $ext;
            $imgFolder = public_path('assets/dist/upload/');
            if (!File::exists($imgFolder)) {
                File::makeDirectory($imgFolder, 0777, true, true);
            }
            if ($user->profileImage !== "default.png") {
                $deletePath = public_path('assets/dist/upload/' . $user->profileImage);
                unlink($deletePath);

            }
            Image::make($newProfileImage)->save(public_path('assets/dist/upload/' . $newName));
            $request->user()->fill([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->newPassword),
                'profileImage' => $newName

            ])->save();
        }
        return back()->with('success', 'Profile Update Successfully');


    }
}
