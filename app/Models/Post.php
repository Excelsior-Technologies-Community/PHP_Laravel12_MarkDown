<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content_markdown',
        'content_html',
        'excerpt',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    // Automatically generate slug from title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = \Str::slug($post->title);
        });

        static::saving(function ($post) {
            // Convert markdown to HTML when saving
            $post->content_html = $post->convertMarkdownToHtml($post->content_markdown);
            
            // Generate excerpt from content (first 200 characters without markdown)
            $post->excerpt = \Str::limit(strip_tags($post->content_html), 200);
        });
    }

    protected function convertMarkdownToHtml($markdown)
    {
        // Configure CommonMark with GitHub Flavored Markdown
        $environment = new Environment([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
        ]);
        
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        
        $converter = new MarkdownConverter($environment);
        
        return $converter->convert($markdown);
    }

    // Scope for published posts
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // Get reading time
    public function getReadingTimeAttribute()
    {
        $wordsPerMinute = 200;
        $wordCount = str_word_count(strip_tags($this->content_html));
        $minutes = ceil($wordCount / $wordsPerMinute);
        
        return $minutes . ' min read';
    }
}