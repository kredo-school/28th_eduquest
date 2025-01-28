<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestCreatorController;
use App\Http\Controllers\QuestController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home/{id}', [HomeController::class, 'show']);
Route::get('/switch', [UserController::class, 'viewSwitchToCreator'])->name('player.switch');
Route::post('/questcreator/store',[QuestCreatorController::class,'store'])->name('questcreator.store');
Route::get('/creatorMyPage', [QuestCreatorController::class, 'creatorMyPage'])->name('creatorMyPage');
Route::get('/player/questlist', [QuestController::class, 'showList'])->name('questlist');
