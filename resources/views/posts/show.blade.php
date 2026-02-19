@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-8">
            <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>
            
            <div class="flex items-center text-gray-600 mb-8">
                <span>Published {{ $post->published_at->format('F j, Y') }}</span>
                <span class="mx-2">·</span>
                <span>{{ $post->reading_time }}</span>
            </div>

            <div class="prose prose-lg max-w-none">
                {!! $post->content_html !!}
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex space-x-4">
                    <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800">
                        ← Back to all posts
                    </a>
                    
                    <!-- Admin actions - In a real app, check authentication -->
                    <a href="{{ route('posts.edit', $post) }}" class="text-green-600 hover:text-green-800">
                        Edit Post
                    </a>
                    
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">
                            Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </article>
@endsection

@push('styles')
<style>
    .prose pre {
        background-color: #f4f4f4;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
    }
    .prose code {
        background-color: #f4f4f4;
        padding: 0.2rem 0.4rem;
        border-radius: 0.25rem;
        font-size: 0.9em;
    }
    .prose blockquote {
        border-left: 4px solid #e2e8f0;
        padding-left: 1rem;
        font-style: italic;
    }
</style>
@endpush