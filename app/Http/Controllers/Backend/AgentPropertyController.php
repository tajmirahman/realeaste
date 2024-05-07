<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenitie;
use App\Models\MultiImg;
use App\Models\Property;
use App\Models\State;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AgentPropertyController extends Controller
{
    //All Property
    public function AllAgentProperty()
    {
        $id = Auth::user()->id;
        $property = Property::where('status', 1)->where('agent_id', $id)->get();

        return view('backend.agent.property.all_property', compact('property'));
    }

    //Add Property
    public function AddAgentProperty()
    {
        $state = State::latest()->get();
        $type = Type::latest()->get();
        $amenitie = Amenitie::latest()->get();

        return view('backend.agent.property.add_property', compact('state', 'type', 'amenitie'));
    }

    //Store Property
    public function StoreAgentProperty(Request $request)
    {
        $code = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);

        $amen = $request->amenitie_id;
        $amenitie = implode(',', $amen);

        $image = $request->file('image');
        $name_gen = date('YmdHi') . '.' . $image->getClientOriginalName();
        Image::make($image)->resize(370, 250)->save('upload/property/property_image/' . $name_gen);
        $save_url = 'upload/property/property_image/' . $name_gen;

        $property_id = Property::insertGetId([

            'agent_id' => Auth::user()->id,
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
            'state_id' => $request->state_id,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
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

        // End Multi Image

        $notification = array(
            'message' => 'Property Inserted Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.agent.property')->with($notification);
    }
    // End Store Property

    //Edit Property
    public function EditAgentProperty($id)
    {
        $property = Property::find($id);
        $state = State::latest()->get();
        $amenitie = Amenitie::latest()->get();
        $type = Type::latest()->get();
        $multiImg = MultiImg::where('property_id',$id)->get();

        $amen_edit = $property->amenitie_id;
        $edit_amenitie = explode(',', $amen_edit);


        return view('backend.agent.property.edit_property', compact('state', 'type', 'amenitie', 'property', 'edit_amenitie','multiImg'));
    }


    // Store Agent MultiImage
    public function StoreAgentMultiImage(Request $request)
    {
        $new_img = $request->imageId;

        $img = $request->file('multi_img');

            $make_gen = date('YmdHi') . '.' . $img->getClientOriginalName();
            Image::make($img)->resize(770, 520)->save('upload/property/multi_img/' . $make_gen);
            $uploadPath = 'upload/property/multi_img/' . $make_gen;

            MultiImg::insert([

                'property_id' => $new_img,
                'photo' => $uploadPath,
                'created_at' => now(),

            ]);
            $notification = array(
                'message' => 'Multi Image Added Successfully',
                'alert-type' => 'info',
            );
    
            return redirect()->back()->with($notification);

    }


    // UpdateAgentMultiImage
    public function UpdateAgentMultiImage(Request $request)
    {
        $imgs = $request->multi_img;

        foreach($imgs as $id => $img)
        {
            $imgDel = MultiImg::findOrFail($id);
            uniqid($imgDel->photo);

            $make_gen = date('YmdHi') . '.' . $img->getClientOriginalName();
            Image::make($img)->resize(770, 520)->save('upload/property/multi_img/' . $make_gen);
            $uploadPath = 'upload/property/multi_img/' . $make_gen;

            MultiImg::where('id',$id)->update([

                'photo' => $uploadPath ,

            ]);

            $notification = array(
                'message' => 'Multi Image Update Successfully',
                'alert-type' => 'info',
            );
    
            return redirect()->back()->with($notification);
        }

    }

    // Delete Agent MultiImage
    public function DeleteAgentMultiImage($id)
    {
        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->photo);

        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Multi Image Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    }

    //Update Property
    public function UpdateAgentProperty(Request $request)
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

                'agent_id' => Auth::user()->id,
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

            return redirect()->route('all.agent.property')->with($notification);
        } else {
            Property::find($uid)->update([

                'agent_id' => Auth::user()->id,
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

            return redirect()->route('all.agent.property')->with($notification);
        }
    }

    // Delete Full Property

    public function DeleteAgentProperty($id)
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

    


}
