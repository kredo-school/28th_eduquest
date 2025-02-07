<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserQuest;
use App\Models\Quest;

class StatusController extends Controller
{
    public function viewQuestStatus($id)
    {
        # To check if the auth ID is correct
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }

        # To get UserQuest each status
        //    with('quest') でQuestの情報を同時取得
        $watchLater = UserQuest::where('user_id', $id)
                     ->where('status', 0)  // 0=watch later
                     ->with('quest')
                     ->get();
        $inProgress = UserQuest::where('user_id', $id)
                     ->where('status', 1)  // 1=in progress
                     ->with('quest')
                     ->get();
        $completed  = UserQuest::where('user_id', $id)
                     ->where('status', 2)  // 2=completed
                     ->with('quest')
                     ->get();
        
        return view('players.quests.queststatus', compact('watchLater', 'inProgress', 'completed'));
    }

    // ユーザーのステータス管理テーブルから Quest を削除
    public function removeQuest($userQuestId)
    {
        // 1) レコード取得
        $userQuest = UserQuest::findOrFail($userQuestId);
        
        // 2) ログインユーザー本人のレコードかチェック
        if ($userQuest->user_id != Auth::id()) {
            abort(403, 'You do not have permission to remove this quest.');
        }

        // 3) レコード削除
        $userQuest->delete();

        // 4) 画面に戻る + 成功メッセージ
        return back()->with('status', 'Quest removed from your list.');
    }
}

