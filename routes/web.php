<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestCreatorController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\ChapterlistController;
use App\Http\Controllers\ReviewsRatingController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\QuestsChapterController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\WelcomeController;


use App\Http\Controllers\FavoriteCreatorController;

use App\Http\Controllers\UserQuestStatusController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    // for Player
    # To go to Home page
    Route::get('/home', [HomeController::class, 'show']);
    # To go to Switch to Quest Creator page
    Route::get('/switch/{id}', [UserController::class, 'viewSwitchToCreator'])->name('player.switch');
    # To store Creator Info in Switch ~ Creator page
    Route::post('/questcreator/store',[QuestCreatorController::class,'store'])->name('questcreator.store');

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
    Route::get('/quests/{quest}', [QuestController::class, 'show'])->name('quests.show');
    Route::delete('/reviews/{id}', [ReviewsRatingController::class, 'destroy'])->name('reviews.destroy');
    Route::prefix('quests/{questId}/reviews')->group(function () {
        Route::get('/', [ReviewsRatingController::class, 'index'])->name('reviews.index');
        Route::post('/store', [ReviewsRatingController::class, 'store'])->name('reviews.store');
    });

    Route::delete('/reviews/{id}', [ReviewsRatingController::class, 'destroy'])->name('reviews.destroy');

    //ViewingChapter
    Route::post('/chapter/{id}/complete', [ChapterController::class, 'complete'])->name('chapter.complete');
    // Chapter viewing (next, prev)
    Route::get('/chapter/{id}', [ChapterController::class, 'viewing'])->name('chapter.viewing');

    //QuestStatus
    Route::post('/start-quest', [ChapterlistController::class, 'startQuest'])->name('startQuest');
    Route::post('/quest/complete', [ChapterController::class, 'completeQuest'])->name('quest.complete');

    # To go to Chapterlist page
    Route::get('/quests/{id}/chapters', [ChapterlistController::class, 'viewChapterList'])
    ->name('quests.chapters');

    # To go to viewing page
    Route::get('/quests/{questId}/chapters/{chapterId}', [ChapterController::class, 'viewing'])->name('chapters.viewing');
    # player mypage
    // Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/test', [UserController::class, 'viewTestSwitch']);
    Route::get('/player/{id}/mypage', [MypageController::class, 'viewMyPage'])->name('player.mypage');

    //Favorite Creator button on creator's profile page
    Route::get('/favorites', [FavoriteCreatorController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{creatorId}', [FavoriteCreatorController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{creatorId}', [FavoriteCreatorController::class, 'destroy'])->name('favorites.destroy');


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

Route::get('/', [WelcomeController::class, 'show'])->name('welcome');

Route::get('/news', function () {
    return view('news');
});


Route::get('/FAQ-Contact', function () {
    return view('FAQ-Contact');
});
