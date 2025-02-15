<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    #Create Instance
    private $user;

    public function __construct(User $user){
        $this->user = $user;

    }
    
    #View Switch to Quest Creator page
    public function viewSwitchToCreator($id)
    {
        return view('players.mypage.switch');    
    }

    #View Account Security page
    public function viewAccountSecurity($id)
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        return view('players.mypage.accountsecurity');    
    }

    #Update Email address
    public function updateEmailAddress(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'required', // 現在のパスワード
        ]);

        $user = Auth::user();

        // Check password
        if(! Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'The provided password does not match your current password.'
            ]);
        }

        // Update email
        $user->email = $request->email;
        $user->save();

        return back()->with('status', 'Email updated successfully!');
    }

    #Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'currentpass' => 'required',
            'newpass'     => 'required|min:8',
            'newpass2'    => 'required|same:newpass',
        ]);

        $user = Auth::user();

        // 旧パスワードチェック
        if(! Hash::check($request->currentpass, $user->password)) {
            return back()->withErrors([
                'currentpass' => 'The current password is incorrect.'
            ]);
        }

        // 新パスワード更新
        $user->password = Hash::make($request->newpass);
        $user->save();

        return back()->with('status', 'Password updated successfully!');
    }

    
    #View delete My Account page
    public function viewDeleteAccount($id)
    {
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }

        return view('players.mypage.deleteaccount');    
    }

    #Delete account
    public function destroyAccount(Request $request)
    {
        $user = Auth::user();
        
        // もし必要であれば、ここで「本当に削除確認」を更に行う or パスワード再確認など
        
        // Delete account data in User tbl
        $user->delete();

        // logout
        Auth::logout();

        // セッションを無効化 (任意らしい)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status','Your account has been deleted.');
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

    public function uploadPlayerImage(Request $request)
    {
        // 1. バリデーション
        $request->validate([
            'player_image' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        // 2. ファイルの保存
        // storage/app/public/player_images フォルダに保存され、パスが返ってくる
        $path = $request->file('player_image')->store('public/player_images');

        // 3. DBにファイルパスを保存
        // 例：usersテーブルに 'image' カラムがある場合
        Auth::user()->update([
            // store('public/xxx') の返り値は "public/player_images/ファイル名"
            // asset() で表示したいなら "storage/player_images/ファイル名" に変換するのが一般的
            'image' => str_replace('public/', 'storage/', $path),
        ]);

        // 4. リダイレクト
        return back()->with('status', 'Image uploaded successfully!');
    }

}