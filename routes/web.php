<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes (laman utama blog)
|--------------------------------------------------------------------------
|
*/

// Homepage
Route::get('/', [BlogController::class, 'index'])->name('home');

Route::resource('blog', BlogController::class);

// Halaman form create blog (HARUS ditempatkan sebelum /blog/{blog} agar tidak bentrok)
Route::middleware('auth')->group(function () {
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');

    // Untuk update profil
    Route::get('/profile', [AuthController::class, 'profileForm'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    // Simpan komentar untuk blog (harus login)
    Route::post('/blog/{blog}/comment', [CommentController::class, 'store'])->name('comment.store');

    Route::post('/blog/{blog}/like', [BlogController::class, 'like'])->name('blog.like');
    Route::get('/posts', [BlogController::class, 'myPosts'])->name('auth.posts');

    Route::get('/cattag', [BlogController::class, 'myCattag'])->name('auth.cattag');
    Route::post('/cattag', [BlogController::class, 'storeCategory'])->name('category.store');
    Route::delete('/categories/{category}', [BlogController::class, 'destroyCategory'])->name('category.destroy');

});


/*
|--------------------------------------------------------------------------
| Halaman autentikasi sebelum akses login/register
|--------------------------------------------------------------------------
|
*/

Route::get('/auth/login-register', function () {
    return view('auth.protect'); // form input password
})->name('login.register.auth');

Route::post('/auth/login-register', function (Request $request) {
    if ($request->password === env('LOGIN_PWD')) { // Atur di .env
        session(['access_login_register' => true]); // Simpan di session
        return redirect()->intended(route('login')); // Kembali ke tujuan awal
    }
    sleep(rand(1, 3)); // Anti brute force
    return back()->with('error', 'Password salah!');
})->middleware('throttle:5,30')->name('login.register.auth.submit');


/*
|--------------------------------------------------------------------------
| Auth Routes (Login, Register, Logout)
|--------------------------------------------------------------------------
|
*/


// Form login
Route::get('/login', function (Request $request) {
    if (!$request->session()->has('access_login_register')) {
        return redirect()->route('login.register.auth');
    }
    return app(AuthController::class)->loginForm($request);
})->name('login');

// Proses login
Route::post('/login', function (Request $request) {
    if (!$request->session()->has('access_login_register')) {
        return redirect()->route('login.register.auth');
    }
    return app(AuthController::class)->login($request);
});

// Form register
Route::get('/register', function (Request $request) {
    if (!$request->session()->has('access_login_register')) {
        return redirect()->route('login.register.auth');
    }
    return app(AuthController::class)->registerForm($request);
})->name('register');

// Proses register
Route::post('/register', function (Request $request) {
    if (!$request->session()->has('access_login_register')) {
        return redirect()->route('login.register.auth');
    }
    return app(AuthController::class)->register($request);
});

// Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);

// Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);


// Logout (POST agar aman)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/search', [SearchController::class, 'results'])->name('search.results');

// Menampilkan detail blog
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');

//route kategory dimanapun
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
