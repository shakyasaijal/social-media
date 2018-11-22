<?php

namespace App\Http\Controllers\Guest;

use App\Events\NotifyCustomerEvent;
use App\Jobs\SendEmailToUser;
use App\Mail\SendBlogPostNotificationToAllUser;
use App\Models\Blog;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function myBlogs()
    {
        $blogs = Blog::where('status', 1)->where('user_id', Auth::id())->orderBy('posted_date', 'DESC')->paginate(15);
        return view('blogs.my-blogs', [
            'blogs' => $blogs
        ]);
    }

    public function getBlogs()
    {
        $blogs = Blog::where('status', 1)->orderBy('posted_date', 'DESC')->paginate(15);
        return view('blogs.blogs-list', [
            'blogs' => $blogs
        ]);
    }

    public function getBlogDetails($slug)
    {
        $blog = Blog::slug($slug)->first();
        return view('blogs.blog-details', [
            'blog' => $blog
        ]);
    }

    public function createBlog()
    {
        return view('blogs.create');
    }

    public function postBlog(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:150',
            'photo' => 'required|image',
        ]);
        $blog = new Blog();
        
        $photo = $request->file('photo');
        $dest = 'uploads/blogs';
        $name = md5(time());
        $ext = $photo->getClientOriginalExtension();
        $photo_full_name = $dest . '/' . $name . '.' . $ext;
        $photo->move($dest, $photo_full_name);
        $blog->photo = $photo_full_name;

        $blog->title = $request->input('title');
        $blog->slug = str_slug($request->input('title'));
        $blog->posted_date ="9/18/2018";
        $blog->description = $request->input('description');
        $blog->status = $request->input('status');
        $blog->save();
       
        //dispatch(new SendEmailToUser($data))
        //SendEmailToUser::dispatch($data)->delay(now()->addSecond(15));
        return redirect()->back()->with('success', 'New blog successfully added');
    }

    public function editBlog($id)
    {
        $blog = Blog::find($id);
        return view('blogs.edit', [
            'blog' => $blog
        ]);
    }

    public function updateBlog(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'bail|required|max:150',
            'posted_date' => 'required|date',
            'description' => 'required|min:5',
            'photo' => 'nullable|image',
            'status' => 'required|in:0,1'
        ]);
        $blog = Blog::find($id);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $destination = 'uploads/blogs';
            $photo_extension = $photo->getClientOriginalExtension();
            $photo_name = md5(time());
            $name = $destination . '/' . $photo_name . '.' . $photo_extension;
            if (isset($blog->photo) && app('files')->exists($blog->photo)) {
                app('files')->delete($blog->photo);
            }
            $photo->move($destination, $name);
            $blog->photo = $name;
        }
        $blog->title = $request->input('title');
        $blog->posted_date = $request->input('posted_date');
        $blog->description = $request->input('description');
        $blog->status = $request->input('status');
        $blog->save();
        return redirect()->back()->withSuccess("Blog updated successfully");

    }

    public function deleteBlog($id)
    {
        $blog = Blog::find($id);
        if (isset($blog->photo) && app('files')->exists($blog->photo)) {
            app('files')->delete($blog->photo);
        }
        $blog->delete();
        return redirect()->back()->withSuccess("Blog deleted successfully");

    }


}
