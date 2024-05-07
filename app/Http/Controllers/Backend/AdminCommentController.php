<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    //All Comment
    public function AllComment()
    {
        $comment = Comment::where('parent_id',null)->get();
        return view('backend.admin.all_comment',compact('comment'));
    }

    //View Comment
    public function ViewComment($id)
    {
        $comments = Comment::find($id);
        return view('backend.admin.view_comment',compact('comments'));
    }

    // Store Comment
    public function ReplyComment(Request $request)
    {
        $id = $request->id;
        $uid = $request->user_id;
        $bid = $request->blog_id;

        Comment::insert([

            'user_id' => $uid,
            'blog_id' => $bid,
            'parent_id' => $id,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now(),

        ]);

        $notification = array(
            'message' => 'Reply Send Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
