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
            'description' => 'required|max:100',
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
        $this->questcreator->creator_image = 'data:image/' . $request->file('creator_image')->extension() . ';base64,' . base64_encode(file_get_contents($request->creator_image));
        $this->questcreator->youtube = $request->youtube;
        $this->questcreator->facebook = $request->facebook;
        $this->questcreator->x_twitter = $request->x_twitter;
        $this->questcreator->linkedin = $request->linkedin;
        $this->questcreator->save();

        //return redirect()->route('creatorMyPage')->with('success', 'Quest Creator profile created successfully!');
        return view('questcreators.creatorMyPage'); 
    }

    
  
    // すでに他のメソッドが存在する中に追加
    public function viewCreatorMyPage()
    {
        // views/questcreators/creatorMyPage.blade.php を参照
        return view('questcreators.creatorMyPage');
    }



}
