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
Route::post('/questcreator/store',[QuestCreatorController::class,'store'])->name('questcreator.store');
Route::get('/creatorMyPage', [QuestCreatorController::class, 'creatorMyPage'])->name('creatorMyPage');

# Show the News Modal Window　in Home Page
Route::get('/home', [HomeController::class, 'index'])->name('home');