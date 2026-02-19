@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold mb-6">Latest Posts</h1>

        @if($posts->count() > 0)
            <div class="space-y-6">
                @foreach($posts as $post)
                    <article class="border-b border-gray-200 pb-6 last:border-0">
                        <h2 class="text-2xl font-semibold mb-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $post->title }}
                            </a>
                        </h2>
                        
                        <div class="text-gray-600 mb-2">
                            Published {{ $post->published_at->format('F j, Y') }} · {{ $post->reading_time }}
                        </div>
                        
                        <p class="text-gray-700 mb-3">{{ $post->excerpt }}</p>
                        
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800">
                            Read more →
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-600">No posts yet. Check back soon!</p>
        @endif
    </div>
@endsection