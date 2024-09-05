<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactusController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route to the welcome view (typically your landing page)
Route::get('/', [HomeController::class, 'index']);

// Route to show the contact form
Route::get('/contactus', [ContactusController::class, 'show'])->name('contactus.show');

// Route to handle contact form submission
Route::post('/contactus', [ContactusController::class, 'store'])->name('contactus.store');

// Route to test email functionality 
Route::get('/about', [AboutController::class, 'show']);

// Authentication routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth'); 

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');
Route::get('/admin/users', [AdminController::class, 'viewUsers'])->name('admin.users');
Route::get('/admin/add', [AdminController::class, 'create'])->name('admin.add');

Route::post('/admin/add', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/posts', [AdminController::class, 'viewPosts'])->name('admin.posts');
Route::delete('/admin/posts/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
Route::get('/admin/comments', [AdminController::class, 'show'])->name('admin.comments');
Route::delete('/admin/comments/{id}', [AdminController::class, 'destroyy'])->name('comments.destroyy');
Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

Route::get('/admin/posts/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/posts/{id}', [AdminController::class, 'update'])->name('admin.posts.update');

Route::resource('posts', PostController::class);

// In web.php
// In your web.php or api.php (routes file)
Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
Route::post('/posts/{post}/dislike', [PostController::class, 'dislike'])->name('posts.dislike');
Route::post('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// web.php
// web.php
Route::get('/settings/likedposts', [PostController::class, 'showLikedPosts'])->name('liked.posts');




// Display all comments for the authenticated user
// Display all comments for the authenticated user
Route::get('/showcomment', [CommentController::class, 'index'])->name('showcomment.index');

// Show the edit form for a specific comment
Route::get('/showcomment/{id}/edit', [CommentController::class, 'edit'])->name('showcomment.edit');

// Update a specific comment
Route::put('/showcomment/{id}', [CommentController::class, 'update'])->name('showcomment.update');

// Delete a specific comment
Route::delete('/showcomment/{id}', [CommentController::class, 'destroyy'])->name('showcomment.destroyy');

//
Route::get('/settings/likedposts', [PostController::class, 'likedPosts'])->name('likedposts.likedPosts');
Route::get('/settings/addpost', [PostController::class, 'creat'])->name('settings.addpost');

Route::post('/settings/addpost', [PostController::class, 'stor'])->name('addpost.stor');
Route::get('/settings/showpost', [PostController::class, 'showUserPosts'])->name('user.posts');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.delete');
// Routes for editing posts
Route::get('/settings/posts/{id}/edit', [PostController::class, 'edit'])->name('settings.posts.edit');
Route::put('/settings/posts/{id}', [PostController::class, 'update'])->name('settings.posts.update');


// Route::put('/comments/{id}', [CommentController::class, 'update'])->name('showcomment.update');
// Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('showcomment.destroy');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');

Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/replies/{id}/edit', [CommentController::class, 'edit'])->name('replies.edit');
Route::put('/replies/{id}', [CommentController::class, 'update'])->name('replies.update');
Route::delete('/replies/{id}', [CommentController::class, 'destroy'])->name('replies.destroy');

Route::post('/comments/{comment}/reply', [CommentController::class, 'replyToComment'])->name('comments.reply');
// Add this route definition if it's not present
Route::post('/comments/{comment}/replies', [CommentController::class, 'storeReply'])->name('comments.store.reply');


Route::get('/settings/notification', [CommentController::class, 'showw'])->name('settings.notification');
Route::get('/settings/reply', [CommentController::class, 'showe'])->name('settings.reply');
// 

Route::get('/show', [PostController::class, 'index'])->name('show.index');
// Route::get('/menu', [PostController::class, 'lign'])->name('menu.lign');
// Route::get('/menu', [PostController::class, 'showMenu']);
Route::get('/categorie/{categorie}', [PostController::class, 'categorie'])->name('posts.categorie');




Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');;
Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
Route::post('/profil/update-password', [ProfilController::class, 'updatePassword'])->name('profil.updatePassword');


// Route for authenticated users' home
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/default', [DefaultController::class, 'index'])->name('default');
// Protected routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Add protected routes here
    // Example: Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Catch-all route for other pages
Route::get('/{any}', function () {
    return view('layouts.app');  // Use 'layouts.app' for views in the 'layouts' directory
})->where('any', '.*');
