<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinationController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::view('/destinations', 'destinations');
Route::view('/categories', 'categories');

Route::get('/destinations/search', [DestinationController::class, 'search'])
     ->name('destinations.search');
Route::get('/destination/{id}', [DestinationController::class, 'show'])
     ->name('destination.show');
