<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminCtrl::class, 'index'])->name('admin.index')->middleware('auth');

// +-------------------------------------+
// |                 Post                |
// +-------------------------------------+
Route::get('/post/{post}/show', [App\Http\Controllers\PostCtrl::class, 'show'])->name('post.show');
Route::get('/post/index', [App\Http\Controllers\PostCtrl::class, 'index'])->name('post.index')->middleware(['auth', 'role:moderator']);
Route::get('/post/create', [App\Http\Controllers\PostCtrl::class, 'create'])->name('post.create')->middleware('auth');
Route::post('/post/create', [App\Http\Controllers\PostCtrl::class, 'store'])->name('post.create')->middleware('auth');
Route::delete('/post/delete/{post}', [App\Http\Controllers\PostCtrl::class, 'destroy'])->name('post.destroy')->middleware('auth');
Route::get('/post/edit/{post}', [App\Http\Controllers\PostCtrl::class, 'edit'])->name('post.edit')->middleware('auth');
Route::patch('/post/update/{post}', [App\Http\Controllers\PostCtrl::class, 'update'])->name('post.update')->middleware('auth');

// +-------------------------------------+
// |                 User                |
// +-------------------------------------+
Route::get('/user/index', [App\Http\Controllers\UserCtrl::class, 'index'])->name('user.index')->middleware(['auth', 'role:admin']);
Route::get('/user/{user}/profile', [App\Http\Controllers\UserCtrl::class, 'show'])->name('user.profile')->middleware('auth');
Route::get('/user/{user}/profile/edit', [App\Http\Controllers\UserCtrl::class, 'edit'])->name('user.profile.edit')->middleware('auth');
Route::patch('/user/{user}/profile/update', [App\Http\Controllers\UserCtrl::class, 'update'])->name('user.profile.update')->middleware('auth');
Route::delete('/user/{user}/destroy', [App\Http\Controllers\UserCtrl::class, 'destroy'])->name('user.destroy')->middleware('auth');
Route::get('/user/{user}/role/edit', [App\Http\Controllers\UserCtrl::class, 'role_edit'])->name('user.role.edit')->middleware(['auth', 'role:admin']);
Route::post('/user/{user}/{role}/attach', [App\Http\Controllers\UserCtrl::class, 'role_attach'])->name('user.role.attach')->middleware(['auth', 'role:admin']);
Route::post('/user/{user}/{role}/detach', [App\Http\Controllers\UserCtrl::class, 'role_detach'])->name('user.role.detach')->middleware(['auth', 'role:admin']);

// +-------------------------------------+
// |                Comment              |
// +-------------------------------------+
Route::post('/post/{post}/comment', [App\Http\Controllers\CommentCtrl::class, 'store'])->name('comment.store')->middleware('auth');
Route::post('/comment/{comment}/reply', [App\Http\Controllers\CommentCtrl::class, 'reply_store'])->name('reply.store')->middleware('auth');


Route::post('/post/{post}/upvote', [App\Http\Controllers\CommentCtrl::class, 'upvote'])->name('upvote')->middleware('auth');
Route::post('/post/{post}/downvote', [App\Http\Controllers\CommentCtrl::class, 'downvote'])->name('downvote')->middleware('auth');