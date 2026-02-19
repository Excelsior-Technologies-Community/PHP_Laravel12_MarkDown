# PHP_Laravel12_MarkDown
## Overview

This project is a complete Markdown-based blog system built using Laravel 12 and League CommonMark.
It allows users to create, edit, and publish blog posts written in Markdown format. Markdown content is automatically converted into HTML and displayed in a clean, responsive layout.

The system includes full CRUD functionality, automatic slug generation, excerpt creation, reading time calculation, scheduled publishing, and pagination.

---

## Technology Stack

* PHP 8+
* Laravel 12
* MySQL
* League CommonMark
* Tailwind CSS
* EasyMDE Markdown Editor

---

## Step 1: Create New Laravel Project

```bash
composer create-project laravel/laravel laravel-markdown-blog
cd laravel-markdown-blog
```

---

## Step 2: Install Required Package

```bash
composer require league/commonmark
```

---

## Step 3: Configure Database

Update `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_markdown
DB_USERNAME=root
DB_PASSWORD=
```

Create the database manually in MySQL.

---

## Step 4: Create Posts Migration

```bash
php artisan make:migration create_posts_table
```

Fields:

* id
* title
* slug (unique)
* content_markdown
* content_html
* excerpt
* is_published
* published_at
* timestamps

Run migration:

```bash
php artisan migrate
```

---

## Step 5: Create Post Model

```bash
php artisan make:model Post
```

Key Features in Model:

* Auto slug generation
* Markdown to HTML conversion on save
* Auto excerpt generation
* Published scope
* Reading time calculation

Functionality Implemented:

* Converts Markdown to HTML using GitHub Flavored Markdown
* Escapes unsafe HTML input
* Calculates reading time (200 words per minute)
* Auto-limits excerpt to 200 characters

---

## Step 6: Create Controller

```bash
php artisan make:controller PostController
```

Controller Methods:

* index – Display published posts
* show – Display single post
* create – Show create form
* store – Save new post
* edit – Show edit form
* update – Update post
* destroy – Delete post

Features:

* Validation
* Slug-based routing
* Pagination
* Flash success messages

---

## Step 7: Configure Routes

In `routes/web.php`:

* GET / → Home
* GET /posts → List posts
* GET /posts/{slug} → Show post
* CRUD routes for posts

In production, authentication middleware should protect create/edit/delete routes.

---

## Step 8: Blade Views Structure

Folder:

```
resources/views/
  layouts/
    app.blade.php
  posts/
    index.blade.php
    show.blade.php
    create.blade.php
    edit.blade.php
```

UI Features:

* Tailwind CSS layout
* EasyMDE Markdown editor
* Flash messages
* Validation errors display
* Pagination links
* Responsive design

---

## Step 9: Sample Data Seeder (Optional)

```bash
php artisan make:seeder PostSeeder
php artisan db:seed --class=PostSeeder
```

Seeder adds sample Markdown posts with:

* Headings
* Lists
* Code blocks
* Tables
* Images
* Blockquotes

---

## Step 10: Run Application

```bash
php artisan serve
```

Open in browser:

```
http://localhost:8000
```

<img width="1543" height="790" alt="image" src="https://github.com/user-attachments/assets/3f6ff616-d109-4fa2-b4ab-4dad854a18d5" />

<img width="1549" height="969" alt="image" src="https://github.com/user-attachments/assets/033516b1-3c64-4035-9b85-14444e78abd7" />


---

## Features Implemented

### Markdown Support

GitHub Flavored Markdown using League CommonMark.

### CRUD Operations

Create, read, update, delete blog posts.

### Automatic HTML Conversion

Markdown converted to HTML when saving.

### Excerpt Generation

Auto-generated summary from content.

### Reading Time

Estimated reading time calculation.

### Slug Generation

SEO-friendly URLs automatically generated.

### Publishing System

Draft and publish with scheduled publishing.

### Pagination

Paginated listing of posts.

### Responsive UI

Tailwind-based clean design.

---

## Internal Workflow

1. User writes content in Markdown.
2. On save, Markdown converts to HTML.
3. Excerpt is generated automatically.
4. Slug is created from title.
5. Published scope filters visible posts.
6. Reading time is calculated dynamically.

---

## Database Table Structure

Table: posts

Columns:

* id
* title
* slug
* content_markdown
* content_html
* excerpt
* is_published
* published_at
* created_at
* updated_at

---

## Additional Enhancements You Can Add

* Authentication system
* Categories and tags
* Comment system
* Full-text search
* Image upload support
* REST API endpoints
* Caching for converted HTML
* SEO meta tags
* Sitemap generation
* RSS feed

---

## Best Practices

* Escape unsafe HTML input
* Validate all form inputs
* Protect admin routes with authentication
* Cache heavy queries
* Use scheduled publishing carefully

---

## Use Cases

* Personal blogging platform
* Technical documentation system
* Developer portfolio blog
* Markdown-based CMS
* Learning Laravel project

---

## License

MIT License

