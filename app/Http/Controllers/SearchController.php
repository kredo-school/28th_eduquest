<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quest;
use App\Models\Category;
use App\Models\QuestCreator;

class SearchController extends Controller
{
    private $quest;
    private $category;
    private $questCreator;

    /**
     * コンストラクタでモデルを注入し、$this->を通じて利用
     */
    public function __construct(Quest $quest, Category $category, QuestCreator $questCreator)
    {
        $this->quest        = $quest;
        $this->category     = $category;
        $this->questCreator = $questCreator;
    }

    /**
     * 検索バーの入力、またはカテゴリドロップダウンから呼ばれる
     * GET /search?search=...&category=...
     */
    public function search(Request $request)
    {
        $search     = $request->input('search');     // 検索ワード
        $categoryId = $request->input('category');   // カテゴリID

        $query = $this->quest->newQuery();

        // Search Word
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('quest_title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // filter category
        $categoryName = null;
        if (!empty($categoryId)) {
            // get Category_name
            $cat = $this->category->find($categoryId);
            if ($cat) {
                $categoryName = $cat->category_name;
            }

            // 絞り込み
            $query->whereHas('categoryQuests', function($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        // リレーション読み込み
        $query->with(['creator', 'categoryQuests.category']);

        // 実行
        $quests = $query->get();

        // Blade に渡す
        return view('players.quests.searchresult', [
            'quests'       => $quests,
            'searchWord'   => $search,         // 検索キーワード
            'categoryName' => $categoryName,   // カテゴリ名
        ]);
    }
}
