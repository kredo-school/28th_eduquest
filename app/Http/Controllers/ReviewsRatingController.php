<?php

namespace App\Http\Controllers;

use App\Models\ReviewRating;
use App\Models\Quest;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewsRatingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        //
    }
    
    //クエストにレビューとレーティングを追加する
    public function store(Request $request, $questId)
    {
        // バリデーション
        $request->validate([
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // レビュー＆レーティングの作成または更新
        ReviewRating::updateOrCreate(
            ['user_id' => auth()->id(), 'quest_id' => $questId],
            ['review' => $request->review, 'rating' => $request->rating]
        );

        // 成功メッセージとともにリダイレクト
        return redirect()->route('quests.show', $questId)->with('success', 'レビューとレーティングが送信されました！');
    }
}


