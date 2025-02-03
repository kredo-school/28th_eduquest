<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create($boss_id)
    {
        return view('questions.create', compact('boss_id'));
    }
    
    public function store(Request $request, $boss_id)
    {
        $request->validate([
            'question_text' => 'required|string',
            'points' => 'required|integer|min:1',
        ]);
    
        $question = Question::create([
            'question_text' => $request->input('question_text'),
            'points' => $request->input('points'),
            'boss_id' => $boss_id,
        ]);
    
        return redirect()->route('questions.create', ['id' => $boss_id])->with('success', 'added some questions');
    }
    
}
