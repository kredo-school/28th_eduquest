<?php

namespace App\Http\Controllers;

use App\Models\UserQuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function viewMyPage($id)
    {
        // ステータスごとのクエスト数をカウント
        $watchlaterCount = UserQuest::where('user_id', $id)
                                    ->where('status', 0) // watchlater
                                    ->count();

        $inProgressCount = UserQuest::where('user_id', $id)
                                     ->where('status', 1) // in progress
                                     ->count();

        $clearedQuestsCount = UserQuest::where('user_id', $id)
                                       ->where('status', 2) // cleared
                                       ->count();

        return view('players.mypage.mypage', compact('watchlaterCount', 'inProgressCount', 'clearedQuestsCount'));
    }
}

