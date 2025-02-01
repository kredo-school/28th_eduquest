<?php

namespace App\Http\Controllers;
use App\Models\QuestsChapter;
use App\Models\Quest;
use App\Models\User;

use Illuminate\Http\Request;

class QuestsChapterController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        //
    }

    public function show($id)
    {
        $quest_chapter = QuestsChapter::findOrFail($id);
        return view('quests_chapter.show', compact('quests_chapter'));
    }

    public function assignQuestToUser(Request $request, $questId)
    {
        $quest = Quest::findOrFail($questId);
        $quest->quests_chapter_id = $request->quests_chapter_id;
        $quest->save();

        return redirect()->back()->with('success', 'QuestsChapter assigned successfully!');
    }
}
