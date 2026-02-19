<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Display list of published posts
    public function index()
    {
        $posts = Post::published()
                     ->latest('published_at')
                     ->paginate(10);
        
        return view('posts.index', compact('posts'));
    }

    // Show single post
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
                    ->published()
                    ->firstOrFail();
        
        return view('posts.show', compact('post'));
    }

    // Show create form
    public function create()
    {
        return view('posts.create');
    }

    // Store new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content_markdown' => 'required',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $post = Post::create($validated);
        
        return redirect()->route('posts.show', $post->slug)
                         ->with('success', 'Post created successfully!');
    }

    // Show edit form
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Update post
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content_markdown' => 'required',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $post->update($validated);
        
        return redirect()->route('posts.show', $post->slug)
                         ->with('success', 'Post updated successfully!');
    }

    // Delete post
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully!');
    }
}