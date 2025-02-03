<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestCreatorController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\ChapterlistController;
use App\Http\Controllers\ReviewsRatingController;
use App\Http\Controllers\QuestsChapterController;
use App\Http\Controllers\BossController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserAnswerController;


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
    Route::post('/quests/{quest}/reviews', [ReviewsRatingController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{id}', [ReviewsRatingController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/quests/{quest}', [QuestController::class, 'show'])->name('quests.show');
    Route::delete('/reviews/{id}', [ReviewsRatingController::class, 'destroy'])->name('reviews.destroy');
    
    # To go to Chapterlist page
    Route::get('/quests/{id}/chapters', [ChapterlistController::class, 'viewChapterList'])
    ->name('quests.chapters');



    //For Creators
    # To go to Creator Mypage
    Route::get('/creator/{id}', [QuestCreatorController::class, 'viewCreatorMyPage'])->name('questcreators.creatorMyPage');
    Route::get('/player/chapterlist', [ChapterlistController::class, 'viewChapterList']);
    Route::get('/create',[QuestController::class,'viewCreateQuest'])->name('quests.create');
    Route::get('/creator/{id}/profile',[QuestCreatorController::class,'viewCreatorProfile'])->name('questcreators.profile.view');
    Route::get('/creator/{id}/profile/edit', [QuestCreatorController::class, 'editCreatorProfile'])->name('questcreators.profile.edit');
    Route::put('/questcreator/{id}/update',[QuestCreatorController::class,'update'])->name('questcreator.update');
    
    Route::group(['prefix' => 'quests/{quest_id}', 'as' => 'quests.bosses.'], function(){
        # Bosses 
        Route::get('/boss/create',[BossController::class,'create'])->name('create');
        Route::post('/boss/store',[BossController::class,'store'])->name('store');
        Route::get('/boss/manage', [BossController::class, 'manage'])->name('manage');


        # Questions
        Route::get('/boss/{id}/question/create',[QuestionController::class,'create'])->name('questions.create');
        Route::post('/boss/{id}/question/store',[QuestionController::class,'store'])->name('questions.store');

        
    });

    # user answers
    Route::get('/{quest_id}/boss/{boss_id}/start', [UserAnswerController::class, 'start'])->name('start');
    Route::post('/{quest_id}/boss/{boss_id}/submit', [UserAnswerController::class, 'submit'])->name('submit');
    Route::get('/{quest_id}/boss/{boss_id}/result', [UserAnswerController::class, 'result'])->name('result');


});

