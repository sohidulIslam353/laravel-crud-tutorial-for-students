<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    // Display the blog index page
    public function index(Request $request)
    {
        $blogs = Blog::query()
            ->when($request->search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })->latest()->cursorPaginate(10);

        return view('admin.blog.index', compact('blogs'));
    }

    // create blog page
    public function create(Request $request)
    {
        return view('admin.blog.create');
    }

    // store method
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
        ]);

        // Handle file upload and store blog post logic here
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title, '-');
        if ($request->hasFile('image')) {
            $directory = 'images/blogs';
            $file = $request->file('image');
            $blog->image = imageUpload($file, 800, 600, $directory);
        }
        $blog->description = $request->description;
        $blog->user_id = Auth::id();
        $blog->save();

        return redirect()->route('blog.index')->with('success', 'Blog post created successfully.');
    }

    // edit blog
    public function edit($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        if (!$blog) {
            abort(404);
        }

        return view('admin.blog.edit', compact('blog'));
    }

    // update method
    public function update(Request $request, $id)
    {
        // validation for updating blog
        $request->validate([
            'title' => 'required|string|max:255' . $id,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
        ]);

        // Handle file upload and update blog post logic here
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title, '-');
        if ($request->hasFile('image')) {
            $path = parse_url($blog->image, PHP_URL_PATH);
            $fullPath = public_path($path);
            if (file_exists($fullPath)) {
                File::delete($fullPath);
            }
            // update new image
            $directory = 'images/blogs';
            $file = $request->file('image');
            $blog->image = imageUpload($file, 800, 600, $directory);
        }
        $blog->description = $request->description;
        $blog->save();

        return redirect()->route('blog.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $path = parse_url($blog->image, PHP_URL_PATH);
        $fullPath = public_path($path);
        if (file_exists($fullPath)) {
            File::delete($fullPath);
        }
        $blog->delete();
        return redirect()->route('blog.index')->with('success', 'Blog post deleted successfully.');
    }
}
