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
use App\Models\UserQuest;
use App\Models\UserQuestStatus;

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
        // 新規作成時は空の配列、もしくは初期状態で１件の空データを渡す
        // $chapters = []; // もしくは
        $chapters = [new QuestChapter()];
        
        return view('quests.create')
                ->with('categories', $categories)
                ->with('chapters', $chapters);
    }

    public function create(Request $request)
    {
        // 章のデータを取得
        $chapters = QuestChapter::all();

        // カテゴリーのデータを取得
        $categories = Category::all();

        // 変数をビューに渡す
        return view('quests.create', compact('chapters', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quest_title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'total_hours' => 'required|numeric|min:0.5|max:10',
            'thumbnail_type' => 'required|string|in:url,image',
            'thumbnail' => [
            'nullable',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->thumbnail_type === 'url' && !filter_var($value, FILTER_VALIDATE_URL)) {
                    $fail('サムネイルのURLが無効です');
                }
                if ($request->thumbnail_type === 'image' && !$request->hasFile('thumbnail')) {
                    $fail('画像ファイルを選択してください');
                }
            },
        ],
            'category' => 'required|array|min:1|max:3',   //カテゴリーの選択を必須(最大3つ)(最低1つ)
            'category.*' => 'exists:categories,id', //カテゴリーIDが有効か確認
            'sub_items' => 'required|array|min:1',  //少なくとも1つのチャプター
            'sub_items' => 'required|array|min:1',
            'sub_items.*.quest_chapter_title' => 'required|string|max:255',
            'sub_items.*.description' => 'nullable|string|max:1000',
        ]);

        // 画像の保存
        $thumbnailPath = null;

        if ($request->thumbnail_type === 'image' && $request->hasFile('thumbnail')) {
            $thumbnailPath = 'storage/' . $request->file('thumbnail')->store('thumbnails', 'public');
        } elseif ($request->thumbnail_type === 'url') {
            $youtubeId = $this->extractYoutubeId($request->thumbnail);
            $thumbnailPath = "https://img.youtube.com/vi/{$youtubeId}/0.jpg";
        }

        // YouTubeのURLから動画IDを抽出
        $youtubeId = $this->extractYoutubeId($request->thumbnail);
        $thumbnailUrl = "https://img.youtube.com/vi/{$youtubeId}/0.jpg";



        //Questの作成
        $quest = Quest::create([
            'quest_title' => $request->quest_title,
            'description' => $request->description,
            'total_hours' => $request->total_hours,
            'thumbnail' => $thumbnailPath,  // 保存した画像のパス
            'quest_creator_id' => Auth::id(),   // ログイン中のユーザーID設定
        ]);


        foreach ($request->sub_items as $index => $subItem) {
            QuestChapter::create([
                'quest_chapter_title' => $subItem['quest_chapter_title'],
                'description' => $subItem['description'] ?? null,  // null許容
                'video' => $subItem['video'] ?? null,  // null許容
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

        return redirect()->route('quests.index')->with('success', 'Questが作成されました！');
    }

    // YouTubeのURLから動画IDを抽出するヘルパーメソッド
    private function extractYoutubeId($url)
    {
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $url, $matches);
        return $matches[1] ?? null;
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
            'thumbnail_type' => 'required|string|in:url,image',
            'thumbnail' => [
            'nullable',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->thumbnail_type === 'url' && !filter_var($value, FILTER_VALIDATE_URL)) {
                    $fail('サムネイルのURLが無効です');
                }
                if ($request->thumbnail_type === 'image' && !$request->hasFile('thumbnail')) {
                    $fail('画像ファイルを選択してください');
                }
            },
        ],
            'category' => 'required|array|min:1|max:3',   //カテゴリーの選択を必須(最大3つ)(最低1つ)
            'category.*' => 'exists:categories,id', //カテゴリーIDが有効か確認
            'sub_items' => 'required|array|min:1',  //少なくとも1つのチャプター
        ]);

        // 画像の保存
        $thumbnailPath = null;

        if ($request->thumbnail_type === 'image' && $request->hasFile('thumbnail')) {
            $thumbnailPath = 'storage/' . $request->file('thumbnail')->store('thumbnails', 'public');
        } elseif ($request->thumbnail_type === 'url') {
            $youtubeId = $this->extractYoutubeId($request->thumbnail);
            $thumbnailPath = "https://img.youtube.com/vi/{$youtubeId}/0.jpg";
        }

        // YouTubeのURLから動画IDを抽出
        $youtubeId = $this->extractYoutubeId($request->thumbnail);
        $thumbnailUrl = "https://img.youtube.com/vi/{$youtubeId}/0.jpg";


        // Questの更新
        $quest->update([
            'quest_title' => $request->quest_title,
            'description' => $request->description,
            'total_hours' => $request->total_hours,
            'thumbnail' => $thumbnailPath,  // 保存した画像のパス
            'quest_creator_id' => Auth::id(),
        ]);

        // 画像が更新されている場合は保存
        // if ($request->hasFile('thumbnail')) {
        //     $thumbnailPath = $request->file('thumbnail')->store('thumbnail', 'public');
        //     $quest->thumbnail = $thumbnailPath;
        //     $quest->save();
        // }

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