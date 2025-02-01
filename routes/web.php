<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestCreatorController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\ChapterlistController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/test', [UserController::class, 'viewTestSwitch']);

Route::post('/questcreator/store',[QuestCreatorController::class,'store'])->name('questcreator.store');
Route::get('/creatorMyPage', [QuestCreatorController::class, 'viewCreatorMyPage'])->name('questcreators.creatorMyPage');

//Route::get('/player/chapterlist', [ChapterlistController::class, 'viewChapterList']);

// クエスト作成・編集
Route::get('/quests/create',[QuestController::class,'create'])->name('quests.create');
Route::post('/quests/store', [QuestController::class, 'store'])->name('quests.store');
Route::get('/quests/{id}/edit', [QuestController::class, 'edit'])->name('quests.edit');
Route::post('/quests/update/{id}', [QuestController::class, 'update'])->name('quests.update');

// クエスト一覧表示
Route::get('/quests', [QuestController::class, 'index'])->name('quests.index');


// クエスト削除
Route::delete('/quests/delete/{id}', [QuestController::class, 'destroy'])->name('quests.destroy');

