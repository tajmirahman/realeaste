<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class StateController extends Controller
{
    // All State
    public function AllState()
    {
        $state = State::latest()->get();
        return view('backend.state.all_state', compact('state'));
    }

    // Add State
    public function AddState()
    {
        return view('backend.state.add_state');
    }

    // Store State
    public function StoreState(Request $request)
    {

        $image = $request->file('image');
        $name_gen = date('YmdHi') . '.' . $image->getClientOriginalName();
        Image::make($image)->resize(950, 950)->save('upload/state/' . $name_gen);
        $save_url = 'upload/state/' . $name_gen;

        State::insert([

            'state_name' => $request->state_name,
            'image' => $save_url,
            'created_at' => now(),

        ]);

        $notification = array(
            'message' => 'State Added Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.state')->with($notification);
    }

    // Edit Type
    public function EditState($id)
    {
        $state = State::find($id);
        return view('backend.state.edit_state', compact('state'));
    }

    // Update State
    public function UpdateState(Request $request)
    {
        $uid = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {

            $image = $request->file('image');
            $name_gen = date('YmdHi') . '.' . $image->getClientOriginalName();
            Image::make($image)->resize(950, 950)->save('upload/state/' . $name_gen);
            $save_url = 'upload/state/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            State::findOrFail($uid)->update([

                'state_name' => $request->state_name,
                'image' => $save_url,

            ]);

            $notification = array(
                'message' => 'State Update With Image Successfully',
                'alert-type' => 'info',
            );

            return redirect()->route('all.state')->with($notification);
        } else {
            State::findOrFail($uid)->update([

                'state_name' => $request->state_name,

            ]);

            $notification = array(
                'message' => 'State Update Without Image Successfully',
                'alert-type' => 'info',
            );

            return redirect()->route('all.state')->with($notification);
        }
    }

    // Delete State
    public function DeleteState($id)
    {
        $delImg = State::findOrFail($id);
        $delete = $delImg->image;
        unlink($delete);

        State::findOrFail($id)->delete();


        $notification = array(
            'message' => 'Property Type Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.state')->with($notification);
    }
}
