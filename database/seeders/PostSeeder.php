<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $posts = [
            [
                'title' => 'Getting Started with Laravel and Markdown',
                'content_markdown' => "# Getting Started with Laravel and Markdown\n\nLaravel makes it easy to work with Markdown content. In this post, we'll explore how to integrate Markdown parsing into your Laravel application.\n\n## Why Markdown?\n\nMarkdown is a lightweight markup language that you can use to add formatting elements to plaintext text documents. It's perfect for blog posts because:\n\n- It's easy to write and read\n- It converts cleanly to HTML\n- It's platform independent\n\n## Code Example\n\nHere's how you can parse Markdown in Laravel:\n\n```php\nuse League\\CommonMark\\CommonMarkConverter;\n\n\$converter = new CommonMarkConverter();\n\$html = \$converter->convert('# Hello World!');\n```\n\n## Features\n\n- **Bold text** and *italic text*\n- [Links](https://laravel.com)\n- Lists and tables\n- Code blocks with syntax highlighting",
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Advanced Markdown Features in Laravel',
                'content_markdown' => "# Advanced Markdown Features\n\nIn this post, we'll cover some advanced Markdown features available in Laravel using the CommonMark package.\n\n## Tables\n\n| Feature | Support | Notes |\n|---------|---------|-------|\n| Tables | ✅ | Full GFM support |\n| Task Lists | ✅ | Checkboxes |\n| Strikethrough | ✅ | ~~text~~ |\n\n## Task Lists\n\n- [x] Install CommonMark\n- [x] Configure parser\n- [ ] Add custom extensions\n- [ ] Deploy to production\n\n## Strikethrough\n\nThis is ~~deleted text~~ and this is still valid.\n\n## Links and Images\n\n![Laravel Logo](https://laravel.com/img/logomark.min.svg)\n\n[Visit Laravel Documentation](https://laravel.com/docs)\n\n## Blockquotes\n\n> Markdown is a text-to-HTML conversion tool for web writers.\n> It allows you to write using an easy-to-read format that converts to HTML.",
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}