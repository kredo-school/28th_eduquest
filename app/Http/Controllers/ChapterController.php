<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestsChapter;
use App\Models\Quest;
use App\Models\User;
use App\Models\ReviewsRating;
use App\Models\UserQuest;
use App\Models\UserQuestStatus;



class ChapterController extends Controller
    {
         //チャプターの視聴のための
    public function viewing($questId, $chapterId)
    {
        // クエスト情報を取得
        $quest = Quest::with('questCreator')->findOrFail($questId);
        $quest_creator = $quest->questCreator;

        // ユーザーのクエスト状態を取得
        $userQuest = UserQuest::where('user_id', auth()->id())->where('quest_id', $questId)->first();
        $userQuestId = $userQuest ? $userQuest->id : null; // ユーザーがクエストに参加しているか確認
    
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

        // 全チャプターの情報を取得（viewingchapter.blade.php で利用）
        $quests_chapters = QuestsChapter::where('quest_id', $questId)->get();
            

         // 最後のチャプターかどうか
        $isLastChapter = $nextChapter === null;
    
    
        return view('players.quests.viewingchapter', compact('quest', 'quest_creator', 'chapter', 'nextChapter', 'prevChapter', 'otherChapters', 'isLastChapter', 'quests_chapters', 'userQuestId','userQuest'));
    }
   // クエスト完了
   public function completeQuest(Request $request)
   {
       $userQuest = UserQuest::where('user_id', auth()->id())
           ->where('quest_id', $request->quest_id)
           ->first();
   
       if ($userQuest && $userQuest->status == 1) {
           // ステータスを2（完了）に変更し、date_ended に現在時刻をセット
           $userQuest->status = 2;
           $userQuest->date_ended = now();  // この行を追加
           $userQuest->save();
   
           // user_quest_status テーブルに完了ステータスを履歴として追加
           UserQuestStatus::create([
               'user_quest_id' => $userQuest->id,
               'status' => 2,  // 完了
               'status_date' => now(),
           ]);
   
           return response()->json([
               'success' => true,
               'status' => 'Completed',
           ]);
       }
   
       return response()->json(['success' => false], 400);
   }
   
    }

