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


    public function index()
    {
        //クエスト一覧を取得(クエストテーブルのデータを全て取得)
        $quests = Quest::all();

        //quests.indexへクエストテーブルのデータと共に遷移
        return view('quests.index')->with('quests', $quests);
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


    public function store(Request $request)
    {
        //バリデーション
        $request->validate([
            'quest_title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'total_hours' => 'required|numeric|min:0.5|max:10',
            'thumbnail' => 'required|image',
            'category' => 'required|array|min:1|max:3',   //カテゴリーの選択を必須(最大3つ)(最低1つ)
            'category.*' => 'exists:categories,id', //カテゴリーIDが有効か確認
            'sub_items' => 'required|array|min:1',  //少なくとも1つのチャプター
            'sub_items.*.title' => 'required|string|max:255',
            'sub_items.*.description' => 'required|string|max:1000',
            'sub_items.*.video' => 'required|url',  // 動画URL
        ]);

        // 画像の保存
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        //Questの作成
        $quest = Quest::create([
            'quest_title' => $request->quest_title,
            'description' => $request->description,
            'total_hours' => $request->total_hours,
            'thumbnail' => $thumbnailPath,  // 保存した画像のパス
            'quest_creator_id' => Auth::id(),   // ログイン中のユーザーID設定
        ]);


        //チャプターの保存
        foreach ($request->sub_items as $subItem) {
            QuestChapter::create([
                'quest_chapter_title' => $subItem['title'],
                'description' => $subItem['description'],
                'video' => $subItem['video'],
                'quest_id' => $quest->id,   // 作成したQuestのIDを関連付け
            ]);
        }
        

        //選択されたカテゴリーを関連付ける
        foreach ($request->category as $categoryId) {
            QuestCategory::create([
                'quest_id' => $quest->id,
                'category_id' => $categoryId,   //中間テーブルとそれぞれのモデルをつなぐid
            ]);
        }

        return redirect()->route('quests.index');
    }
}