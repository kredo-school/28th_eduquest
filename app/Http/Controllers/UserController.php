<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    #インスタンスを作成
    private $user;

    public function __construct(User $user){
        $this->user = $user;

    }
    
    #Switch to Quest Creatorの画面を表示
    public function viewSwitchToCreator($id)
    {
        return view('players.mypage.switch');    
    }

    public function editPlayerImage(Request $request)
    {
        // ログインしていない場合はリダイレクト
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'please log in');
        }

        // バリデーション
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:1048',
        ]);

        // 現在ログイン中のユーザー
        $user = Auth::user();

        // ファイル保存
        if ($request->hasFile('image')) {
            // storage/app/public/player_images に保存 → 戻り値は "player_images/ファイル名"
            $path = $request->file('image')->store('player_images', 'public');
            // DBには "storage/player_images/ファイル名" という形で保存
            $user->image = 'storage/'.$path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}