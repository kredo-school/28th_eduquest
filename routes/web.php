<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChapterlistController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\QuestsChapterController;
use App\Http\Controllers\ReviewsRatingController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/player/chapterlist/{id}', [ChapterlistController::class, 'viewChapterList']);

//Quest
Route::get('/quests/{id}', [QuestController::class, 'show'])->name('quest.show');
Route::post('/users/{id}/assign-quest', [QuestController::class, 'assignQuestToUser'])->name('quest.assign');

//quest Creator
Route::get('/quest_creators/{id}', [QuestCreatorController::class, 'show'])->name('quest_creator.show');
Route::post('/users/{id}/assign-quest', [QuestCreatorController::class, 'assignQuestToUser'])->name('quest_creator.assign');

//Quest Chapter
Route::get('/quests_chapter/{id}', [QuestsChapterController::class, 'show'])->name('quests_chapter.show');
Route::post('/quest/{id}/assign-quest', [QuestsChapterController::class, 'assignQuestToUser'])->name('quests_chapter.assign');

//ReviewRating
Route::post('/quests/{quest}/reviews', [ReviewsRatingController::class, 'store'])->name('reviews.store');
Route::delete('/reviews/{id}', [ReviewsRatingController::class, 'destroy'])->name('reviews.destroy');
Route::get('/quests/{quest}', [QuestController::class, 'show'])->name('quests.show');
Route::delete('/reviews/{id}', [ReviewsRatingController::class, 'destroy'])->name('reviews.destroy');



