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

    public function viewTestSwitch(){
        return view('players.mypage.switch');
    }

    public function uploadCreatorImage(Request $request)
    {
        $request->validate([
            'player_image' => 'required|image|mimes:jpeg,jpg,png,gif|max:1048',
        ]);

        $user = Auth::user();
        
        // 画像を `storage/app/public/creator_images/` に保存
        if ($request->hasFile('player_image')) {
            $path = $request->file('player_image')->store('player_images', 'public');
            $user->image = 'storage/' . $path; // パスをDBに保存
            $user->save();
            
        }

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}