<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAnswerController extends Controller
{
    public function start($id)
    {
        $boss = Boss::with('questions.options')->findOrFail($id);
        return view('bosses.start', compact('boss'));
    }

    // public function submit(Request $request, $id)
    // {
    //     $user = Auth::user();
    //     $boss = Boss::findOrFail($id);
    //     $questions = Question::where('boss_id', $boss->id)->get();

    //     $score = 0;
    //     foreach ($questions as $question) {
    //         $selectedOptionId = $request->input("question_{$question->id}");
    //         $selectedOption = Option::find($selectedOptionId);

    //         if ($selectedOption && $selectedOption->is_correct) {
    //             $score += $question->points;
    //         }

    //         UserAnswer::create([
    //             'user_id' => $user->id,
    //             'question_id' => $question->id,
    //             'option_id' => $selectedOptionId,
    //         ]);
    //     }

    //     UserResult::create([
    //         'user_id' => $user->id,
    //         'boss_id' => $boss->id,
    //         'total_score' => $score,
    //         'is_success' => $score >= $boss->passing_score,
    //     ]);

    //     return redirect()->route('bosses.result', ['id' => $boss->id]);
    // }

}
