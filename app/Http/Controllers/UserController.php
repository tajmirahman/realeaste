<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    //User Dashboard
    public function UserDashboard()
    {
        return view('dashboard');
    }

    //Admin Logout
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(

            'message' => 'Logout Successfully',
            'alert-type' => 'info',

        );

        return redirect()->route('index')->with($notification);
    }

    //User Profile
    public function UserProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('frontend.dashboard.user_profile', compact('profileData'));
    }

    //AdminProfileUpdate

    public function UserProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $update = User::findOrFail($id);

        $update->name = $request->name;
        $update->username = $request->username;
        $update->email = $request->email;
        $update->phone = $request->phone;
        $update->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $update->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images/'), $filename);
            $update['photo'] = $filename;
        }

        $update->save();

        $notification = array(
            'message' => 'Profile Update Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('user.profile')->with($notification);
    }

    //User Password
    public function UserPassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.user_password',compact('profileData'));
    }

    //User Password Update
    public function UserPasswordUpdate(Request $request)
    {
        //validate
        $request->validate([

            'old_password' => 'required',
            'new_password' => [

                'required', 'confirmed', Rules\Password::min(8)->mixedCase()->symbols()->letters()->numbers()

            ],
        ]);

        //Match Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Not Match',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        //Update New Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
