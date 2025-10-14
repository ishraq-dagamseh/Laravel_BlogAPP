<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
// Basic Route
Route::get('/hello', function () { return "Hello Laravel!"; });
// Basic GET Route
Route::get('/', [PostController::class, 'index']);
// Route Parameters
Route::get('/post/{id}', [PostController::class, 'show']);
// Constraints
Route::get('/post/{id}', [PostController::class, 'show'])->where('id','[0-9]+');
// Named Route
Route::get('/about', fn()=> 'About Page')->name('about.page');
// Group & Prefix
Route::prefix('admin')->group(function () {
Route::get('/dashboard', fn()=> 'Admin Dashboard');
});
// Verb Methods
Route::post('/post', [PostController::class, 'store']);
// Middleware
Route::middleware('auth')->group(function () {
Route::get('/profile', fn()=> 'User Profile');
});
// Redirect & View
Route::redirect('/old-home', '/');
Route::view('/contact', 'contact');