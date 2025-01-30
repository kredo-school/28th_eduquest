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
        $quest_creator = QuestCreator::findOrFail($id);

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

        // ビューにデータを渡す
        return view('players.quests.chapterlist', compact(
            'quest', 
            'quest_creator', 
            'quests_chapters', 
            'user', 
            'user_review', 
            'other_reviews'
        ));
    }
}
