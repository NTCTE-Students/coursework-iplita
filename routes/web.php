<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActionsController;
use App\Http\Controllers\ViewsController;

Route::get('/', [ViewsController::class, 'index']) -> name('index');
Route::get('/register', [ViewsController::class, 'register'])->name('register')->middleware('guest');
Route::get('/login', [ViewsController::class, 'login'])->name('login')->middleware('guest');
Route::post('/register', [ActionsController::class, 'register']);
Route::post('/login', [ActionsController::class, 'login']);
Route::get('/logout', [ActionsController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/favorites', [ViewsController::class, 'favorites'])->name('favorites')->middleware('auth');
Route::get('/recipe/create', [ViewsController::class, 'add_recipe'])->name('add_recipe')->middleware('auth');
Route::post('/recipe/create', [ActionsController::class, 'add_recipe'])->name('add_recipe')->middleware('auth');
Route::get('/recipe/{id}', [ViewsController::class, 'recipe'])->name('recipe');
Route::post('/recipe/{id}/favorite', [ActionsController::class, 'favorite'])->name('favorite')->middleware('auth');
Route::post('/recipe/{id}/review', [ActionsController::class, 'review'])->name('review.store')->middleware('auth');
Route::get('/my_recipes', [ViewsController::class, 'my_recipes'])->name('my_recipes')->middleware('auth');
Route::get('/index/{param?}', [ViewsController::class, 'show']);






