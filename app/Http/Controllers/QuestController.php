<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quest;
use App\Models\Chapter;

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
        $quests = Quest::orderBy('created_at', 'desc')->get();
        return view('admin.quest-list', ['quests' => $quests]);
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

    public function showChapters(Quest $quest)
    {
        // クエストが存在することを確認
        if (!$quest) {
            abort(404);
        }

        // クエストに関連するチャプターを取得
        $chapters = $quest->chapters()->orderBy('created_at', 'desc')->get();

        // デバッグ用
        \Log::info('Quest ID: ' . $quest->id);
        \Log::info('Chapters: ', $chapters->toArray());

        return view('quests.chapters', compact('quest', 'chapters'));
    }

    /**
     * ユーザーにクエストを割り当てる
     *
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignQuestToUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->quest_id = $request->quest_id;
        $user->save();

        return redirect()->back()->with('success', 'Quest assigned successfully!');
    }

    public function edit(Quest $quest)
    {
        return view('admin.edit-quest', [
            'quest' => $quest
        ]);
    }

    public function update(Request $request, Quest $quest)
    {
        // 更新処理
        
        return redirect()->route('quests.chapters', ['quest' => $quest]);
    }
}

