<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quest;
use App\Models\Category;
use App\Models\QuestCategory;
use App\Models\QuestChapter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class QuestController extends Controller
{
    private $questcreator;
    private $quest;

    public function __construct(Quest $quest){
        $this->quest = $quest;
    }

    public function viewCreateQuest()
    {
        $categories = Category::all();
        return view('quests.create')->with('categories', $categories);
    }

    public function create(Request $request)
    {
        $categories = Category::all(); //カテゴリーデータを全て取得
        return view('quests.create')->with('categories', $categories);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 現在ログインしているユーザーのIDを取得
        $userId = auth()->id();

        // ユーザーに紐づいたクエストのみを取得
        $quests = Quest::where('quest_creator_id', $userId)->get();
        // ビューにクエストを渡す
        return view('quests.list', compact('quests'));
    }


    /**
     * クエストを削除
     */
    public function destroy($id)
    {
        $quest = Quest::findOrFail($id);
        $quest->delete();
        
        return redirect()->route('quests.index')
            ->with('success', 'クエストが正常に削除されました。');
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

}