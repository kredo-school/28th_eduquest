<?php

namespace App\Http\Controllers;

use App\Models\ReviewsRating;
use App\Models\Quest;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewsRatingController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index($questId)
    {
        // クエストに関連するレビューの評価別の集計
        $ratingsCount = ReviewsRating::select('rating', DB::raw('count(*) as count'))
            ->where('quest_id', $questId) // クエストに関連したレビューを絞り込む
            ->groupBy('rating')
            ->get();

        // レビュー全体の件数
        $totalReviews = ReviewsRating::where('quest_id', $questId)->count();

        // 各評価の割合を計算
        $ratingPercentages = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingPercentages[$i] = 0; // 初期化（ゼロに設定）
        }

        foreach ($ratingsCount as $rating) {
            $percentage = ($rating->count / $totalReviews) * 100;
            $ratingPercentages[$rating->rating] = round($percentage, 2); // 小数点2桁まで
        }

        // ビューにデータを渡す
        return view('players.quests.chapterlist', compact('ratingPercentages', 'questId'));
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
        ReviewsRating::updateOrCreate(
            ['user_id' => auth()->id(), 'quest_id' => $questId],
            ['review' => $request->review, 'rating' => $request->rating]
        );

        // 成功メッセージとともにリダイレクト
        return redirect()->route('players.quests.chapterlist', ['questId' => $questId])->with('success', 'Review added successfully!');
    }
    
    public function destroy($id)
    {
        $review = ReviewsRating::findOrFail($id);
    
        // レビューを削除
        $review->delete();
    
        return response()->json(['success' => true, 'message' => 'Deleted']);
    }
    
    

}


