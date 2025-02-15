<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserQuest;
use App\Models\Quest;

class StatusController extends Controller
{
    private $userQuest;
    private $quest;

    public function __construct(UserQuest $userQuest, Quest $quest)
    {
        $this->userQuest = $userQuest;
        $this->quest     = $quest;
    }

    public function viewQuestStatus($id)
    {
        # To check if the auth ID is correct
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }

        // Watch Later (status=0)
        $watchLater = $this->userQuest
            ->where('user_id', $id)
            ->where('status', 0)
            ->with(['quest.categoryQuests.category','quest.creator'])
            ->get();

        // In Progress (status=1)
        $inProgress = $this->userQuest
            ->where('user_id', $id)
            ->where('status', 1)
            ->with(['quest.categoryQuests.category','quest.creator'])
            ->get();

        // Completed (status=2)
        $completed = $this->userQuest
            ->where('user_id', $id)
            ->where('status', 2)
            ->with(['quest.categoryQuests.category','quest.creator'])
            ->get();

        return view('players.quests.queststatus', [
            'watchLater' => $watchLater,
            'inProgress' => $inProgress,
            'completed'  => $completed,
        ]);
    }

    public function removeQuest($userQuestId)
    {
        $record = $this->userQuest->findOrFail($userQuestId);

        if ($record->user_id != Auth::id()) {
            abort(403, 'You do not have permission to remove this quest.');
        }

        $record->delete();

        return back()->with('status', 'Quest removed from your list.');
    }


    public function toggleWatchLater($questId)
    {
        $userId = Auth::id();
        $record = UserQuest::where('user_id', $userId)
                        ->where('quest_id', $questId)
                        ->first();

        if ($record) {
            if ($record->status == 0) {
                // Watch Later → 解除(削除) or statusをnullにする
                $record->delete();
                return back()->with('status','Removed from Watch Later.');
            } else {
                // 既に In Progress(1) or Completed(2) なら
                // Watch Laterにしたいケースがあればここで書き換え
                // でも今回「InProgressやCompletedは変えない」なら、操作無効にするかエラーメッセージ出すか
                return back()->with('status','You cannot convert an In Progress/Completed quest to Watch Later.');
            }
        } else {
            // レコードが無いので、新規で status=0 (Watch Later) を追加
            UserQuest::create([
                'user_id' => $userId,
                'quest_id'=> $questId,
                'status'  => 0
            ]);
            return back()->with('status','Added to Watch Later.');
        }
    }

}


