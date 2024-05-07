<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenitie;
use App\Models\MultiImg;
use App\Models\Property;
use App\Models\State;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PropertyController extends Controller
{
    //All Property
    public function AllProperty()
    {
        $property = Property::latest()->get();
        return view('backend.property.all_property', compact('property'));
    }

    //Add Property
    public function AddProperty()
    {
        $state = State::orderBy('state_name', 'ASC')->get();
        $amenitie = Amenitie::latest()->get();
        $type = Type::orderBy('type_name', 'ASC')->get();
        $agent = User::where('role', 'agent')->where('status', 'active')->latest()->get();

        return view('backend.property.add_property', compact('state', 'amenitie', 'type', 'agent'));
    }

    //Store Property
    public function StoreProperty(Request $request)
    {
        $code = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);

        $amen = $request->amenitie_id;
        $amenitie = implode(',', $amen);

        $image = $request->file('image');
        $name_gen = date('YmdHi') . '.' . $image->getClientOriginalName();
        Image::make($image)->resize(370, 250)->save('upload/property/property_image/' . $name_gen);
        $save_url = 'upload/property/property_image/' . $name_gen;

        $property_id = Property::insertGetId([

            'agent_id' => $request->agent_id,
            'type_id' => $request->type_id,
            'property_status' => $request->property_status,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace('', '-', $request->property_name)),
            'max_price' => $request->max_price,
            'min_price' => $request->min_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'property_code' => $code,
            'amenitie_id' => $amenitie,

            'room' => $request->room,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'property_size' => $request->property_size,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'property_video' => $request->property_video,

            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'state_id' => $request->state_id,
            'city' => $request->city,
            'country' => $request->country,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $save_url,

            'featured' => $request->featured,
            'hot' => $request->hot,
            'status' => 1,
            'created_at' => now(),

        ]);

        // Multi Image
        $images = $request->file('multi_img');

        foreach ($images as $img) {
            $make_gen = date('YmdHi') . '.' . $img->getClientOriginalName();
            Image::make($img)->resize(770, 520)->save('upload/property/multi_img/' . $make_gen);
            $uploadPath = 'upload/property/multi_img/' . $make_gen;

            MultiImg::insert([

                'property_id' => $property_id,
                'photo' => $uploadPath,
                'created_at' => now(),

            ]);
        }

        $notification = array(
            'message' => 'Property Inserted Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.property')->with($notification);
    }

    //Edit Property
    public function EditProperty($id)
    {
        $property = Property::find($id);
        $state = State::orderBy('state_name', 'ASC')->get();
        $amenitie = Amenitie::latest()->get();
        $type = Type::orderBy('type_name', 'ASC')->get();
        $agent = User::where('role', 'agent')->where('status', 'active')->latest()->get();
        $multiImg = MultiImg::where('property_id', $id)->get();

        $ami = $property->amenitie_id;
        $property_ami = explode(',', $ami);


        return view('backend.property.edit_property', compact('state', 'amenitie', 'type', 'agent', 'property', 'property_ami', 'multiImg'));
    }

    //Update MultiImage
    public function UpdateMultiImage(Request $request)
    {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo);

            $make_name = date('YmdHi') . '.' . $img->getClientOriginalName();
            Image::make($img)->resize(770, 520)->save('upload/property/multi_img/' . $make_name);
            $uploadPath = 'upload/property/multi_img/' . $make_name;

            MultiImg::where('id', $id)->update([
                'photo' => $uploadPath,

            ]);
        } // end foreach

        $notification = array(
            'message' => 'Multi Image Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    // Store Multi Image

    public function StoreMultiImage(Request $request)
    {
        $new_multi = $request->imageid;
        $image = $request->file('multi_img');

        $make_name = date('YmdHi') . '.' . $image->getClientOriginalName();
        Image::make($image)->resize(770, 520)->save('upload/property/multi_img/' . $make_name);
        $uploadPath = 'upload/property/multi_img/' . $make_name;

        MultiImg::insert([

            'property_id' => $new_multi,
            'photo' => $uploadPath,

        ]);

        $notification = array(
            'message' => 'Add Multi Image Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
    // End Method

    // Delete MultiImg

    public function DeleteMultiimg($id)
    {
        $delImg = MultiImg::find($id);
        $delete = $delImg->photo;
        unlink($delete);

        MultiImg::find($id)->delete();

        $notification = array(
            'message' => 'Multi Image Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    //Update Property
    public function UpdateProperty(Request $request)
    {
        $uid = $request->id;
        $old_img = $request->old_image;

        $amen = $request->amenitie_id;
        $amenitie = implode(',', $amen);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = date('YmdHi') . '.' . $image->getClientOriginalName();
            Image::make($image)->resize(370, 250)->save('upload/property/property_image/' . $name_gen);
            $save_url = 'upload/property/property_image/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Property::find($uid)->update([

                'agent_id' => $request->agent_id,
                'type_id' => $request->type_id,
                'property_status' => $request->property_status,
                'property_name' => $request->property_name,
                'property_slug' => strtolower(str_replace('', '-', $request->property_name)),
                'max_price' => $request->max_price,
                'min_price' => $request->min_price,
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'amenitie_id' => $amenitie,

                'room' => $request->room,
                'bedroom' => $request->bedroom,
                'bathroom' => $request->bathroom,
                'property_size' => $request->property_size,
                'garage' => $request->garage,
                'garage_size' => $request->garage_size,
                'property_video' => $request->property_video,

                'address' => $request->address,
                'state_id' => $request->state_id,
                'city' => $request->city,
                'country' => $request->country,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'image' => $save_url,

                'featured' => 1,
                'hot' => 1,
                'status' => 1,

            ]);

            $notification = array(
                'message' => 'Product Update With Image Successfully',
                'alert-type' => 'info',
            );

            return redirect()->route('all.property')->with($notification);
        } else {
            Property::find($uid)->update([

                'agent_id' => $request->agent_id,
                'type_id' => $request->type_id,
                'property_status' => $request->property_status,
                'property_name' => $request->property_name,
                'property_slug' => strtolower(str_replace('', '-', $request->property_name)),
                'max_price' => $request->max_price,
                'min_price' => $request->min_price,
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'amenitie_id' => $amenitie,

                'room' => $request->room,
                'bedroom' => $request->bedroom,
                'bathroom' => $request->bathroom,
                'property_size' => $request->property_size,
                'garage' => $request->garage,
                'garage_size' => $request->garage_size,
                'property_video' => $request->property_video,

                'address' => $request->address,
                'zipcode' => $request->zipcode,
                'state_id' => $request->state_id,
                'city' => $request->city,
                'country' => $request->country,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,

                'featured' => $request->featured,
                'hot' => $request->hot,
                'status' => 1,

            ]);

            $notification = array(
                'message' => 'Product Update Without Image Successfully',
                'alert-type' => 'info',
            );

            return redirect()->route('all.property')->with($notification);
        }
    }

    // Delete Full Property

    public function DeleteProperty($id)
    {
        $property = Property::findOrFail($id);
        unlink($property->image);
        Property::findOrFail($id)->delete();

        $imges = MultiImg::where('property_id', $id)->get();
        foreach ($imges as $img) {
            unlink($img->photo);
            MultiImg::where('property_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    // Inactive Property

    public function InactiveProperty($id)
    {
        Property::find($id)->update([
            'status' => 0,
        ]);

        $notification = array(
            'message' => 'Property Inactive Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    // Active Property

    public function ActiveProperty($id)
    {
        Property::find($id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'Property Active Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
