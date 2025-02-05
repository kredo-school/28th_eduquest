<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestCreatorController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

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

    //For Creators
    # To go to Creator Mypage
    Route::get('/creator/{id}', [QuestCreatorController::class, 'viewCreatorMyPage'])->name('questcreators.creatorMyPage');
});

Route::get('/admin', function () {
    return view('admin.admin');
});

// カテゴリー編集ページのルートを追加
Route::get('/admin/edit-category', function () {
    $categories = App\Models\Category::all();
    return view('admin.edit-category', compact('categories'));
});

// カテゴリ－の名前を変更するルートを追加
Route::post('/admin/category/rename/{id}', function ($id) {
    $category = App\Models\Category::findOrFail($id);
    $category->category_name = request()->input('category_name');
    $category->save();
    return response()->json(['success' => true]);
});

Route::delete('/admin/category/delete/{id}', function ($id) {
    $category = App\Models\Category::findOrFail($id);
    $category->delete();
    return response()->json(['success' => true]);
});

Route::post('/admin/category/create', function () {
    $category = new App\Models\Category();
    $category->category_name = request()->input('category_name');
    $category->save();
    return response()->json(['success' => true]);
});

Route::post('/admin/category', [CategoryController::class, 'store']);
Route::put('/admin/category/{id}', [CategoryController::class, 'update']);
Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy']);

