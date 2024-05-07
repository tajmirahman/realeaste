<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    // All Category
    public function AllCategory()
    {
        $category = BlogCategory::latest()->get();
        return view('backend.blog.category.all_category', compact('category'));
    }

    // Add Category
    public function AddCategory()
    {
        return view('backend.blog.category.add_category');
    }

    // Store Category
    public function StoreCategory(Request $request)
    {
        BlogCategory::insert([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace('', '-', $request->category_name)),
            'created_at' => now(),

        ]);

        $notification = array(
            'message' => 'Category Added Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.category')->with($notification);
    }

    // Edit Category
    public function EditCategory($id)
    {
        $editCategory = BlogCategory::find($id);
        return view('backend.blog.category.edit_category', compact('editCategory'));
    }

    // Update Category
    public function UpdateCategory(Request $request)
    {
        $uid = $request->id;

        BlogCategory::findOrFail($uid)->update([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace('', '-', $request->category_name)),

        ]);

        $notification = array(
            'message' => 'Category Update Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.category')->with($notification);
    }

    // Delete Category
    public function DeleteCategory($id)
    {
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.category')->with($notification);
    }


    ///////////////////////////// Blog Post //////////////////////

    // All Post
    public function AllPost()
    {
        $post = BlogPost::latest()->get();
        return view('backend.blog.post.all_post', compact('post'));
    }

    // Add Post
    public function AddPost()
    {
        $category = BlogCategory::latest()->get();
        return view('backend.blog.post.add_post', compact('category'));
    }

    // Store Post
    public function StorePost(Request $request)
    {
        $image = $request->file('post_image');
        $name_gen = date('YmdHi') . '.' . $image->getClientOriginalName();
        Image::make($image)->resize(770, 520)->save('upload/post/' . $name_gen);
        $save_url = 'upload/post/' . $name_gen;

        BlogPost::insert([

            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace('', '-', $request->post_title)),
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_tags' => $request->post_tags,
            'blogcat_id' => $request->blogcat_id,
            'post_image' => $save_url,
            'created_at' => now(),
        ]);

        $notification = array(
            'message' => 'Post Added Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.post')->with($notification);
    }

    // Edit Post
    public function EditPost($id)
    {
        $editPost = BlogPost::find($id);
        $category = BlogCategory::latest()->get();
        return view('backend.blog.post.edit_post', compact('category','editPost'));
    }

    // Update Post
    public function UpdatePost(Request $request)
    {
        $uid = $request->id;
        $old_img = $request->old_image;

        if($request->file('post_image'))
        {
            $image = $request->file('post_image');
            $name_gen = date('YmdHi') . '.' . $image->getClientOriginalName();
            Image::make($image)->resize(770, 520)->save('upload/post/' . $name_gen);
            $save_url = 'upload/post/' . $name_gen;

            if(file_exists($old_img))
            {
                unlink($old_img);
            }
    
            BlogPost::findOrFail($uid)->update([
    
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace('', '-', $request->post_title)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'blogcat_id' => $request->blogcat_id,
                'post_image' => $save_url,
                'created_at' => now(),
            ]);
    
            $notification = array(
                'message' => 'Post Update Successfully',
                'alert-type' => 'info',
            );
    
            return redirect()->route('all.post')->with($notification);
        }
        else{
            BlogPost::findOrFail($uid)->update([
    
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace('', '-', $request->post_title)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'blogcat_id' => $request->blogcat_id,
                'created_at' => now(),
            ]);
    
            $notification = array(
                'message' => 'Post Update Successfully',
                'alert-type' => 'info',
            );
    
            return redirect()->route('all.post')->with($notification);
        }
    }

    // Delete Post
    public function DeletePost($id)
    {
        $delete = BlogPost::find($id);
        $del_img = $delete->post_image;
        unlink($del_img);

        BlogPost::find($id)->delete();

        $notification = array(
            'message' => 'Post Delete Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.post')->with($notification);
    }
}
