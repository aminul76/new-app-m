<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
   
    public function index()
    {
        $posts = Post::latest()->get();
        return view('backend.posts.index', compact('posts'));
    }

    // Show form to create new post
    public function create()
    {
        return view('backend.posts.create');
    }

    // Store the new post
      public function store(Request $request)
        {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'short_description' => 'required|string',
                'description' => 'required|string',
                'photolink' => 'nullable|url',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // At least one of photolink or photo required
            if (!$request->filled('photolink') && !$request->hasFile('photo')) {
                return back()->withErrors(['photo' => 'You must provide either a photo file or a photo link.'])->withInput();
            }

            // Handle photo upload to public/images/posts
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('images/posts'), $imageName);

                $data['photo'] = 'images/posts/' . $imageName; // Save relative path
            }

            Post::create($data);

            return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
        }

    // Show form to edit an existing post
    public function edit(Post $post)
    {
        return view('backend.posts.edit', compact('post'));
    }

    // Update the post
  public function update(Request $request, Post $post)
        {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'short_description' => 'required|string',
                'description' => 'required|string',
                'photolink' => 'nullable|url',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // কমপক্ষে photolink বা photo থাকতে হবে
            if (!$request->filled('photolink') && !$request->hasFile('photo') && !$post->photo) {
                return back()->withErrors(['photo' => 'You must provide either a photo file or a photo link.'])->withInput();
            }

            // নতুন ছবি থাকলে, পুরাতন ছবি ডিলিট করে নতুনটা সেভ করো
            if ($request->hasFile('photo')) {
                // পুরাতন ছবি ডিলিট করো (যদি থাকে)
                if ($post->photo && file_exists(public_path($post->photo))) {
                    unlink(public_path($post->photo));
                }

                // নতুন ছবি সেভ করো
                $image = $request->file('photo');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/posts'), $imageName);
                $data['photo'] = 'images/posts/' . $imageName;
            } else {
                // যদি নতুন ছবি না আসে, তাহলে আগেরটা রেখে দাও
                $data['photo'] = $post->photo;
            }

            // ডাটাবেজ আপডেট
            $post->update($data);

            return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
        }


    // Delete a post
    public function destroy(Post $post)
{
    // Delete photo file if exists
    if ($post->photo && file_exists(public_path($post->photo))) {
        unlink(public_path($post->photo));
    }

    // Delete database row
    $post->delete();

    return redirect()->route('admin.posts.index')->with('success', 'Post deleted.');
}
}
