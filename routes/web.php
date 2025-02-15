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
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\StudyPlanController;
use App\Http\Controllers\FavoriteCreatorController;
use App\Http\Controllers\UserQuestStatusController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    
    # To go to Home page
    Route::get('/home', [HomeController::class, 'show'])->name('home');
    
    /**
     * for Player page
     */

    # My page
    # To go to Switch to Quest Creator page
    Route::get('/switch/{id}', [UserController::class, 'viewSwitchToCreator'])->name('player.switch');

    # To store Creator Info in Switch ~ Creator page
    Route::post('/questcreator/store',[QuestCreatorController::class,'store'])->name('questcreator.store');


    # Quest
    Route::get('/quests/{id}', [QuestController::class, 'show'])->name('quest.show');
    Route::post('/users/{id}/assign-quest', [QuestController::class, 'assignQuestToUser'])->name('quest.assign');
    Route::get('/quests/create', [QuestController::class, 'create'])->name('quests.create');
    Route::post('/quests/store', [QuestController::class, 'store'])->name('quests.store');
    Route::get('/quests/{id}/edit', [QuestController::class, 'edit'])->name('quests.edit');
    Route::post('/quests/update/{id}', [QuestController::class, 'update'])->name('quests.update');
    Route::get('/quests', [QuestController::class, 'index'])->name('quests.index');
    Route::delete('/quests/delete/{id}', [QuestController::class, 'destroy'])->name('quests.destroy');

    //quest Creator
    Route::get('/quest_creators/{id}', [QuestCreatorController::class, 'show'])->name('quest_creator.show');
    Route::post('/users/{id}/assign-quest', [QuestCreatorController::class, 'assignQuestToUser'])->name('quest_creator.assign');

    # Quest Chapter
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

    // Studyplan 
    Route::get('/player/{id}/studyplan', [StudyPlanController::class, 'show'])->name('player.studyplan');
    Route::delete('/schedule/{id}/delete', [StudyPlanController::class, 'deleteSchedule'])->name('player.schedule.delete');
    Route::delete('/player/watchlater/{id}', [StudyPlanController::class, 'deleteWatchLater'])
        ->name('player.watchlater.delete');
    Route::get('/player/{id}/watchlater', [StudyPlanController::class, 'watchLater'])->name('player.watchlater');
    Route::post('/player/schedule/{userQuest}', [StudyPlanController::class, 'schedule'])
        ->name('player.schedule');
    Route::put('/player/schedule/{userQuestStatus}', [StudyPlanController::class, 'updateSchedule'])
        ->name('player.schedule.update');

    
    //QuestStatus
    Route::post('/start-quest', [ChapterlistController::class, 'startQuest'])->name('startQuest');
    Route::post('/quest/complete', [ChapterController::class, 'completeQuest'])->name('quest.complete');

    # To go to StudyPlan page
    Route::get('/player/{id}/studyplan', [StudyPlanController::class, 'show'])->name('player.studyplan');

    # To go to Chapterlist page
    Route::get('/quests/{id}/chapters', [ChapterlistController::class, 'viewChapterList'])
    ->name('quests.chapters');

    # To go to viewing page
    Route::get('/quests/{questId}/chapters/{chapterId}', [ChapterController::class, 'viewing'])->name('chapters.viewing');
    
    # player mypage
    Route::get('/player/{id}/mypage', [MypageController::class, 'viewMyPage'])->name('player.mypage');

    //Favorite Creator button on creator's profile page
    Route::get('/favorites', [FavoriteCreatorController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{creatorId}', [FavoriteCreatorController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{creatorId}', [FavoriteCreatorController::class, 'destroy'])->name('favorites.destroy');
    # To go to Account Security page
    Route::get('/account-security/{id}', [UserController::class, 'viewAccountSecurity'])->name('account.security');

    # To update email address
    Route::patch('/update/emailaddress', [UserController::class, 'updateEmailAddress'])->name('update.emailaddress');

    # To update password
    Route::patch('/update/password', [UserController::class, 'updatePassword'])->name('update.password');

    # To go to Delete My Account page
    Route::get('/delete-my-account/{id}', [UserController::class, 'viewDeleteAccount'])->name('delete.account');
    
    # To delete account
    Route::delete('/delete-my-account', [UserController::class, 'destroyAccount'])->name('destroy.account');

    # Watch_Later Toggle
    Route::post('/quest/watch-later/toggle/{questId}', [StatusController::class, 'toggleWatchLater'])->name('watch.later.toggle');

    # To go to the Page of Quest List by Status
    Route::get('player/quest-status/{id}', [StatusController::class, 'viewQuestStatus'])->name('quest.status');

    # To delete the quest in status page
    Route::delete('/player/quest-status/remove/{userQuestId}', [StatusController::class, 'removeQuest']) ->name('quest.status.remove');



    /**
     * For Creators
     */

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

# NEWS
Route::get('/news', [NewsController::class, 'index']);

# FAQ/Contact
Route::get('/FAQ-Contact', [FAQController::class, 'index']);

# Search Result
Route::get('/search', [SearchController::class, 'search'])->name('quest.search');
