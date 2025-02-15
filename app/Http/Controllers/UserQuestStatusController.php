<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserQuestStatus;

use Carbon\Carbon;

class UserQuestStatusController extends Controller
{
    public function updateQuestStatus(Request $request)
    {
        $validated = $request->validate([
            'user_quest_id' => 'required|exists:user_quest,id',
            'status' => 'required|in:1,2', 
        ]);

        try {
            $status = UserQuestStatus::updateOrCreate(
                ['user_quest_id' => $validated['user_quest_id']],
                [
                    'status' => $validated['status'],
                    'status_date' => Carbon::now(),
                ]
            );

            return response()->json([
                'message' => 'クエストのステータスが更新されました',
                'status' => $status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'エラーが発生しました',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
