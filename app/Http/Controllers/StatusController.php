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
            ->with('quest')
            ->get();

        // In Progress (status=1)
        $inProgress = $this->userQuest
            ->where('user_id', $id)
            ->where('status', 1)
            ->with('quest')
            ->get();

        // Completed (status=2)
        $completed = $this->userQuest
            ->where('user_id', $id)
            ->where('status', 2)
            ->with('quest')
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
}


