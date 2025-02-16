<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuestController;
use App\Models\Quest;
use App\Http\Controllers\BossController;
use App\Models\Boss;


class BossController extends Controller
{
    public function create($quest_id){

        $quest = Quest::findOrFail($quest_id);

        return view('quests.bosses.create', compact('quest'));

    }

    public function store(Request $request, $quest_id)
    {
        $quest = Quest::findOrFail($quest_id);

        $request->validate([
            'description' => 'required|string|max:255',
            'passing_score' => 'required|integer|min:1',

        ]);

        $boss = Boss::create([
            'description' => $request->input('description'),
            'passing_score' => $request->input('passing_score'),
            'quest_id' => $quest->id,
        ]);

        return redirect()->route('quests.bosses.questions.create',['quest_id' => $quest_id , 'boss_id' => $boss->id ]) ->with('success', 'Boss created! Now add questions.');
    }

    

    // #memo
    // public function manage()
    // {
    //     $bosses = Boss::whereHas('quest', function ($query) {
    //         $query->where('quest_creator_id', Auth::id());
    //     })->get();

    //     return view('bosses.manage', compact('bosses'));
    // }
}
