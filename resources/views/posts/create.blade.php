@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold mb-6">Create New Post</h1>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-6">
                <label for="content_markdown" class="block text-gray-700 font-semibold mb-2">Content (Markdown)</label>
                <textarea name="content_markdown" id="content_markdown" rows="15" 
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          required>{{ old('content_markdown') }}</textarea>
                <p class="text-sm text-gray-600 mt-2">
                    Write your post in Markdown format. GitHub Flavored Markdown is supported.
                </p>
            </div>

            <div class="mb-6">
                <div class="flex items-center">
                    <input type="checkbox" name="is_published" id="is_published" value="1" 
                           {{ old('is_published') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="is_published" class="ml-2 text-gray-700">Publish immediately</label>
                </div>
            </div>

            <div class="mb-6" id="publish_date_container" style="{{ old('is_published') ? 'display: none;' : '' }}">
                <label for="published_at" class="block text-gray-700 font-semibold mb-2">Publish Date</label>
                <input type="datetime-local" name="published_at" id="published_at" 
                       value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-600 mt-2">Leave empty to publish now, or set a future date for scheduled publishing.</p>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Create Post
                </button>
                <a href="{{ route('posts.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">
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
        autosave: {
            enabled: true,
            uniqueId: "blog-post-{{ uniqid() }}",
        },
        toolbar: [
            'bold', 'italic', 'heading', '|',
            'quote', 'unordered-list', 'ordered-list', '|',
            'link', 'image', 'code', 'table', '|',
            'preview', 'side-by-side', 'fullscreen', '|',
            'guide'
        ],
        placeholder: "Write your blog post in Markdown..."
    });

    // Toggle publish date field based on immediate publish checkbox
    document.getElementById('is_published').addEventListener('change', function() {
        const container = document.getElementById('publish_date_container');
        container.style.display = this.checked ? 'none' : 'block';
        
        if (this.checked) {
            document.getElementById('published_at').value = '';
        }
    });
</script>
@endpush