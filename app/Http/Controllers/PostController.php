<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        if ($request->hasFile('image')) {
            $directory = 'images/posts';
            $file = $request->file('image');
            $post->image = imageUpload($file, 800, 600, $directory);
        }
        $post->content = $request->input('content');
        $post->user_id = auth()->id(); // Assuming you have user authentication
        $post->save();

        return redirect()->back()->with('success', 'Post created successfully!');
    }
}
