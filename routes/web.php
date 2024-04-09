<?php

use Illuminate\Support\Facades\Route;
use Nody\NodyBlog\Http\Controllers\BlogController;

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index')->middleware('web');
Route::get('/blog/{categorySlug}/{postSlug}', [BlogController::class, 'show'])->name('blog.show')->middleware('web');
