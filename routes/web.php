
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;

// Direct the root route to the MovieController index method
Route::get('/', [MovieController::class, 'index']);

// Actor Routes
Route::get('/actor', [ActorController::class, 'index'])->name('actor.index');
Route::get('/actor/{actor}', [ActorController::class, 'show'])->name('actor.show');

// Movie routes
Route::get('/movies', [MovieController::class, 'index'])->name('movie.index');
Route::get('/movies/search', [MovieController::class, 'search'])->name('movie.search');
Route::get('/movies/categories', [MovieController::class, 'categories'])->name('movie.categories');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movie.show');

//Search
Route::get('/search-movies', [MovieController::class, 'searchApi'])->name('movie.search.ajax');

