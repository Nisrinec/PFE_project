<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactusController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmailTestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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
Route::get('/contactus', [ContactusController::class, 'show'])->name('contactus.show');

// Route to handle contact form submission
Route::post('/contactus', [ContactusController::class, 'store'])->name('contactus.store');

// Route to test email functionality 
Route::get('/test-email', [EmailTestController::class, 'sendTestEmail']);

// Authentication routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route for authenticated users' home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Protected routes for authenticated users
Route::middleware('auth')->group(function () {
    // Add protected routes here
    // Example: Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Catch-all route for other pages
Route::get('/{any}', function () {
    return view('layouts.app');  // Use 'layouts.app' for views in the 'layouts' directory
})->where('any', '.*');
