<?php

use App\Http\Controllers\ChapterlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/player/chapterlist', [ChapterlistController::class, 'viewChapterList']);
