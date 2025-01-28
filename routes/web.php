<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChapterlistController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/player/chapterlist', [ChapterlistController::class, 'viewChapterList']);

Route::get('/quests/{quest}', [QuestController::class, 'show'])->name('quests.show');

Route::get('/quests/category/{category}', [QuestController::class, 'indexByCategory'])->name('quests.category');
