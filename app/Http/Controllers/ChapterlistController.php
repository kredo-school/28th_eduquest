<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use App\Models\User;
use App\Models\QuestCreator;
use App\Models\QuestsChapter;
use App\Models\ReviewsRating;
use Illuminate\Http\Request;

class ChapterlistController extends Controller
{
    public function viewChapterList($id)
    {
        // クエストの取得（レビューデータも一緒に取得）
        $quest = Quest::with(['reviews_ratings' => function ($query) {
            // レビューを作成したユーザー情報を取得し、レビューIDで並べ替え
            $query->with('user')->orderByDesc('id');
        }])->findOrFail($id);

        // クエスト作成者の情報を取得
        $quest_creator = QuestCreator::findOrFail($quest->quest_creator_id);

        // クエストに紐づくチャプターを取得
        $quests_chapters = QuestsChapter::where('quest_id', $id)->get();

        // ログインしているユーザー情報を取得
        $user = auth()->user();

        // ログインしているユーザーのレビューを取得（なければnull）
        $user_review = ReviewsRating::where('quest_id', $id)
            ->where('user_id', $user->id)
            ->first();

        // 他のユーザーのレビューを取得
        $other_reviews = ReviewsRating::where('quest_id', $id)
            ->where('user_id', '!=', $user->id)
            ->orderByDesc('created_at')  // 最新のレビューが上に来るように並べ替え
            ->get();

        // レビューの評価別集計
        $ratingsCount = ReviewsRating::select('rating', \DB::raw('count(*) as count'))
            ->where('quest_id', $id)
            ->groupBy('rating')
            ->get();

        // レビュー全体の件数
        $totalReviews = ReviewsRating::where('quest_id', $id)->count();

        // 各評価の割合を計算
        $ratingPercentages = [];
        foreach ($ratingsCount as $rating) {
            $percentage = ($rating->count / $totalReviews) * 100;
            $ratingPercentages[$rating->rating] = round($percentage, 2); // 小数点2桁まで
        }

        // ビューにデータを渡す
        return view('players.quests.chapterlist', compact(
            'quest',
            'quest_creator',
            'quests_chapters',
            'user',
            'user_review',
            'other_reviews',
            'ratingPercentages' // 評価の割合データをビューに渡す
        ));
    }

}
