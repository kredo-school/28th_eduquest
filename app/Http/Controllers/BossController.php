<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuestController;
use App\Models\Quest;


class BossController extends Controller
{
    public function create($quest_id){

        $quests = Quest::findOrFail($quest_id);

        return view('quests.bosses.create',compact('quests'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'passing_score' => 'required|integer|min:1',
        ]);

        $boss = Boss::create([
            'description' => $request->input('description'),
            'passing_score' => $request->input('passing_score'),
        ]);

        return redirect()->route('quests.bosses.manage')->with('success', 'success create boss');

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
