<?php

use Illuminate\Support\Facades\Route;
use Nody\NodyBlog\Http\Controllers\BlogController;

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index')->middleware('web');
