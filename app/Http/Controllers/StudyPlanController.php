<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserQuestStatus;
use App\Models\UserQuest;
use App\Models\Planning;
use Illuminate\Support\Facades\Auth;

class StudyPlanController extends Controller
{
    public function show($id)
    {
        $player = User::findOrFail($id); 

        // Your Viewing Schedule: status = 0 (学習予定)
        $viewingSchedule = UserQuestStatus::where('user_quest_status.status', 0)
    ->whereHas('userQuest', function ($query) use ($id) {
        $query->where('user_id', $id);
    })
    ->with('userQuest.quest.categories', 'userQuest.quest.creator')
    ->orderBy('status_date')
    ->get();

        return view('players.quests.studyplan', compact('player', 'viewingSchedule'));
    }

    public function watchLater($id)
        {
            // user_quest テーブルからステータスが 0 のクエストを取得
            $watchLater = UserQuest::where('status', 0)
            ->where('user_id', $id)
            ->whereDoesntHave('userQuestStatus', function($query) {
                $query->whereNotNull('status_date');  // schedule_dateが設定されているクエストは表示しない
            })
            ->with('quest.categories', 'quest.creator')
            ->get();

            return view('players.quests.watchlater', compact('watchLater'));
        }

        public function schedule(Request $request, $userQuestId)
    {
        // バリデーション
        $request->validate([
            'schedule_date' => 'required|date',
        ]);

        // 対象のユーザークエストを取得（watch later に登録されたクエスト）
        $userQuest = UserQuest::findOrFail($userQuestId);

        // UserQuestStatus に新たなスケジュールエントリを作成
        $status = new UserQuestStatus();
        $status->user_quest_id = $userQuest->id;
        $status->status = 0;  // 状態は 0 のまま
        $status->status_date = $request->input('schedule_date');
        $status->save();

        // 同時に planning テーブルにもレコードを作成
        $planning = new Planning();
        $planning->date = $request->input('schedule_date');
        // UserQuest に quest_id がある場合（ない場合は $userQuest->quest->id など）
        $planning->quest_id = $userQuest->quest->id; 
        $planning->user_id = Auth::id();
        $planning->save();

        return redirect()->route('player.studyplan', Auth::id())
                        ->with('success', 'Quest scheduled successfully.');
    }

        
    public function updateSchedule(Request $request, $userQuestStatusId)
    {
        $request->validate([
            'schedule_date' => 'required|date',
        ]);
    
        // 更新対象の UserQuestStatus を取得
        $schedule = UserQuestStatus::findOrFail($userQuestStatusId);
        
        // 更新前のスケジュール日を退避
        $oldDate = $schedule->status_date;
    
        // 予定日の更新
        $schedule->status_date = $request->input('schedule_date');
        $schedule->save();
    
        // 対応する planning レコードを更新
        // ※ quest_id と user_id、そして元の日付でレコードを特定する例です
        $planning = Planning::where('quest_id', $schedule->userQuest->quest->id)
                            ->where('user_id', Auth::id())
                            ->where('date', $oldDate)
                            ->first();
        if ($planning) {
            $planning->date = $request->input('schedule_date');
            $planning->save();
        }
    
        return redirect()->route('player.studyplan', Auth::id())
                         ->with('success', 'Schedule updated successfully.');
    }
    
    public function deleteSchedule($id)
    {
        // UserQuestStatus を取得
        $schedule = UserQuestStatus::find($id);
        
        if ($schedule) {
            // 対応する planning レコードを削除
            $planning = Planning::where('quest_id', $schedule->userQuest->quest->id)
                                ->where('user_id', Auth::id())
                                ->where('date', $schedule->status_date)
                                ->first();
            if ($planning) {
                $planning->delete();
            }

            // スケジュール（UserQuestStatus）を削除
            $schedule->delete();

            return redirect()->route('player.watchlater', Auth::id())
                            ->with('message', 'Schedule deleted successfully.');
        }

        return back()->withErrors('Schedule not found.');
    }

    public function deleteWatchLater($id)
    {
        // 指定されたIDのUserQuestレコードを取得
        $userQuest = UserQuest::findOrFail($id);
        
        // レコードを完全に削除する
        $userQuest->delete();
        
        // 削除後、watch later ページへリダイレクト（ユーザーIDは認証情報から取得）
        return redirect()->route('player.watchlater', auth()->id())
                        ->with('message', 'Quest removed from Watch Later.');
    }


}
