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

    public function show($questId)
    {
        $quest = Quest::with('questsChapters', 'questCreator')->findOrFail($questId);
        $quest_creator = $quest->questCreator;
        $quests_chapters = $quest->questsChapters; // 関連するチャプターを取得

        return view('players.quests.chapterlist', compact('quest', 'quest_creator', 'quests_chapters'));
    }



    public function assignQuestToUser(Request $request, $questId)
    {
        $quest = Quest::findOrFail($questId);
        $quest->quests_chapter_id = $request->quests_chapter_id;
        $quest->save();

        return redirect()->back()->with('success', 'QuestsChapter assigned successfully!');
    }
    
}
