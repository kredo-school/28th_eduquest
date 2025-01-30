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
Route::get('/creator', [QuestCreatorController::class, 'viewCreatorMyPage'])->name('questcreators.creatorMyPage');

Route::get('/player/chapterlist', [ChapterlistController::class, 'viewChapterList']);
Route::get('/create',[QuestController::class,'viewCreateQuest'])->name('quests.create');

// クエスト一覧表示
Route::get('/quests', [QuestController::class, 'index'])->name('quests.index');

// クエスト削除
Route::delete('/quests/{quest}', [QuestController::class, 'destroy'])->name('quests.destroy');

Route::get('/creator/profile',[QuestCreatorController::class,'viewCreatorProfile'])->name('questcreators.profile.view');
Route::get('/creator/profile/edit', [QuestCreatorController::class, 'editCreatorProfile'])->name('questscreators.profile.edit');
Route::put('/questcreator/update',[QuestCreatorController::class,'update'])->name('questcreator.update');
