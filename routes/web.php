<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestCreatorController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    $quests = \App\Models\Quest::with(['categories', 'creator'])
        ->orderBy('created_at', 'desc')
        ->paginate(12);
    
    return view('welcome', compact('quests'));
});

Auth::routes();
<<<<<<< HEAD
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'show']);
Route::get('/test', [UserController::class, 'viewTestSwitch']);
Route::post('/questcreator/store',[QuestCreatorController::class,'store'])->name('questcreator.store');
Route::get('/creatorMyPage', [QuestCreatorController::class, 'creatorMyPage'])->name('creatorMyPage');
Route::get('/player/questlist', [QuestController::class, 'showList'])->name('questlist');

// カテゴリー別クエスト表示のルート
Route::get('/quests/category/{category}', function($category) {
    $quests = \App\Models\Quest::whereHas('categories', function($query) use ($category) {
        $query->where('categories.id', $category);
    })
    ->with(['categories', 'creator'])
    ->orderBy('created_at', 'desc')
    ->paginate(12);

    $currentCategory = \App\Models\Category::find($category);
    
    return view('welcome', compact('quests', 'currentCategory'));
})->name('quests.category');
=======

Route::group(['middleware' => 'auth'], function(){

    // for Player
    # To go to Home page
    Route::get('/home', [HomeController::class, 'show']);
    # To go to Switch to Quest Creator page
    Route::get('/switch/{id}', [UserController::class, 'viewSwitchToCreator'])->name('player.switch');
    # To store Creator Info in Switch ~ Creator page
    Route::post('/questcreator/store',[QuestCreatorController::class,'store'])->name('questcreator.store');


});

>>>>>>> 508f1d7a220d6a9c3dcdfbe2db200f3afa70b45c
