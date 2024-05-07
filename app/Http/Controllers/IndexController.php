<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\MultiImg;
use App\Models\Property;
use App\Models\PropertyMessage;
use App\Models\State;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //Index 
    public function Index()
    {
        return view('frontend.index');
    }


    //Type All
    public function TypeAll()
    {
        $type = Type::orderBy('type_name', 'ASC')->get();
        return view('frontend.type.type_all', compact('type'));
    }

    //Type Wise Property
    public function TypeWiseProperty($id)
    {
        $property = Property::where('type_id', $id)->where('status', 1)->get();

        $type_bread = Type::where('id', $id)->first();

        return view('frontend.type.type_wise_property', compact('property', 'type_bread'));
    }

    //Agent Details
    public function AgentDetails($id)
    {
        $agent = User::where('role', 'agent')->where('status', 'active')->find($id);

        $property = Property::where('agent_id', $id)->get();

        return view('frontend.agent.agent_details', compact('agent', 'property'));
    }

    //State Property Details
    public function StatePropertyDetails($id)
    {
        $property = Property::where('state_id', $id)->get();
        $state_bread = State::where('id', $id)->first();
        return view('frontend.state.state_property_details', compact('property', 'state_bread'));
    }

    //PropertyDetatils
    public function PropertyDetatils($id, $slug)
    {
        $property = Property::find($id);
        $multiImg = MultiImg::where('property_id', $id)->get();

        $amen = $property->amenitie_id;
        $amenities = explode(',', $amen);


        $p_releted = $property->type_id;
        $pdetails = Property::where('type_id', $p_releted)->where('status', '1')->where('id', '!=', $id)->limit(3)->get();

        return view('frontend.property.property_details', compact('property', 'multiImg', 'amenities', 'pdetails'));
    }

    // Frontend All Property
    public function FrontendAllProperty()
    {
        $property = Property::where('status', 1)->latest()->paginate(6);
        return view('frontend.property.frontend_all_property', compact('property'));
    }

    // Property Message
    public function PropertyMessage(Request $request)
    {
        $pid = $request->property_id;
        $aid = $request->agent_id;

        if (Auth::check()) {
            PropertyMessage::insert([

                'user_id' => Auth::user()->id,
                'property_id' => $pid,
                'agent_id' => $aid,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'created_at' => now(),
            ]);

            $notification = array(
                'message' => 'Message Send Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        } else {

            $notification = array(
                'message' => 'Please Login First',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
    }

    // Property Message
    public function AgentPropertyMessage(Request $request)
    {
        $aid = $request->agent_id;

        if (Auth::check()) {
            PropertyMessage::insert([

                'user_id' => Auth::user()->id,
                'agent_id' => $aid,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'created_at' => now(),
            ]);

            $notification = array(
                'message' => 'Message Send Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        } else {

            $notification = array(
                'message' => 'Please Login First',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
    }

    // All Blog
    public function AllBlog()
    {
        $allBlog = BlogPost::latest()->paginate(5);

        return view('frontend.blog.all_blog',compact('allBlog'));
    }

    // Blog Details
    public function BlogDetatils($id)
    {
        $post = BlogPost::find($id);

        $tag = $post->post_tags;
        $tagpost = explode(',',$tag);

        return view('frontend.blog.blog_details',compact('post','tagpost'));
    }

    //Category Wise Post
    public function CategoryWisePost($id)
    {
        
        $catwisepost = BlogPost::where('blogcat_id',$id)->get();

        $bbread = BlogCategory::where('id',$id)->first();

        return view('frontend.blog.cat_wise_post',compact('catwisepost','bbread'));
    }

    // Store Comment
    public function StoreComment(Request $request)
    {
        $bid = $request->blog_id;

        Comment::insert([

            'user_id' => Auth::user()->id,
            'blog_id' => $bid,
            'parent_id' => null,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now(),

        ]);

        $notification = array(
            'message' => 'Comment Send Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }


}
