<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\QuestCreator;
use App\Models\Quest;
use App\Models\ReviewsRating;

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
        $this->questcreator->qualifications = $request->qualifications;
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
 

    public function viewCreatorProfile(){

        $questcreator = QuestCreator::where('user_id', Auth::id())->first();
      
        return view('questcreators.profile.view', compact('questcreator'));

    }

    public function editCreatorProfile($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        $questcreator = QuestCreator::where('user_id', $id)->firstOrFail();

        if ($questcreator->user_id !== Auth::id()) {
            abort(403, 'このプロフィールを編集する権限がありません');
        }

        if (!$questcreator) {
            $questcreator = new QuestCreator(); // 空のインスタンスを渡す
        }
    
        $questCount = Quest::count();
        return view('questcreators.profile.edit', compact('questcreator'));
    

        
    }


    public function viewCreatorMyPage($id)
    {
        $questcreator = QuestCreator::where('user_id', Auth::id())->firstOrFail();

        $questCount = Quest::count();

        return view('questcreators.creatorMyPage', compact('questcreator', 'questCount'));
    }

    public function creatorGuide()
    {
        return view('questcreators.how-to-guide');
    }

    public function guideExplanation()
    {
        return view('questcreators.guide-explanation');
    }

    public function showRegulation($id)
    {
        $questcreator = QuestCreator::where('user_id', Auth::id())->firstOrFail();
        // dd($questcreator);
        return view('questcreators.regulation', compact('id'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        //
    }

    public function show($id)
    {
        $quest_creator = QuestCreator::findOrFail($id);
        return view('quest_creator.show', compact('quest_creator'));
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

    // For Quest Data

    public function viewQuestData($id){
        $questcreator = QuestCreator::where('user_id', $id)->firstOrFail();

        $quests = $questcreator->quests()->paginate(3);
        $ratings = $questcreator->reviews_ratings->keyBy('quest_id'); 

        return view('questcreators.data-aggregation', compact('questcreator', 'quests', 'ratings'));

    }


}
