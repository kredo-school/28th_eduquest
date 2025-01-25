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
        $this->questcreator->youtube = $request->youtube;
        $this->questcreator->facebook = $request->facebook;
        $this->questcreator->x_twitter = $request->x_twitter;
        $this->questcreator->linkedin = $request->linkedin;
        $this->questcreator->save();

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
        $creator = QuestCreator::where('user_id', Auth::id())->firstOrFail();

        return view('questcreators.creatorMyPage', compact('creator'));
    }

    
    // すでに他のメソッドが存在する中に追加
    public function viewEditCreatorProfile(){
        return view('questcreators.profile.edit');
    }

    public function viewCreatorProfile(){
        $creator = QuestCreator::where('user_id', Auth::id())->firstOrFail();
        return view('questcreators.profile.view', compact('creator'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'creator_name' => 'required',
            'job_title' => 'required',
            'description' => 'nullable|string|max:255',
            'creator_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qualification' => 'nullable|string',
            'youtube' => 'nullable|string',
            'facebook' => 'nullable|string',
            'x_twitter' => 'nullable|string',
            'linkedin' => 'nullable|string'
        ]);

        $creator = QuestCreator::where('user_id', Auth::id())->firstOrFail();
        
        $creator->creator_name = $request->creator_name;
        $creator->job_title = $request->job_title;
        $creator->description = $request->description;
        $creator->qualification = $request->qualification;
        
        if ($request->hasFile('creator_image')) {
            $creator->creator_image = 'data:image/' . $request->file('creator_image')->extension() . ';base64,' . base64_encode(file_get_contents($request->creator_image));
        }
        
        $creator->youtube = $request->youtube;
        $creator->facebook = $request->facebook;
        $creator->x_twitter = $request->x_twitter;
        $creator->linkedin = $request->linkedin;
        
        $creator->save();

        return redirect()->route('questcreators.profile.view')->with('success', 'Profile updated successfully');
    }
}
