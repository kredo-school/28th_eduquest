<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $quests = Quest::with(['categories', 'creator'])
            ->orderBy('created_at', 'desc')  // 作成日時の降順
            ->get();
        
        // デバッグ出力
        foreach($quests as $quest) {
            \Log::info("Quest ID: {$quest->id}, Created at: {$quest->created_at}");
        }
        
        $quests = Quest::with(['categories', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);  // 4列×3行 = 12個に設定
        
        return view('welcome', compact('quests'));
    }
}