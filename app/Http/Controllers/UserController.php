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
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:1048',
        ]);
    
        $user = Auth::user();
    
        if ($request->hasFile('image')) {
            // storage/app/public/player_images 以下に保存
            // 戻り値は「player_images/ファイル名.jpg」のような相対パスになります
            $path = $request->file('image')->store('player_images', 'public');
    
            // ★ DBに保存する時は「storage/player_images/xxx.jpg」にするか「player_images/xxx.jpg」のみにするか統一しましょう
            // 例：DBには "player_images/xxx.jpg" だけを保存する
            $user->image = $path;
            $user->save();
        }
    
        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}