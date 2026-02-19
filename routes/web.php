<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// IMPORTANT: The create route MUST come before the show route
// This route should be /posts/create, not /posts/{slug}
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// This route must come AFTER the create route
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

// Other routes
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');