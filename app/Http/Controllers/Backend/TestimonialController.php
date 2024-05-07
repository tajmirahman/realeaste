<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    // All Testimonial
    public function AllTestimonial()
    {
        $testimonial = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonial', compact('testimonial'));
    }

    // Add Testimonial
    public function AddTestimonial()
    {
        return view('backend.testimonial.add_testimonial');
    }

    // Store Testimonial
    public function StoreTestimonial(Request $request)
    {

        $image = $request->file('image');
        $name_gen = date('YmdHi') . '.' . $image->getClientOriginalName();
        Image::make($image)->resize(100, 100)->save('upload/testimonial/' . $name_gen);
        $save_url = 'upload/testimonial/' . $name_gen;

        Testimonial::insert([

            'name' => $request->name,
            'position' => $request->position,
            'description' => $request->description,
            'image' => $save_url,
            'created_at' => now(),

        ]);

        $notification = array(
            'message' => 'Testimonial Added Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.testimonial')->with($notification);
    }

    // Edit Testimonial
    public function EditTestimonial($id)
    {
        $testimonial = Testimonial::find($id);
        return view('backend.testimonial.edit_testimonial', compact('testimonial'));
    }

    // Update Testimonial
    public function UpdateTestimonial(Request $request)
    {
        $uid = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {

            $image = $request->file('image');
            $name_gen = date('YmdHi') . '.' . $image->getClientOriginalName();
            Image::make($image)->resize(100, 100)->save('upload/testimonial/' . $name_gen);
            $save_url = 'upload/testimonial/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Testimonial::findOrFail($uid)->update([

                'name' => $request->name,
                'position' => $request->position,
                'description' => $request->description,
                'image' => $save_url,

            ]);

            $notification = array(
                'message' => 'Testimonial Update With Image Successfully',
                'alert-type' => 'info',
            );

            return redirect()->route('all.testimonial')->with($notification);
        } else {
            Testimonial::findOrFail($uid)->update([

                'name' => $request->name,
                'position' => $request->position,
                'description' => $request->description,

            ]);

            $notification = array(
                'message' => 'Testimonial Update Without Image Successfully',
                'alert-type' => 'info',
            );

            return redirect()->route('all.testimonial')->with($notification);
        }
    }

    // Delete Testimonial
    public function DeleteTestimonial($id)
    {
        $delImg = Testimonial::findOrFail($id);
        $delete = $delImg->image;
        unlink($delete);

        Testimonial::findOrFail($id)->delete();


        $notification = array(
            'message' => 'Testimonial Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.testimonial')->with($notification);
    }
}
