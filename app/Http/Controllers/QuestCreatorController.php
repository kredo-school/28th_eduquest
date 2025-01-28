<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuestCreator;

class QuestCreatorController extends Controller
{
    private $questcreator;
    public function __construct(QuestCreator $questcreator){
        $this->questcreator = $questcreator;
    }
    public function store(Request $request)
    {
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
        return view('questcreators.creatorMyPage',compact('questcreator'));

        // リダイレクト先が指定されている場合はそこにリダイレクト
        if ($request->has('redirect_to')) {
            return redirect($request->redirect_to);
        }

        // デフォルトのリダイレクト先
        return redirect()->route('questcreators.profile.view');
    }
    // すでに他のメソッドが存在する中に追加
    public function viewCreatorMyPage(){
        // views/questcreators/creatorMyPage.blade.php を参照
        $questcreator = QuestCreator::where('user_id', Auth::id())->firstOrFail();

        return view('questcreators.creatorMyPage', compact('questcreator'));
    }

    public function viewCreatorProfile(){

        $questcreator = QuestCreator::where('user_id', Auth::id())->first();
        if (!$questcreator) {
            dd('No data found for this user');
        }
        return view('questcreators.profile.view', compact('questcreator'));

    }

    public function editCreatorProfile()
    {
         // 現在ログイン中のユーザーの QuestCreator プロフィールを取得
        $questcreator = QuestCreator::where('user_id', Auth::id())->first();

        // データが存在しない場合の処理を追加
        if (!$questcreator) {
            $questcreator = new QuestCreator(); // 空のインスタンスを渡す
        }

        // 現在ログインしているユーザーのプロフィール情報を取得
        $creator = QuestCreator::where('user_id', Auth::id())->firstOrFail();
        return view('questcreators.profile.edit',compact('questcreator'));
    }

    
    // すでに他のメソッドが存在する中に追加
    // public function viewEditCreatorProfile(){
    //  return view('questcreators.profile.edit',compact('questcreator'));
    //}

    public function update(Request $request)
    {
        
    // 現在のユーザーのプロフィールデータを取得
    $questcreator = QuestCreator::where('user_id', Auth::id())->firstOrFail();

    // フォームデータをモデルに反映
    $questcreator->creator_name = $request->input('creator_name');
    $questcreator->job_title = $request->input('job_title');
    $questcreator->description = $request->input('description');
    $questcreator->qualifications = $request->input('qualification');
    $questcreator->youtube = $request->input('youtube');
    $questcreator->facebook = $request->input('facebook');
    $questcreator->x_twitter = $request->input('x_twitter');
    $questcreator->linkedin = $request->input('linkedin');

    // プロフィール画像がアップロードされた場合
    if ($request->hasFile('creator_image')) {
        $path = $request->file('creator_image')->store('public/creator_images');
        $questcreator->creator_image = basename($path);
    }

    // データベースに保存
    $questcreator->save();

    // 更新後にリダイレクト
    return redirect()->route('questcreators.creatorMyPage')
        ->with('success', 'Profile updated successfully!');
    }


}
