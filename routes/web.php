<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestCreatorController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/test', [UserController::class, 'viewTestSwitch']);

// Route::post('/quest-creator/store',[QuestCreatorController::class,'store'])->name('questcreators.store');
Route::post('/quest-creator/store', [QuestCreatorController::class, 'store'])->name('questcreator.store');


Route::get('/creatorMyPage',[QuestCreatorController::class,'creatorMyPage']);