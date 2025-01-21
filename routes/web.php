<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChapterlistController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/player/chapterlist', [ChapterlistController::class, 'viewChapterList']);
