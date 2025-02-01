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



    public function create(Request $request)
    {
        $categories = Category::all(); //カテゴリーデータを全て取得
        return view('quests.create')->with('categories', $categories);
    }

    /**
     * クエスト一覧を表示
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


    public function store(Request $request)
    {
        $request->validate([
            'quest_title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'total_hours' => 'required|numeric|min:0.5|max:10',
            'thumbnail' => 'required|url',  // URLとしてのバリデーション
            'category' => 'required|array|min:1|max:3',   //カテゴリーの選択を必須(最大3つ)(最低1つ)
            'category.*' => 'exists:categories,id', //カテゴリーIDが有効か確認
            'sub_items' => 'required|array|min:1',  //少なくとも1つのチャプター
            // 'sub_items.*.quest_chapter_title' => 'required|string|max:255',
            // 'sub_items.*.description' => 'required|string|max:1000',
            // 'sub_items.*.video' => 'required|url',  // 動画URL
        ]);

        // YouTubeのURLから動画IDを抽出
        $youtubeId = $this->extractYoutubeId($request->thumbnail);
        $thumbnailUrl = "https://img.youtube.com/vi/{$youtubeId}/0.jpg";

        // Questの作成
        $quest = Quest::create([
            'quest_title' => $request->quest_title,
            'description' => $request->description,
            'total_hours' => $request->total_hours,
            'thumbnail' => $thumbnailUrl,  // 生成したサムネイルURLを保存
            'quest_creator_id' => Auth::id(),
        ]);


        // //チャプターの保存
        // foreach ($request->sub_items as $subItem) {
        //     QuestChapter::create([
        //         'quest_chapter_title' => $subItem['quest_chapter_title'],
        //         'description' => $subItem['description'],
        //         'video' => $subItem['video'],
        //         'quest_id' => $quest->id,   // 作成したQuestのIDを関連付け
        //     ]);
        // }

        foreach ($request->sub_items as $index => $subItem) {
            QuestChapter::create([
                'quest_chapter_title' => $subItem['quest_chapter_title'], 
                'description' => $subItem['description'] ?? null, 
                'video' => $subItem['video'] ?? null,
                'quest_id' => $quest->id,             
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

    public function edit($id) {

        $quest = Quest::findOrFail($id);  // QuestをIDで取得
        $categories = Category::all();    // カテゴリーデータを全て取得
        $chapters = $quest->chapters;

        return view('quests.edit')->with('quest', $quest)
                                  ->with('categories', $categories)
                                  ->with('chapters', $chapters);
    }


    public function update(Request $request, $id) {


        $quest = Quest::findOrFail($id);

         // バリデーション
        $request->validate([
            'quest_title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'total_hours' => 'required|numeric|min:0.5|max:10',
            'thumbnail' => 'nullable|url',  // URLとしてのバリデーション
            'category' => 'required|array|min:1|max:3',
            'category.*' => 'exists:categories,id',
            'sub_items' => 'required|array|min:1',
            // 'sub_items.*.quest_chapter_title' => 'required|string|max:255',
            // 'sub_items.*.description' => 'required|string|max:1000',
            // 'sub_items.*.video' => 'required|url',
    ]);

        // YouTubeのURLから動画IDを抽出
        $youtubeId = $this->extractYoutubeId($request->thumbnail);
        $thumbnailUrl = "https://img.youtube.com/vi/{$youtubeId}/0.jpg";

        // Questの更新
        $quest->update([
            'quest_title' => $request->quest_title,
            'description' => $request->description,
            'total_hours' => $request->total_hours,
            'thumbnail' => $thumbnailUrl,  // 生成したサムネイルURLを保存
            'quest_creator_id' => Auth::id(),
        ]);

        // チャプターの更新(既存のチャプターを削除して新しいものを追加)
        $quest->chapters()->delete();  // 既存のチャプターを削除
        foreach ($request->sub_items as $subItem) {
            QuestChapter::create([
                'quest_chapter_title' => $subItem['quest_chapter_title'],
                'description' => $subItem['description'] ?? null,
                'video' => $subItem['video'] ?? null,
                'quest_id' => $quest->id,
            ]);
        }

        // カテゴリーの更新
        $quest->categories()->sync($request->category);   // 中間テーブルでカテゴリーを更新
        
        return redirect()->route('quests.index');
    }

    // YouTubeのURLから動画IDを抽出するヘルパーメソッド
    private function extractYoutubeId($url)
    {
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $url, $matches);
        return $matches[1] ?? null;
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


}