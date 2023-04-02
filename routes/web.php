<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('/posts/{id}/comments', [PostController::class, 'addComment'])->name('posts.addComment');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::put('/posts/{id}/comments', [PostController::class, 'updateComment'])->name('posts.updateComment');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
// delete comments
Route::delete('/posts/{id}/comments', [PostController::class, 'deleteComment'])->name('posts.deleteComment'); //?? parameter
