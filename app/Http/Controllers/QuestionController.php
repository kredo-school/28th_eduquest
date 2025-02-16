<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Option;
use App\Models\Quest;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create($quest_id, $boss_id)
    {
        return view('quests.bosses.questions.create', compact('quest_id', 'boss_id'));
    }
    
    public function store(Request $request, $quest_id, $boss_id)
    {
        $request->validate([
        'questions.*.question_text' => 'required|string',
        'questions.*.points' => 'required|integer|min:1',
        'questions.*.correct_option' => 'required|integer|min:0|max:3', // 各質問ごとに1つの正解
        'questions.*.options.*.option_text' => 'required|string',
        ]);
    
        foreach ($request->input('questions') as $questionData) {
            // 設問を作成
            $question = Question::create([
                'question_text' => $questionData['question_text'],
                'points' => $questionData['points'],
                'boss_id' => $boss_id,
            ]);
    
            // 正解の選択肢のインデックス
            $correctOptionIndex = intval($questionData['correct_option']); // 文字列ではなく整数に変換
    
            // 選択肢を保存
            foreach ($request->options as $index => $optionData) {
                Option::create([
                    'option_text' => $optionData['option_text'],                    'is_correct' => ($index == $correctOptionIndex) ? 1 : 0,
                    'question_id' => $question->id,
                ]);
            }
        }

        return redirect()->route('quests.bosses.questions.store', ['quest_id' => $quest_id, 'boss_id' => $boss_id])
        ->with('success', 'Question and options added successfully!');
    }
    
}
