<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //Admin Dashboard
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    //Admin Login
    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    //Admin Logout
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(

            'message' => 'Logout Successfully',
            'alert-type' => 'info',

        );

        return redirect()->route('admin.login')->with($notification);
    }

    //Admin Profile
    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_profile', compact('profileData'));
    }

    //AdminProfileUpdate

    public function AdminProfileUpdate(Request $request)
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
            @unlink(public_path('upload/admin_images/' . $update->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images/'), $filename);
            $update['photo'] = $filename;
        }

        $update->save();

        $notification = array(
            'message' => 'Profile Update Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    //Admin Password
    public function AdminPassword()
    {
        return view('admin.admin_password');
    }

    //Admin Password Update
    public function AdminPasswordUpdate(Request $request)
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

    // Agent manage

    public function AllAgent()
    {
        $agent = User::where('role','agent')->latest()->get();
        return view('backend.agent.all_agent',compact('agent'));
    }

    // Inactive Agent

    public function InactiveAgent($id)
    {
        User::find($id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Agent Inactive Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    // Active Agent

    public function ActiveAgent($id)
    {
        User::find($id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Agent Active Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    // Delete Agent

    public function DeleteAgent($id)
    {
        User::find($id)->delete();

        $notification = array(
            'message' => 'Agent Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }


    /// Admin Manage //////////

    // All Admin
    public function AllAdmin()
    {
        $profileData = User::where('role','admin')->get();
        return view('backend.admin.all_admin',compact('profileData'));
    }

    // Add Admin
    public function AddAdmin()
    {
        $role = Role::all();
        return view('backend.admin.add_admin',compact('role'));
    }

    // Store Admin
    public function StoreAdmin(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';

        $user->save();

        if($request->roles)
        {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'Multi Admin Added Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.admin')->with($notification);
    }

    // Edit Admin
    public function EditAdmin($id)
    {
        $user = User::findOrFail($id);
        $role = Role::all();
        return view('backend.admin.edit_admin',compact('role','user'));
    }

    // Store Admin
    public function UpdateAdmin(Request $request,$id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = 'admin';
        $user->status = 'active';

        $user->save();

        $user->roles()->detach();
        if($request->roles)
        {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'Multi Admin Update Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.admin')->with($notification);
    }

    // Delete Admin
    public function DeleteAdmin($id)
    {
        $user = User::findOrFail($id);
        if(!is_null($user))
        {
            $user->delete();
        }

        $notification = array(
            'message' => 'Multi Admin Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.admin')->with($notification);

    }

}
