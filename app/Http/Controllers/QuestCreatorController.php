<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\QuestCreator;
use App\Models\Quest;
use App\Models\Favorite;

class QuestCreatorController extends Controller
{
    private $questcreator;
    public function __construct(QuestCreator $questcreator){
        $this->questcreator = $questcreator;
    }
    public function store(Request $request)
    {
        #1. Validate your data first
        $request->validate([
            'creator_name' => 'required',
            'job_title' => 'required',
            'description' => 'nullable|string|max:255',
            'creator_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qualifications' => 'nullable|string',
            'youtube' => 'nullable|string',
            'facebook' => 'nullable|string',
            'x_twitter' => 'nullable|string',
            'linkedin' => 'nullable|string' 
        ]);
        //現在のユーザーを取得
        $user = Auth::user();
        //role_idを2に更新
        $user->role_id = 2;
        $user->save();
        $this->questcreator->user_id = Auth::user()->id;
        $this->questcreator->creator_name = $request->creator_name;
        $this->questcreator->job_title = $request->job_title;
        $this->questcreator->description = $request->description;
        $this->questcreator->creator_image = 'data:image/' . $request->file('creator_image')->extension() . ';base64,' . base64_encode(file_get_contents($request->creator_image));
        $this->questcreator->qualifications = $request->qualificationss;
        $this->questcreator->youtube = $request->youtube;
        $this->questcreator->facebook = $request->facebook;
        $this->questcreator->x_twitter = $request->x_twitter;
        $this->questcreator->linkedin = $request->linkedin;
        $this->questcreator->save();
        //return redirect()->route('creatorMyPage')->with('success', 'Quest Creator profile created successfully!');
        $questcreator = QuestCreator::where('user_id', Auth::id())->firstOrFail();
        // dd($questcreator);
        return redirect()->route('questcreators.regulation', ['id' => $questcreator->id]);


        // 現在ログインしているユーザーのプロフィール情報を取得
        $creator = QuestCreator::where('user_id', Auth::id())->firstOrFail();
        return view('questcreators.profile.edit',compact('questcreator'));
 
        // リダイレクト先が指定されている場合はそこにリダイレクト
        if ($request->has('redirect_to')) {
            return redirect($request->redirect_to);
        }

        // デフォルトのリダイレクト先
        return redirect()->route('questcreators.profile.view');
    }
 

    public function viewCreatorProfile($id){
        $questcreator = QuestCreator::findOrFail($id);  // 指定のIDのcreatorを取得
    
        // ログイン中のユーザー情報を取得
        $user = Auth::user();
    
        // お気に入り登録済みかを判定（role_id=1のときだけ）
        $isFavorite = ($user && $user->role_id == 1) ? $user->favoriteCreators->contains($questcreator) : false;
    
        
        return view('questcreators.profile.view', compact('questcreator', 'isFavorite', 'user'));
    }    

