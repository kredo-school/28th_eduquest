<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestCreatorController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\ChapterlistController;
use App\Http\Controllers\ReviewsRatingController;
use App\Http\Controllers\QuestsChapterController;

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
    Route::get('/player/chapterlist/{id}', [ChapterlistController::class, 'viewChapterList']);

    //Quest
    Route::get('/quests/{id}', [QuestController::class, 'show'])->name('quest.show');
    Route::post('/users/{id}/assign-quest', [QuestController::class, 'assignQuestToUser'])->name('quest.assign');

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


    //For Creators
    # To go to Creator Mypage
    Route::get('/creator/{id}', [QuestCreatorController::class, 'viewCreatorMyPage'])->name('questcreators.creatorMyPage');
});

