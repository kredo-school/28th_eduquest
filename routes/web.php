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

    //quest Creator
    Route::get('/quest_creators/{id}', [QuestCreatorController::class, 'show'])->name('quest_creator.show');
    Route::post('/users/{id}/assign-quest', [QuestCreatorController::class, 'assignQuestToUser'])->name('quest_creator.assign');

    //Quest Chapter
    Route::get('/quests_chapter/{id}', [QuestsChapterController::class, 'show'])->name('quests_chapter.show');
    Route::post('/quest/{id}/assign-quest', [QuestsChapterController::class, 'assignQuestToUser'])->name('quests_chapter.assign');

    //ReviewRating
    Route::delete('/reviews/{id}', [ReviewsRatingController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/quests/{quest}', [QuestController::class, 'show'])->name('quests.show');
    Route::delete('/reviews/{id}', [ReviewsRatingController::class, 'destroy'])->name('reviews.destroy');
    Route::prefix('quests/{questId}')->group(function () {
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    });

    //ViewingChapter
    Route::post('/chapter/{id}/complete', [ChapterController::class, 'complete'])->name('chapter.complete');
    // Chapter viewing (next, prev)
    Route::get('/chapter/{id}', [ChapterController::class, 'viewing'])->name('chapter.viewing');
    

    # To go to Chapterlist page
    Route::get('/quests/{id}/chapters', [ChapterlistController::class, 'viewChapterList'])
    ->name('quests.chapters');

    # To go to viewing page
    Route::get('/quests/{questId}/chapters/{chapterId}', [ChapterController::class, 'viewing'])->name('chapters.viewing');


    //For Creators
    # To go to Creator Mypage
    Route::get('/creator/{id}', [QuestCreatorController::class, 'viewCreatorMyPage'])->name('questcreators.creatorMyPage');

});

