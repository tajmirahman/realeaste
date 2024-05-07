<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    // All Type
    public function AllType()
    {
        $type = Type::latest()->get();
        return view('backend.type.all_type',compact('type'));
    }

    // Add Type
    public function AddType()
    {
        return view('backend.type.add_type');
    }

    // Store Type
    public function StoreType(Request $request)
    {
        Type::insert([

            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
            'created_at' => now(),

        ]);

        $notification = array(
            'message' => 'Property Type Added Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.type')->with($notification);
    }

    // Edit Type
    public function EditType($id)
    {
        $type = Type::find($id);
        return view('backend.type.edit_type',compact('type'));
    }

    // Update Type
    public function UpdateType(Request $request)
    {
        $uid = $request->id;

        Type::findOrFail($uid)->update([

            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,

        ]);

        $notification = array(
            'message' => 'Property Type Update Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.type')->with($notification);
    }

    // Delete Type
    public function DeleteType($id)
    {
        Type::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Property Type Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.type')->with($notification);
    }
}
