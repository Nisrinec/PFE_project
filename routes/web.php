<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Http\Controllers\EmailTestController;
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
Route::get('/', function () {
    return view('home');  // Directing root URL to 'home.blade.php'
});

// Route to show the contact form
// Route to show the contact form
Route::get('/contactus', [ContactusController::class, 'show'])->name('contactus.show');

// Route to handle contact form submission
Route::post('/contactus', [ContactusController::class, 'store'])->name('contactus.store');

// Route to handle all other routes and serve your main app view

Route::get('/test-email', [EmailTestController::class, 'sendTestEmail']);


Route::get('/{any}', function () {
    return view('layouts.app');  // Use 'layouts.app' for views in the 'layouts' directory
})->where('any', '.*');


// Authentication routes
Auth::routes();

// Route for authenticated users' home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Protected routes for authenticated users
Route::middleware('auth')->group(function () {
    // Add protected routes here
});