    public function editCreatorProfile($id)
    {

        // ユーザーがログイン済みかどうかを確認
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'please log in');
        }

        // ログインしているユーザーが保持するcreator_idを取得
        $questcreator = QuestCreator::where('id', $id)->firstOrFail();

        // ログインユーザーが管理者または対象のcreatorのユーザー本人であれば編集可能
        if ($questcreator->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'You can not edit this page');
        }

        // 編集ページを表示
        return view('questcreators.profile.edit', compact('questcreator'));
    }


    public function showRegulation($id)
    {
        $questcreator = QuestCreator::where('user_id', Auth::id())->firstOrFail();
        // dd($questcreator);
        return view('questcreators.regulation', compact('id'));
    }
    
    public function creatorGuide()
    {
        return view('questcreators.how-to-guide');
    }

    public function guideExplanation()
    {
        return view('questcreators.guide-explanation');
    }




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function show($id)
    {
        // ログイン中のユーザーを取得
        $user = Auth::user();
        
        // QuestCreatorモデルから、指定されたIDのレコードを取得
        $questcreator = QuestCreator::findOrFail($id);
        
        // ログインユーザーが、他のクリエイターのプロフィールを見る場合
        if ($user->role_id != 1 && $questcreator->role_id == 2) {
            // もしロールが1でない場合、あるいはrole_idが2のクリエイターにアクセスしている場合
            return redirect()->route('home')->with('error', '他のクリエイターのプロフィールを見る権限がありません');
        }
        
        // 現在ログインしているユーザーがお気に入りにしているQuestCreator($questcreator)を持っているかどうかを確認
        $isFavorite = $user->favoriteCreators->contains($questcreator);

        // ビューにデータを渡す
        return view('questcreators.creatorMyPage', compact('questcreator', 'isFavorite'));
    }


    public function assignQuestToUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->quest_creator_id = $request->quest_creator_id;
        $user->save();

        return redirect()->back()->with('success', 'Quest assigned successfully!');
    }

    
    public function update(Request $request)
    {            
        // 現在のユーザーのプロフィールデータを取得
        $questcreator = QuestCreator::where('user_id', Auth::id())->firstOrFail();

        // フォームデータをモデルに反映
        $questcreator->creator_name = $request->input('creator_name');
        $questcreator->job_title = $request->input('job_title');
        $questcreator->description = $request->input('description');
        $questcreator->qualifications = $request->input('qualifications');
        $questcreator->youtube = $request->input('youtube');
        $questcreator->facebook = $request->input('facebook');
        $questcreator->x_twitter = $request->input('x_twitter');
        $questcreator->linkedin = $request->input('linkedin');

        // プロフィール画像がアップロードされた場合
        if ($request->hasFile('creator_image')) {
            $questcreator->creator_image = 'data:image/' . $request->file('creator_image')->extension() . ';base64,' .base64_encode(file_get_contents($request->file('creator_image')));
        }

        // データベースに保存
        $questcreator->save();

        // 更新後にリダイレクト
        // return redirect()->route('questcreators.profile.view')
        //     ->with('success', 'Profile updated successfully!');

        return redirect()->route('questcreators.profile.view', ['id' => $questcreator->id])
        ->with('success', 'Profile updated successfully!');

    }

    public function creatorMyPage(Request $request, $id = null)
    {
        // $idが渡された場合はそのクリエイター情報、渡されなければログインユーザーの情報を使用
        if ($id) {
            $questcreator = QuestCreator::findOrFail($id);
        } else {
            $questcreator = QuestCreator::where('user_id', Auth::id())->firstOrFail();
        }
    
        // お気に入り登録数とクエスト数の取得
        $favoriteCount = Favorite::where('quest_creator_id', $questcreator->id)->count();
        $questCount = $questcreator->quests()->count();
    
        // ログイン中のクリエイターが作成したクエストIDを取得
        $creatorQuestIds = $questcreator->quests()->pluck('id');
    
        // GETパラメーター 'sort' によるランキングの種類（デフォルトは 'started'）
        $sort = $request->input('sort', 'started');
    
        // ランキングの集計処理
        if ($sort === 'started') {
            $ranking = DB::table('user_quest')
                ->select('quest_id', DB::raw('COUNT(*) as start_count'))
                ->where('status', '>=', 1) // in progress & completed を含む
                ->whereIn('quest_id', $creatorQuestIds) // クリエイターのクエストのみ対象
                ->groupBy('quest_id')
                ->orderByDesc('start_count')
                ->limit(10)
                ->get();
        } elseif ($sort === 'completed') {
            $ranking = DB::table('user_quest')
                ->select('quest_id', DB::raw('COUNT(*) as completed_count'))
                ->where('status', 2) // completed のみ
                ->whereIn('quest_id', $creatorQuestIds) // クリエイターのクエストのみ対象
                ->groupBy('quest_id')
                ->orderByDesc('completed_count')
                ->limit(10)
                ->get();
        } else {
            $ranking = collect();
        }
    
        // 集計結果から各クエストの詳細情報を取得
        $rankingQuests = [];
        foreach ($ranking as $rank) {
            $quest = Quest::find($rank->quest_id);
            if ($quest) {
                $quest->ranking_value = $sort === 'started' ? $rank->start_count : $rank->completed_count;
                $rankingQuests[] = $quest;
            }
        }
    
        // ビューに必要な全ての変数を渡す
        return view('questcreators.creatorMyPage', compact('questcreator', 'rankingQuests', 'sort', 'favoriteCount', 'questCount'));
    }
}

