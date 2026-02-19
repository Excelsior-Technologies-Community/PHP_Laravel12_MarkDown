@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold mb-6">Edit Post</h1>

        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-6">
                <label for="content_markdown" class="block text-gray-700 font-semibold mb-2">Content (Markdown)</label>
                <textarea name="content_markdown" id="content_markdown" rows="15" 
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          required>{{ old('content_markdown', $post->content_markdown) }}</textarea>
            </div>

            <div class="mb-6">
                <div class="flex items-center">
                    <input type="checkbox" name="is_published" id="is_published" value="1" 
                           {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="is_published" class="ml-2 text-gray-700">Published</label>
                </div>
            </div>

            <div class="mb-6" id="publish_date_container">
                <label for="published_at" class="block text-gray-700 font-semibold mb-2">Publish Date</label>
                <input type="datetime-local" name="published_at" id="published_at" 
                       value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Update Post
                </button>
                <a href="{{ route('posts.show', $post->slug) }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // Initialize EasyMDE Markdown Editor
    const easyMDE = new EasyMDE({
        element: document.getElementById('content_markdown'),
        spellChecker: false,
        toolbar: [
            'bold', 'italic', 'heading', '|',
            'quote', 'unordered-list', 'ordered-list', '|',
            'link', 'image', 'code', 'table', '|',
            'preview', 'side-by-side', 'fullscreen', '|',
            'guide'
        ]
    });
</script>
@endpush