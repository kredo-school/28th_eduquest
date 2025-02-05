<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestCreatorController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\GuestCreator\CreatorController;

Route::get('/', function () {
    $quests = \App\Models\Quest::with(['categories', 'questCreator'])
        ->orderBy('created_at', 'desc')
        ->paginate(12);
    
    return view('welcome', compact('quests'));
});

Auth::routes();
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

// player.switchルートを追加
Route::get('/player/switch/{quest}', [PlayerController::class, 'switch'])->name('player.switch');

Route::group(['middleware' => 'auth'], function(){

    // for Player
    # To go to Home page
    Route::get('/home', [HomeController::class, 'show']);
    # To go to Switch to Quest Creator page
    Route::get('/switch/{id}', [UserController::class, 'viewSwitchToCreator'])->name('player.switch');
    # To store Creator Info in Switch ~ Creator page
    Route::post('/questcreator/store',[QuestCreatorController::class,'store'])->name('questcreator.store');


});

// クエストのチャプター関連のルート
Route::middleware(['auth'])->group(function () {
    // クエスト関連のルート
    Route::get('/quests', [QuestController::class, 'index'])->name('quests.index');
    Route::get('/quests/create', [QuestController::class, 'create'])->name('quests.create');
    Route::post('/quests', [QuestController::class, 'store'])->name('quests.store');
    Route::get('/quests/{quest}', [QuestController::class, 'show'])->name('quests.show');
    Route::get('/quests/{quest}/edit', [QuestController::class, 'edit'])->name('quests.edit');
    Route::put('/quests/{quest}', [QuestController::class, 'update'])->name('quests.update');
    Route::delete('/quests/{quest}', [QuestController::class, 'destroy'])->name('quests.destroy');

    // チャプター関連のルート
    Route::get('/quests/{quest}/chapters', [QuestController::class, 'showChapters'])->name('quests.chapters');
});

// ゲストクリエイター関連のルート
Route::get('/creator/mypage', [CreatorController::class, 'myPage'])
    ->name('questcreators.creatorMyPage');

Route::get('/creator/how-to-guide', [CreatorController::class, 'howToGuide'])
    ->name('questcreators.how-to-guide');

Route::get('/creator/profile', [CreatorController::class, 'profile'])
    ->name('questcreators.profile.view');

Route::get('/creator/profile/edit', [CreatorController::class, 'edit'])
    ->name('questcreators.profile.edit');

