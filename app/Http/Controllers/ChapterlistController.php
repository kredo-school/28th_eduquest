<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use App\Models\User;
use App\Models\QuestCreator;
use App\Models\QuestsChapter;
use App\Models\ReviewsRating;
use App\Models\UserQuest; 
use Illuminate\Http\Request;
use App\Models\UserQuestStatus; 

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
            ->orderByDesc('created_at')  
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
            $ratingPercentages[$rating->rating] = round($percentage, 2); 
        }

        // ユーザーが進行中のクエスト情報を取得
        $userQuest = UserQuest::where('user_id', $user->id)
        ->where('quest_id', $id)
        ->first();
        $userQuestId = $userQuest ? $userQuest->id : null; 

        // 進行中のクエストがあれば開始時刻を取得
        $startTimestamp = $userQuest ? $userQuest->date_started : null;
        $questStatus = $userQuest ? $userQuest->status : null;  

        // ビューにデータを渡す
        return view('players.quests.chapterlist', compact(
            'quest',
            'quest_creator',
            'quests_chapters',
            'user',
            'user_review',
            'other_reviews',
            'ratingPercentages', 
            'startTimestamp',
            'questStatus',
            'userQuestId',
            'userQuest'
        ));
    }
    public function startQuest(Request $request)
    {
        $user = auth()->user();
        $questId = $request->input('quest_id');

        // ユーザーが進行中のクエストを持っているか確認
        $userQuest = UserQuest::where('user_id', $user->id)
                                ->where('quest_id', $questId)
                                ->first();

        if (!$userQuest) {
            // 進行中のクエストがなければ新しく作成
            $userQuest = new UserQuest();
            $userQuest->user_id = $user->id;
            $userQuest->quest_id = $questId;
            $userQuest->status = 1;  // 進行中
            $userQuest->date_started = now();  
            $userQuest->save();
        } else {
            // 既に進行中のクエストがあれば、状態を更新
            $userQuest->status = 1;  // 進行中
            $userQuest->date_started = now();  
            $userQuest->save();
        }

        // user_quest_status テーブルに履歴を追加
        UserQuestStatus::create([
            'user_quest_id' => $userQuest->id,
            'status' => 1,  // 進行中
            'status_date' => now(),
        ]);

        return response()->json([
            'success'   => true,
            'timestamp' => $userQuest->date_started->format('Y-m-d H:i:s'),
            'status'    => $userQuest->status  // ここで現在のステータス（この場合は 1）を返す
        ]);
    }

    public function completeQuest(Request $request)
    {
        $user = auth()->user();
        $questId = $request->input('quest_id');

        // ユーザーのクエスト情報を取得
        $userQuest = UserQuest::where('user_id', $user->id)
            ->where('quest_id', $questId)
            ->first();

        if ($userQuest && $userQuest->status == 1) {
            // ステータスを2（完了）に変更し、date_ended に現在時刻をセット
            $userQuest->status = 2;
            $userQuest->date_ended = now();
            $userQuest->save();

            // user_quest_status テーブルに完了ステータスの履歴を追加
            UserQuestStatus::create([
                'user_quest_id' => $userQuest->id,
                'status' => 2,  // 完了
                'status_date' => now(),
            ]);

            return response()->json([
                'success'   => true,
                'timestamp' => $userQuest->date_started->format('Y-m-d H:i:s'),
                'status'    => $userQuest->status,  // 2（完了）
                'date_ended' => $userQuest->date_ended->format('Y-m-d H:i:s') // 完了時刻
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Quest already completed or not found.'
        ], 400);
    }
}
