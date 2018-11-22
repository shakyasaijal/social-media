<?php

namespace App\Http\Controllers\Admin;

use App\Mail\SendBlogPostNotificationToAllUser;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->get();
        return view('admin.blogs.index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $validated_data = $request->validate([
            'title' => 'required|max:191',
            'posted_date' => 'nullable|min:1',
            'photo' => 'required|mimes:jpeg,jpg,png,gif,svg,bmp',
            'status' => 'required|in:0,1',
            'description' => 'required|min:5'
        ]);


        $blog = new Blog();

        $photo = $request->file('photo');
        $extension = $photo->getClientOriginalExtension();
        $destination = 'uploads/blogs';
        $photo_real_name = md5(time());
        $expected_name = $destination . '/' . $photo_real_name . '.' . $extension;
        $photo->move($destination, $expected_name);

        $blog->photo = $expected_name;
        $blog->title = $request->input('title');
        $blog->slug = str_slug($request->input('title'));
        $blog->posted_date = $request->input('posted_date');
        $blog->status = $request->input('status');
        $blog->description = $request->input('description');
        $blog->save();
        return redirect()->back()->with('success', 'New blog created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated_data = $request->validate([
            'title' => 'required|max:191',
            'photo' => 'nullable|mimes:jpg,jpeg,png,gif,svg,bmp',
            'status' => 'required|in:0,1',
            'description' => 'required|min:5',
            'posted_date' => 'required|date',
        ]);
        $blog = Blog::find($id);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            $destination = 'uploads/blogs';
            $photo_real_name = md5(time());
            $expected_name = $destination . '/' . $photo_real_name . '.' . $extension;
            if ($blog->photo && app('files')->exists($blog->photo)) {
                app('files')->delete($blog->photo);
            }
            $photo->move($destination, $expected_name);
            $blog->photo = $expected_name;
        }
        $blog->title = $request->input('title');
        $blog->slug = str_slug($request->input('title'));
        $blog->posted_date = $request->input('posted_date');
        $blog->status = $request->input('status');
        $blog->description = $request->input('description');
        $blog->save();
        return redirect()->back()->withSuccess("Blog successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if ($blog->photo && app()->files($blog->photo)) {
            app('files')->delete($blog->photo);
        }
        $blog->delete();
        return redirect()->back()->withSuccess("Blog deleted successfully");
    }

    public function publish($id)
    {
        $blog = Blog::find($id);
        $blog->status = $blog->status ? 0 : 1;
        $blog->save();
        return redirect()->back();
    }
}
