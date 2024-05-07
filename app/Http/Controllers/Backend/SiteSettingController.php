<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    //All Site
    public function AllSite()
    {
        $site = SiteSetting::latest()->get();
        return view('backend.site.all_site',compact('site'));
    }

    //Add Site
    public function AddSite()
    {
        return view('backend.site.add_site');
    }

    //Store Site
    public function StoreSite(Request $request)
    {
        SiteSetting::insert([

            'email' => $request->email,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'open_time' => $request->open_time,
            'facebook' => $request->facebook,
            'created_at' => now(),

        ]);

        $notification = array(
            'message' => 'Site Setting Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('all.site')->with($notification);
    }

    //Edit Site
    public function EditSite($id)
    {
        $editSite = SiteSetting::find($id);
        return view('backend.site.edit_site',compact('editSite'));
    }

    //Store Site
    public function UpdateSite(Request $request)
    {
        $uid = $request->id;

        SiteSetting::find($uid )->update([

            'email' => $request->email,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'open_time' => $request->open_time,
            'facebook' => $request->facebook,

        ]);

        $notification = array(
            'message' => 'Site Setting Update Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('all.site')->with($notification);
    }


}
