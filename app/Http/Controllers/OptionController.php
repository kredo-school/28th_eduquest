<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuestionController;
use App\Models\Question;


class OptionController extends Controller
{
    public function store(Request $request, $question_id)
    {
        $request->validate([
            'option_text' => 'required|string|max:255',
            'is_correct' => 'required|boolean',
        ]);

        // 選択肢を作成
        Option::create([
            'option_text' => $request->option_text,
            'is_correct' => $request->is_correct,
            'question_id' => $question->id,
        ]);

        return redirect()->back()->with('success', 'Option added successfully!');
    }
}
