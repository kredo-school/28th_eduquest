<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quest;
use App\Models\UserQuest;
use App\Models\UserQuestStatus;

class QuestController extends Controller
{
    private $questcreator;

    public function __construct(Quest $quest){
        $this->quest = $quest;
    }

    public function viewCreateQuest()
    {
        return view('quests.create');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 他に処理があればここに追加
    }
    
    /**
     * クエスト詳細ページを表示
     * クエストとそのレビューを一緒に取得して表示
     *
     * @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($questId)
    {
        // クエストと関連するチャプターを取得
        $quest = Quest::with('chapters')->findOrFail($questId);

        // 現在ログインしているユーザーのレビューを取得
        $user_review = ReviewRating::where('quest_id', $questId)
            ->where('user_id', auth()->id())
            ->first();

        // 他のユーザーのレビューを取得
        $other_reviews = ReviewRating::with('user') // 'user' リレーションをロード
        ->where('quest_id', $questId)
        ->where('user_id', '!=', auth()->id())
        ->orderByDesc('created_at')
        ->get();

        // ビューにデータを渡す
        return view('players.quests.chapterlist', compact('quest', 'user_review', 'other_reviews'));
    }
}

