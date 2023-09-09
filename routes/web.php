<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\User\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // author
    Route::group(['prefix' => 'author', 'middleware' => 'admin_auth'], function () {

        // home page
        Route::get('home', function () {
            return redirect()->route('author#profile');
        })->name('author#home');

        // profile
        Route::get('profile', [AuthorController::class, 'index'])->name('author#profile');
        Route::post('updateDetails', [AuthorController::class, 'updateDetails'])->name('author#updateDetails');
        Route::post('changeProfilePicture', [AuthorController::class, 'changeProfilePicture'])->name('author#changeProfilePicture');

        // authors
        Route::get('authorsPage', [AuthorController::class, 'authorsPage'])->name('author#authorsPage');
        Route::post('addAuthors', [AuthorController::class, 'addAuthors'])->name('author#addAuthors');
        Route::get('deleteAuthor/{id}', [AuthorController::class, 'deleteAuthor'])->name('author#deleteAuthor');

        // categories
        Route::get('categories', [CategoryController::class, 'categoryPage'])->name('author#categoryPage');

        // post
        Route::get('addPost', [PostController::class, 'addPost'])->name('author#addPost');
        Route::post('createPost', [PostController::class, 'createPost'])->name('author#createPost');
        Route::get('allPosts', [PostController::class, 'allPosts'])->name('author#allPosts');
        Route::get('editPage/{id}', [PostController::class, 'editPage'])->name('author#editPage');
        Route::post('updatePost/{id}', [PostController::class, 'updatePost'])->name('author#updatePost');
        Route::get('deletePost/{id}', [PostController::class, 'deletePost'])->name('author#deletePost');
    });
    // user
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {

        // home page
        Route::get('home', [BlogController::class, 'index'])->name('user#home');
        Route::get('readPost/{id}', [BlogController::class, 'readPost'])->name('user#readPost');
        Route::get('categoryPosts/{id}', [BlogController::class, 'categoryPosts'])->name('user#categoryPosts');
        Route::get('searchPosts', [BlogController::class, 'searchPosts'])->name('user#searchPosts');
        Route::get('aboutMe', [BlogController::class, 'aboutMe'])->name('user#aboutMe');

        // profile page
        Route::get('profile', [BlogController::class, 'profile'])->name('user#profile');
        Route::post('updateProfile', [BlogController::class, 'updateProfile'])->name('user#updateProfile');
        Route::get('changePassword', [BlogController::class, 'changePasswordPage'])->name('user#changePasswordPage');
        Route::post('changePassword', [BlogController::class, 'changePassword'])->name('user#changePassword');

        // contact
        Route::get('contact', function () {
            return view('user.pages.contact');
        })->name('user#contact');
    });
});
