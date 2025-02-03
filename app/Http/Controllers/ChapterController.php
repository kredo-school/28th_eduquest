<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestsChapter;
use App\Models\Quest;
use App\Models\User;
use App\Models\ReviewsRating;


class ChapterController extends Controller
    {
         //チャプターの視聴のための
    public function viewing($questId, $chapterId)
    {
        // クエスト情報を取得
        $quest = Quest::findOrFail($questId);
    
        // クリックされたチャプター情報を取得
        $chapter = QuestsChapter::where('quest_id', $questId)->where('id', $chapterId)->firstOrFail();
    
        $nextChapter = QuestsChapter::where('quest_id', $chapter->quest_id)
            ->where('id', '>', $chapterId) 
            ->orderBy('id')
            ->first();
    
        $prevChapter = QuestsChapter::where('quest_id', $chapter->quest_id)
            ->where('id', '<', $chapterId)  
            ->orderBy('id', 'desc')
            ->first();
        
        $otherChapters = QuestsChapter::where('quest_id', $questId)
            ->where('id', '!=', $chapterId)
            ->orderBy('id')
            ->get();

         // 最後のチャプターかどうか
        $isLastChapter = $nextChapter === null;
    
    
        return view('players.quests.viewingchapter', compact('quest', 'chapter', 'nextChapter', 'prevChapter', 'otherChapters', 'isLastChapter'));
    }
        public function complete(Request $request, $id)
        {
            $chapter = QuestsChapter::findOrFail($id);
            $quest = Quest::findOrFail($chapter->quest_id);

            // ユーザーの完了データを保存（例：データベースの完了フラグを更新）
            $request->user()->completedChapters()->attach($chapter->id);

            // すべてのチャプターを完了しているかチェック
            $completedCount = $request->user()->completedChapters()->where('quest_id', $quest->id)->count();
            $totalChapters = $quest->chapters->count();

            if ($completedCount === $totalChapters) {
                return response()->json(['last' => true]);
            }

            return response()->json(['last' => false]);
        }
    }

