<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quest;
use App\Models\Category;

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

    public function create(Request $request)
    {
        $categories = Category::all(); //カテゴリーデータを全て取得
        return view('quests.create')->with('categories', $categories);
    }

    /**
     * クエスト一覧を表示
     */
    public function list()
    {
        $quests = Quest::all();
        return view('quests.list', compact('quests'));
    }

    /**
     * クエストを削除
     */
    public function destroy($id)
    {
        $quest = Quest::findOrFail($id);
        $quest->delete();
        
        return redirect()->route('quests.list')
            ->with('success', 'クエストが正常に削除されました。');
    }
}
