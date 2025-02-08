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

<<<<<<< HEAD

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

=======
    //Quest
    Route::get('/quests/{id}', [QuestController::class, 'show'])->name('quest.show');
    Route::post('/users/{id}/assign-quest', [QuestController::class, 'assignQuestToUser'])->name('quest.assign');
    Route::get('/quests/create',[QuestController::class,'create'])->name('quests.create');
    Route::post('/quests/store', [QuestController::class, 'store'])->name('quests.store');
    Route::get('/quests/{id}/edit', [QuestController::class, 'edit'])->name('quests.edit');
    Route::post('/quests/update/{id}', [QuestController::class, 'update'])->name('quests.update');
    Route::get('/quests', [QuestController::class, 'index'])->name('quests.index');
    Route::delete('/quests/delete/{id}', [QuestController::class, 'destroy'])->name('quests.destroy');



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
    
    # To go to Chapterlist page
    Route::get('/quests/{id}/chapters', [ChapterlistController::class, 'viewChapterList'])
    ->name('quests.chapters');



    //For Creators
    # To go to Regulation page
    Route::get('/creator/regulation/{id}', [QuestCreatorController::class, 'showRegulation'])->name('questcreators.regulation');

    # To go to Creator Mypage
    Route::get('/creator/{id}', [QuestCreatorController::class, 'viewCreatorMyPage'])->name('questcreators.creatorMyPage');
    Route::get('/player/chapterlist', [ChapterlistController::class, 'viewChapterList']);
    Route::get('/create',[QuestController::class,'viewCreateQuest'])->name('quests.create');
    Route::get('/creator/{id}/profile',[QuestCreatorController::class,'viewCreatorProfile'])->name('questcreators.profile.view');
    Route::get('/creator/{id}/profile/edit', [QuestCreatorController::class, 'editCreatorProfile'])->name('questcreators.profile.edit');
    Route::put('/questcreator/{id}/update',[QuestCreatorController::class,'update'])->name('questcreator.update');
    Route::get('/guide-explanation', [QuestCreatorController::class, 'guideExplanation'])->name('questcreators.guide-explanation');

    // For how to guide page
    Route::get('/creator-guide', [QuestCreatorController::class, 'creatorGuide'])->name('questcreators.how-to-guide');
    Route::get('/guide-explanation', [QuestCreatorController::class, 'guideExplanation'])->name('questcreators.guide-explanation');

});

>>>>>>> f6870c683518bae3c1ddbf70ff10f08af877986e
