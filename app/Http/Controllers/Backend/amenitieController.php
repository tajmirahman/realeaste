<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenitie;
use Illuminate\Http\Request;

class amenitieController extends Controller
{
    // All Amenitie
    public function AllAmenitie()
    {
        $amenitie = Amenitie::latest()->get();
        return view('backend.amenitie.all_amenitie',compact('amenitie'));
    }

    // Add Amenitie
    public function AddAmenitie()
    {
        return view('backend.amenitie.add_amenitie');
    }

    // Store Amenitie
    public function StoreAmenitie(Request $request)
    {
        Amenitie::insert([

            'amenitie_name' => $request->amenitie_name,
            'created_at' => now(),

        ]);

        $notification = array(
            'message' => 'Amenitie Added Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.amenitie')->with($notification);
    }

    // Edit Amenitie
    public function EditAmenitie($id)
    {
        $amenitie = Amenitie::find($id);
        return view('backend.amenitie.edit_amenitie',compact('amenitie'));
    }

    // Update Amenitie
    public function UpdateAmenitie(Request $request)
    {
        $uid = $request->id;

        Amenitie::findOrFail($uid)->update([

            'amenitie_name' => $request->amenitie_name,

        ]);

        $notification = array(
            'message' => 'Amenitie Update Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.amenitie')->with($notification);
    }

    // Delete Amenitie
    public function DeleteAmenitie($id)
    {
        Amenitie::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Amenitie Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.amenitie')->with($notification);
    }
}
