<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title.en' => 'required|string',
            'title.ro' => 'required|string',
            'slug' => 'required|unique:posts,slug',
            'content.en' => 'required',
            'content.ro' => 'required',
            'excerpt.en' => 'required',
            'excerpt.ro' => 'required',
            'thumbnail' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();


        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('post-thumbnail', 'public');
        }

        Post::create($data);

        return redirect('/admin/posts/')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title.en' => 'required|string',
            'title.ro' => 'required|string',
            'slug' => [
                'required',
                Rule::unique('posts', 'slug')->ignore($post->id),
            ],
            'content.en' => 'required',
            'content.ro' => 'required',
            'excerpt.en' => 'required',
            'excerpt.ro' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('post-thumbnail', 'public');

            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
        }

        $post->update($data);

        return redirect('/admin/posts/')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Delete the image
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        // Delete the article
        $post->delete();

        // Redirect to the news page with a success message
        return redirect('/admin/posts/')->with('success', 'Post deleted successfully');
    }
}
