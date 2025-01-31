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

    
    # To go to Home page
    Route::get('/home', [HomeController::class, 'show']);
    
    /**
     * for Player page
     */
    # My page
    # To go to Switch to Quest Creator page
    Route::get('/switch/{id}', [UserController::class, 'viewSwitchToCreator'])->name('player.switch');

    # To store Creator Info in Switch ~ Creator page
    Route::post('/questcreator/store',[QuestCreatorController::class,'store'])->name('questcreator.store');

    # To go to Account Security page
    Route::get('/account-security/{id}', [UserController::class, 'viewAccountSecurity'])->name('account.security');

    # To go to Delete My Account page
    Route::get('/delete-my-account/{id}', [UserController::class, 'viewDeleteAccount'])->name('delete.account');

    # To update email address
    Route::patch('/update/emailaddress', [UserController::class, 'updateEmailAddress'])->name('update.emailaddress');
    
    # To update password
    Route::patch('/update/password', [UserController::class, 'updatePassword'])->name('update.password');




});

