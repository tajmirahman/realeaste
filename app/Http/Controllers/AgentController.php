<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AgentController extends Controller
{
    //Agent Dashboard
    public function AgentDashboard()
    {
        return view('agent.index');
    }

    //Agent Login
    public function AgentLogin()
    {
        return view('agent.agent_login');
    }

    //Agent Login
    public function AgentRegister(Request $request)

    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->symbols()->letters()->numbers()],
        ]);

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'inactive',
            'created_at' => now(),
        ]);

        $notification = array(
            'message' => 'Register Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('agent.login')->with($notification);
    }


    //Agent Logout
    public function AgentLogout(Request $request)
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

    //Agent Profile
    public function AgentProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('agent.agent_profile', compact('profileData'));
    }

    //AgentProfileUpdate

    public function AgentProfileUpdate(Request $request)
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
            @unlink(public_path('upload/agent_images/' . $update->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/agent_images/'), $filename);
            $update['photo'] = $filename;
        }

        $update->save();

        $notification = array(
            'message' => 'Profile Update Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('agent.profile')->with($notification);
    }

    //Agent Password
    public function AgentPassword()
    {
        return view('agent.agent_password');
    }

    //Agent Password Update
    public function AgentPasswordUpdate(Request $request)
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
