<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Moderator;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('{userId}/profile', [UserController::class, 'userProfile'])->name('user.profile');
Route::get('{sectionId}/topics', [TopicController::class, 'topics'])->name('topics');
Route::get('{topicId}/posts', [PostController::class, 'topics'])->name('posts');

//если пользователь вошел в систему, он не попадет на эти маршруты, а перенаправляется на /home
Route::middleware('guest')->group(function () {
    Route::get('register', [UserController::class, 'create'])->name('user.register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'loginAuth'])->name('login.auth');
});

Route::middleware('auth')->group(function () {
    Route::get('profile', [UserController::class, 'myProfile'])->name('my.profile');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::get('{sectionId}/new-topic', [TopicController::class, 'create'])->name('topic.create');
    Route::post('{sectionId}/new-topic', [TopicController::class, 'store'])->name('topic.store');

    Route::get('{topicId}/edit-topic', [TopicController::class, 'edit'])->name('topic.edit');
    Route::post('{topicId}/edit-topic', [TopicController::class, 'storeEdit'])->name('topic.store-edit');
    Route::get('{topicId}/del-topic', [TopicController::class, 'softDel'])->name('topic.soft-del');

    Route::get('{topicId}/new-post', [PostController::class, 'create'])->name('post.create');
    Route::post('{topicId}/new-post', [PostController::class, 'store'])->name('post.store');

    Route::get('{postId}/edit-post', [PostController::class, 'edit'])->name('post.edit');
    Route::post('{postId}/edit-post', [PostController::class, 'storeEdit'])->name('post.store-edit');
    Route::get('{postId}/del-post', [PostController::class, 'softDel'])->name('post.soft-del');

    Route::middleware('auth')->middleware([Moderator::class])->group(function (){
        Route::get('moderator/show-users', [ModeratorController::class, 'showUsers'])->name('moderator.showUsers');
        Route::get('moderator/change-role/{id}', [ModeratorController::class, 'changeRole'])->name('moderator.changeRole');
        Route::get('moderator/change-ban/{id}', [ModeratorController::class, 'changeBanStatus'])->name('moderator.changeBanStatus');
    });
});
