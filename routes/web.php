<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


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
// aUTH Group
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/posts/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{id}/comments', [PostController::class, 'addComment'])->name('posts.addComment');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::put('/posts/{id}/comments', [PostController::class, 'updateComment'])->name('posts.updateComment');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::delete('/posts/{id}/comments', [PostController::class, 'deleteComment'])->name('posts.deleteComment');
});

Auth::routes();


Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    if(request()->has('error')) {
        return redirect()->to('/');
    }
    $githubUser = Socialite::driver('github')->user();
    $user = User::where('email', $githubUser->getEmail())->first();

    if(!$user) {
        $user = User::create([
            'name' => $githubUser->getName(),
            'email' => $githubUser->getEmail(),
            'password' => bcrypt("12345678"),
            'provider_id' => $githubUser->getId(),
            'provider_name' => 'github',
        ]);
    }else if($user->provider_id == null){
            $user->update([
                'provider_id' => $githubUser->getId(),
                'provider_name' => 'github',
            ]);
    }

    Auth::login($user, true);

    return redirect()->to('/');

});
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();

});

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();
    $user = User::where('email', $googleUser->getEmail())->first();

    if(!$user) {
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt("12345678"),
            'provider_id' => $googleUser->getId(),
            'provider_name' => 'google',
        ]);
    }else if($user->provider_id == null){
            $user->update([
                'provider_id' => $googleUser->getId(),
                'provider_name' => 'google',
            ]);
    }

    Auth::login($user);

    return redirect('/posts');
});
