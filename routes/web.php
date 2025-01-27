<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\QuestCreatorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/test', [UserController::class, 'viewTestSwitch']);
Route::post('/questcreator/store', [QuestCreatorController::class, 'store'])->name('questcreator.store');
Route::get('/creatorMyPage', [QuestCreatorController::class, 'viewCreatorMyPage'])->name('questcreators.creatorMyPage');

Route::get('/quests', [QuestController::class, 'index'])->name('quests.index');
Route::get('/quests/create', [QuestController::class, 'create'])->name('quests.create');
Route::post('/quests/store', [QuestController::class, 'store'])->name('quests.store');
