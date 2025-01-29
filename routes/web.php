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

Route::group(['middleware' => 'auth'], function(){

    // for Player
    Route::get('/home', [HomeController::class, 'show']);
    Route::get('/switch/{id}', [UserController::class, 'viewSwitchToCreator'])->name('player.switch');
    Route::post('/questcreator/store',[QuestCreatorController::class,'store'])->name('questcreator.store');


});

